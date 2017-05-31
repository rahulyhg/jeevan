<?php

class Deeksha_Block extends Core_Block {

    protected $view = 'blocks/deeksha';

    public function __construct() {
        parent::__construct();
    }

    public function drawData() {
        $data = $this->getBlockData();
//        $data['accord_slug'] = $this->CI->uri->segment(3);
        return $data;
    }

}
