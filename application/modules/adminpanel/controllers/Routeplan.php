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

        $this->module = "routeplan";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "user/";
        $this->routeplan_table = 'sramcms_routeplan';
        $this->menus_table = 'menus';
        $this->note_table = 'note';
    }

    function _remap($method, $args) {

        if (method_exists($this, $method)) {
            $this->$method($args);
        } else {
            if ($method !== 'download_files') {
                $this->index($method, $args);
            } else if ($method == 'loadmap') {
                $this->loadmap($method, $args);
            }
        }
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
                        $result["data"][] = array("id" => preg_replace("/\.json$/", "", $entry), "name" => $project["name"], "layers_name" => $project['layers'][0]['name']);
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
                            $startdate = date('d', strtotime($shapes[$j]->startdate));
                            $end_date = date('d', strtotime($shapes[$j]->enddate));
                            if ($startdate == '31') {
                                $start_date = date('Y-m-01', strtotime($shapes[$j]->startdate));
                            } else {
                                $start_date = date('Y-m-d', strtotime($shapes[$j]->startdate));
                                $start_date = date('Y-m-d', strtotime($start_date . ' +1 days'));
                            }
                            if ($end_date == '31') {
                                $enddate = date('Y-m-01', strtotime($shapes[$j]->enddate));
                            } else {
                                $enddate = date('Y-m-d', strtotime($shapes[$j]->enddate));
                                $enddate = date('Y-m-d', strtotime($enddate . ' +1 days'));
                            }
                            $insert_array = array(
                                'start_date' => date('Y-m-d', strtotime($shapes[$j]->startdate)),
                                'end_date' => date('Y-m-d', strtotime($shapes[$j]->enddate)),
                                'map_id' => $id,
                                'trip_name' => $trip_name,
                                'plan_details' => $shapes[$j]->name,
                                'description' => $shapes[$j]->description ? $shapes[$j]->description : '',
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
                            $startdate = date('d', strtotime($shapes[$j]->startdate));
                            $end_date = date('d', strtotime($shapes[$j]->enddate));
                            if ($startdate == '31') {
                                $start_date = date('Y-m-01', strtotime($shapes[$j]->startdate));
                            } else {
                                $start_date = date('Y-m-d', strtotime($shapes[$j]->startdate));
                                $start_date = date('Y-m-d', strtotime($start_date . ' +1 days'));
                            }
                            if ($end_date == '31') {
                                $enddate = date('Y-m-01', strtotime($shapes[$j]->enddate));
                            } else {
                                $enddate = date('Y-m-d', strtotime($shapes[$j]->enddate));
                                $enddate = date('Y-m-d', strtotime($enddate . ' +1 days'));
                            }

                            $insert_array = array('start_date' => date('Y-m-d', strtotime($shapes[$j]->startdate)),
                                'end_date' => date('Y-m-d', strtotime($shapes[$j]->enddate)),
                                'map_id' => $id,
                                'trip_name' => $trip_name,
                                'plan_details' => $shapes[$j]->name,
                                'description' => $shapes[$j]->description ? $shapes[$j]->description : '',
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

    function loadmap($method) {
        $map_id = $method[0];

        $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where map_id='$map_id' and is_active=1 and is_visible=1");
        $plan_details = explode('-', $getplandetails[0]['plan_details']);
        $response['startvalue'] = $plan_details[0];
        $response['endvalue'] = $plan_details[1];
        $destinations = $getplandetails[0]['destinations'];
        $explodedestinations = explode('|*|', $destinations);
        $response['destinations'] = array();
        $rows = array();
        foreach ($explodedestinations as $destination):
            $rows['location'] = $destination;
            array_push($response['destinations'], $rows);
        endforeach;
        $data['records'] = json_encode($response);
        $data['module'] = $this->module;
        $data['map_id'] = $map_id;
        $this->load->view($this->folder . 'loadmap', $data);
    }

    function getroute_by_map_id() {
        $map_id = $this->input->post('map_id');
//        echo "select * from $this->routeplan_table where map_id='$map_id' and is_active =1 and is_visible = 1";
        $getplandetails = $this->Mydb->custom_query("select * from $this->routeplan_table where map_id='$map_id' and is_active =1 and is_visible = 1");
        $plan_details = explode('-', $getplandetails[0]['plan_details']);
        $response['startvalue'] = $plan_details[0];
        $response['endvalue'] = $plan_details[1];
        $destinations = $getplandetails[0]['destinations'];
        $explodedestinations = explode('|*|', $destinations);
        $response['destinations'] = array();
        $rows = array();
        foreach ($explodedestinations as $destination):
            $rows['location'] = $destination;
            array_push($response['destinations'], $rows);
        endforeach;
        echo json_encode($response);
    }

    function getlattitude_longtitude() {
        $startvalue = $this->input->post('start_date');
        $endvalue = $this->input->post('end_date');

        $prepAddr = str_replace(' ', '+', $startvalue);
        $geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=false');
        $output = json_decode($geocode);
        $start_latitude = $output->results[0]->geometry->location->lat;
        $start_longitude = $output->results[0]->geometry->location->lng;

        $prep_Addr = str_replace(' ', '+', $endvalue);
        $geo_code = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . $prep_Addr . '&sensor=false');
        $out_put = json_decode($geo_code);
        $end_latitude = $out_put->results[0]->geometry->location->lat;
        $end_longitude = $out_put->results[0]->geometry->location->lng;

        $result['start_lattitude'] = $start_latitude;
        $result['start_longtitude'] = $start_longitude;
        $result['end_lattitude'] = $end_latitude;
        $result['end_longtitude'] = $end_longitude;
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
