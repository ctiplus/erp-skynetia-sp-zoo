<?php

namespace App\Controllers;

class FrontPages extends App_Controller {

    private $signin_validation_errors;

    function __construct() {
        parent::__construct();
        $this->signin_validation_errors = array();
       
    }

    function index() {
        $view_data["form_type"] = "request_reset_password";
        return $this->template->view('frontpages/index', $view_data);
    }
    function request_reset_password() {
        $view_data["form_type"] = "request_reset_password";
        return $this->template->view('frontpage/index', $view_data);
    }

   
    

}
