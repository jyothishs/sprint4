<?php 
	class frd_search extends CI_controller
	{
		
		public function search()
		{
			$name=$this->input->get_post('name');
			// print_r($user);
			$this->load->model('frd_searchm');
			$json=$this->frd_searchm->searchm($name);
			echo json_encode($json);
		}

		public function addfrnd()
		{
			$frnd['sender']=$this->input->get_post('sender');
			  $frnd['reciver']=$this->input->get_post('reciver');
			


			
              // print_r($frnd);
              //echo $email;
			 $this->load->model('frd_searchm');
			 $this->frd_searchm->adfrnd($frnd);
			  // echo json_encode($json);
			 	 

			

		}

		public function vw_rqst()
		{
			$id=$this->input->get_post('id');

			$this->load->model('frd_searchm');
			$this->frd_searchm->vw_rqstm($id);
		}
		public function accpt_rqst()
		{
			$frnd['sender']=$this->input->get_post('sender');
			$frnd['reciver']=$this->input->get_post('reciver');
			$emailid=$this->input->get_post('email');

			print_r($frnd);
			print_r($emailid);
            
            $this->load->model('frd_searchm');
            $this->frd_searchm->accpt_rqstm($frnd,$emailid);
            

            // $this->email($emailid);

               		  
		}
		public function search_frnds()
		{
          $name=$this->input->get_post('name');
          $this->load->model('frd_searchm');
          $this->frd_searchm->search_frndsm($name);

		}
		public function unfrnd()
		{
			$ufrnd['sender']=$this->input->get_post('sender');
			$ufrnd['reciver']=$this->input->get_post('reciver');

			$this->load->model('frd_searchm');
			$this->frd_searchm->unfrndm($ufrnd);
		}


	}
 ?>