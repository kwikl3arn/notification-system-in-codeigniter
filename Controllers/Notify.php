<?php


class Notify extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Notify_Model');
        
    }
    public function index() {
        $this->load->view('notifications');
        
    }
    public function submit_comm()
    {
       $subject =$this->input->post('subject');
       
       $comment =$this->input->post('comment');
    
  
     $chk=$this->Notify_Model->data_insert($subject,$comment);
      if($chk==1)
      {
          echo 'inserted';
      }
    }
    public function user_notifi()
    {
                 

         
        
          $v=$this->input->post('view');
        echo  $op= $this->Notify_Model->fetch_data($v);
         
          return $op;
    
    }
}
