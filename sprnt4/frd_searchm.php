<?php 

/**
* 
*/
class frd_searchm extends CI_controller
{
	
	public function searchm($name)
	{
		//echo $name;
		$query=$this->db->query("call frnd_search('$name')");
        $result=$query->result_array();
        //print_r($result);
        return $result;
	}
	public function adfrnd($data)
	{
		foreach (array_keys($data) as $i)
			{
            #echo $i;
				$data[$i]=$this->db->escape($data[$i]);
            // echo $data[$i];

			}
             $frnd_values=implode(',', $data);
             if($this->db->query("call frnd_ins({$frnd_values})"))
             {
             	$result = array('R_Code' => 500, 'Msg'=>'Success');
             	echo json_encode($result);
             }
             else
             {
                  $result = array('R_Code' =>404 ,'msg'=>'error' );
                  echo json_encode($result);
             }
	}
	public function vw_rqstm($id)
	{
		// echo $id;
		$query=$this->db->query("call view_rqst('$id')");
		$result=$query->result_array();
		echo json_encode($result);
		return $result;
	}
	public function accpt_rqstm($data,$email)
	{
		foreach (array_keys($data) as $i) 
		{
			$data[$i]=$this->db->escape($data[$i]);
		}
		$values=implode(',', $data);
		if($this->db->query("call aprove_rqst({$values})"));
		{
			echo "string";
		}


		$config = Array( 
                'crlf'=>'\r\n',
                'newline'=>'\r\n',
                'protocol' => 'smtp', 
                'smtp_host' => 'ssl://smtp.googlemail.com', 
                'smtp_port' => 465, 
                'smtp_user' => 'jyothishsj713@gmail.com', // here goes your mail 
                'smtp_pass' => '11062101', // here goes your mail password 
                'mailtype' => 'html', 
                'charset' => 'utf-8', 
                'wordwrap' => TRUE

                );
                   
                
                $this->load->library('email', $config); 
                $this->email->initialize($config);
                 $message = 'hiiiiii'; 
                $this->email->set_newline("\r\n"); 
                $this->email->from('jyothishsj713@gmail.com'); // here goes your mail 
                $this->email->to($email);// here goes your mail 
                $this->email->subject('confirm'); 
                $this->email->message($message); 
                if($this->email->send()) 
                { 
                echo 'Email sent'; 
                } 
                else 
                { 
                show_error($this->email->print_debugger()); 
                }
	}
	 public function search_frndsm($name)
	 {
       $query=$this->db->query("call view_friends('$name')");
       $result=$query->result_array();
       echo json_encode($result);
       return $result;
	 }

	 public function unfrndm($data)
	 {
		 	foreach (array_keys($data) as $i) 
		 	{
		 	      $data[$i]=$this->db->escape($data[$i]);

		 	}
		 	$values=implode(',',$data);
		 	if($this->db->query("call delete_frnd({$values})"));
          {
          	echo "string";
          }
	 }
	}


 ?>