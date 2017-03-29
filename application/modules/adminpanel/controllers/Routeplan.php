<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Routeplan extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "user/";
        $this->routeplan_table = 'sramcms_routeplan';
        $this->menus_table = 'menus';
        $this->note_table = 'note';
    }

    public function index() {
        $data = $this->load_module_info();
        $this->load->view($this->folder . 'routeplan', $data);
    }

    public function apidata() {
        $action = $_REQUEST["action"];
        $result = array("data" => [], "error" => null, "success" => null);
        if (!file_exists(FCPATH . "/media/maps")) {
            mkdir(FCPATH . "/media/maps", 0755);
        }

        if ($action == "getProjectsList") {

            $d = dir(FCPATH . "/media/maps");
            while (($entry = $d->read()) !== false) {
                if (preg_match("/\.json$/", $entry) && is_file($d->path . "/" . $entry)) {
                    try {
                        $str = join("", file($d->path . "/" . $entry));
                        $project = json_decode($str, true);
                        $result["data"][] = array("id" => preg_replace("/\.json$/", "", $entry), "name" => $project["name"]);
                    } catch (Exception $e) {
                        $result["error"] = $e->getMessage();
                    }
                }
            }
            $result["success"] = "Project's list received";
        } elseif ($action == "getProject") {
            try {
                $id = preg_replace("/[^a-z0-9]/", "", $_REQUEST["id"]);
                if (!$id)
                    throw new Exception("Project id is not specified or is incorrect");
                if (!file_exists(FCPATH . "/media/maps/" . $id . ".json"))
                    throw new Exception("Project not found");
                $result["data"] = join("", file(FCPATH . "/media/maps/" . $id . ".json"));
                $result["success"] = "Project has been loaded";
                $result["id"] = $id;
            } catch (Exception $e) {
                $result["error"] = $e->getMessage();
            }
        } elseif ($action == "deleteProject") {
            try {
                $id = preg_replace("/[^a-z0-9]/", "", $_REQUEST["id"]);
                if (!$id)
                    throw new Exception("Project id is not specified or is incorrect");
                if (!file_exists(FCPATH . "/media/maps/" . $id . ".json"))
                    throw new Exception("Project not found");
                unlink(FCPATH . "/media/maps/" . $id . ".json");
                $update_array = array('status' => 3);
                $deletemaps = $this->Mydb->update($this->routeplan_table, array('map_id' => $id), $update_array);
                $result["success"] = "Project has been deleted";
            } catch (Exception $e) {
                $result["error"] = $e->getMessage();
            }
        } elseif ($action == "saveProject") {
            $jsonData = $_REQUEST["jsonData"];
            
            $decodedata = json_decode($jsonData);
            $layers = $decodedata->layers;
           
            $id = $_REQUEST["id"] != '' ? preg_replace("/[^a-z0-9]/", "", $_REQUEST["id"]) : '';
            if (!$id)
                $id = $this->generateUniqueId(20);
            for ($i = 0; $i < count($decodedata->layers); $i++):
                $shapes = $layers[$i]->shapes;
                if (count($shapes) != 0):
                    for ($j = 0; $j < count($shapes); $j++):
                        $trip_name = $layers[$i]->name;
                        $is_visible = $layers[$i]->isVisible ? $layers[$i]->isVisible : '0';
                        $name = $shapes[$j]->name;                        
                        $getdetails = $this->Mydb->custom_query("select id from $this->routeplan_table where map_id='$id'");
                        if ($getdetails[0]['id'] == ''):
                            $insert_array = array('start_date' => date('Y-m-d', strtotime($shapes[$j]->startdate)),
                                'end_date' => date('Y-m-d', strtotime($shapes[$j]->enddate)),
                                'map_id' => $id,
                            	'trip_name' => $trip_name,
                                'plan_details' => $shapes[$j]->name,
                                'description' => $shapes[$j]->description,
                                'destinations' => implode('|*|', $shapes[$j]->destinations),
                                'type' => $shapes[$j]->type,
                                'avoidHighways' => $shapes[$j]->avoidHighways,
                                'avoidTolls' => $shapes[$j]->avoidTolls,
                            	'created_on' => current_date(),
                                'created_ip' => get_ip(),         
                            	'created_by' => get_admin_id(),   
                            	'is_visible' => $is_visible,
                                'is_active' => 1);
                            $insert_id = $this->Mydb->insert($this->routeplan_table, $insert_array);
                        else:
                            $insert_array = array('start_date' => date('Y-m-d', strtotime($shapes[$j]->startdate)),
                                'end_date' => date('Y-m-d', strtotime($shapes[$j]->enddate)),
                                'map_id' => $id,
                            	'trip_name' => $trip_name,
                                'plan_details' => $shapes[$j]->name,
                                'description' => $shapes[$j]->description,
                                'destinations' => implode('|*|', $shapes[$j]->destinations),
                                'type' => $shapes[$j]->type,
                                'avoidHighways' => $shapes[$j]->avoidHighways,
                                'avoidTolls' => $shapes[$j]->avoidTolls,
                            	'created_on' => current_date(),
                            	'created_ip' => get_ip(),
                            	'created_by' => get_admin_id(),  
                            	'is_visible' => $is_visible,
                                'is_active' => 1);
                            $insert_id = $this->Mydb->update($this->routeplan_table, array('map_id' => $id), $insert_array);
                        endif;

                    endfor;
                endif;
            endfor;
            $f = fopen(FCPATH . "/media/maps/" . $id . ".json", "w");
            fwrite($f, $jsonData);
            fclose($f);
            $result["id"] = $id;
            $result["success"] = "New Map has been successfully saved";
        }

        echo json_encode($result);
    }

    function generateUniqueId($n) {
        $availableCharacters = "qwertyuiopasdfghjklzxcvbnm1234567890";
        $id = "";
        for ($i = 0; $i < $n; $i++) {
            $id .= substr($availableCharacters, rand(0, strlen($availableCharacters) - 1), 1);
        }
        return $id;
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
