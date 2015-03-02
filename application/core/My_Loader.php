<?php

class MY_Loader extends CI_Loader {
    public function admin_view($view, $vars = array(), $return = FALSE) {
        $content  = $this->view('template/header', $vars, $return);
        $content .= $this->view('template/sidebar', $vars, $return);
        $content .= $this->view('admin/'.$view, $vars, $return);
        $content .= $this->view('template/footer', $vars, $return);
        
    }

    public function frontend_view($view, $vars = array(), $return = FALSE) {
        $content  = $this->view('template/header', $vars, $return);
        $content .= $this->view('frontend/'.$view, $vars, $return);
        $content .= $this->view('template/footer', $vars, $return);
    }
}