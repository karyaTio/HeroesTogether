<?php
class Heroes extends CI_Controller {
  function __construct(){
    parent::__construct();
    $this->load->model('heroes_model');
  }

  function index(){
    $this->load->view('layout/header');
    $this->load->view('heroes/index');
    $this->load->view('layout/footer');
  }

  function getById(){
    $id = $this->get('id');
    $data = $this->heroes_model->getById($id);
    echo json_encode($data);
  }

  function heroes_data(){
    $data = $this->heroes_model->heroes_list();
    echo json_encode($data);
  }

  function save(){
		$data=$this->heroes_model->save_hero();
		echo json_encode($data);
	}

	function update(){
		$data=$this->heroes_model->update_hero();
		echo json_encode($data);
	}

	function delete(){
		$data=$this->heroes_model->delete_hero();
		echo json_encode($data);
	}
}
?>
