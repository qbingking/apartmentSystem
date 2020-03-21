<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperEmail extends CI_Controller {
	public function __construct() {
        parent:: __construct();

        $this->load->helper('url');
    }

    public function index() {
        $this->send_the_email();
    }

    function send_the_email() {
        $this->load->config('email');
        $this->load->library('email');
        
        $from = 'mynameismrbinh@gmail.com';
        $to = 'bqbiamshybee@gmail.com';
        $subject = 'OOOOO LALALALA';
        $message = 'hittt me';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }

}

/* End of file SuperEmail.php */
/* Location: ./application/controllers/SuperEmail.php */