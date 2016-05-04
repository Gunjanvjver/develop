<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Project : Revolution
 * 
 */

class AdminBase extends CI_Controller {

    public $data;
    public $page_title = '';

    function __construct() {
        parent::__construct();
        
    }

    function load_views() {
       // $this->data['style'] = $this->load->view('template/style', $this->data, true);
        $this->data['header'] = $this->load->view('template/header', $this->data, true);
        $this->data['menu'] = $this->load->view('template/menu', $this->data, true);
        $this->data['footer'] = $this->load->view('template/footer', $this->data, true);
    }

    public function trim_value($value) {
        return html_escape(trim(urldecode($value)));
    }
}
