<?php

class Notify_Model extends CI_Model{
    public function __construct() {
        parent::__construct();
    } 
    
//   creating table given below:
//    
//      create table comments
//    (
//	comment_id INT not null primary key,
//	comment_subject VARCHAR(250) not null,
//	comment_text TEXT not null,
//	comment_status INT not null
//     )
    
    public function data_insert($subject,$comment) {
        
        $this->db->set('comment_subject', $subject);
        $this->db->set('comment_text',$comment);
        $qry=$this->db->insert('comments');
        if($qry)
        {
           return 1; 
        }
    }
    public function fetch_data($v)
    {  
       

                    if($v != '')

                    {
                     $this->db->set('comment_status', '1');
                     $this->db->where('comment_status','0');
                    $this->db->update('comments');
                    echo '0';

                    }
                        $this->db->select();
                         $this->db->from("comments");
                         $this->db->order_by("comment_id", "DESC");
                         $result = $this->db->get();
                         $output = '';
           

                    if($result->num_rows() > 0)
                    { 
                         foreach($result->result() as $row)

                        {

                             //var_dump($row);
                              $output .='<li><a href="#"> <strong>Subject: ' . $row->comment_subject . ' </strong> <br /> <small><em>Comment: '.$row->comment_text.'</em></small></a> </li>';


                        }
                     }

                     else
                     {                       
                        $output .= '<li><a href="#" class="text-bold text-italic"> No Noti Found </a></li>'; 
//                    
                    }


             $this->db->select();
             $this->db->from("comments");
             $this->db->where("comment_status", "0");
             $result1 = $this->db->get();
            $count=$result1->num_rows();

            $data= array('notification'=>$output,'unseen_notification'=>$count);
           
            return json_encode($data);
            
    }
        
    
}
