<?php

class Textwidgets_block extends Core_Block {

    protected $view = 'blocks/textwidgets';

    public function __construct() {
        parent::__construct();
        $this->news_media_table = 'news_media';
    }

    public function drawData() {

        $data = $this->getBlockData();
        
        return $data;
    }

}
