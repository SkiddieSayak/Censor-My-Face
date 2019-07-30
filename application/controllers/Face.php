<?php
	class Face extends CI_Controller{
		
		public function img(){
				$config['upload_path'] = './assets/images/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload("userfile")){
					$errors = array('error' => $this->upload->display_errors());
					$this->load->view('templates/header');
					$this->load->view('pages/home', $errors);
					$this->load->view('templates/footer');
				} else {
					$data = array('upload_data' => $this->upload->data());
					$this->load->view('templates/header');
					$this->load->view('pages/home');
					$this->load->view('pages/view', $data);
					$this->load->view('templates/footer');

				}
		

		}

}