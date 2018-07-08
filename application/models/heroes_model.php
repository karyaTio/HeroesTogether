<?php
class heroes_model extends CI_Model {

  function heroes_list(){
    $hasil = $this->db->get('hero');
    return $hasil->result();
  }

  function getById($id){
    $this->db->get('hero');
    $this->db->where('id', $id);
  }

  function save_hero(){

    // Ambil data dari post dan jadikan array
    $data = array(
      'hero_name' => $this->input->post('hero_name'),
      'real_name' => $this->input->post('real_name'),
      'umur' => $this->input->post('umur'),
      'power' => $this->input->post('power')
    );

    // Simpan data
    $result = $this->db->insert('hero', $data);
    return $result;
  }

  function update_hero(){
    // Ambil Data
    $id = $this->input->post('id');
    $hero_name =$this->input->post('hero_name');
    $real_name =$this->input->post('real_name');
    $umur =$this->input->post('umur');
    $power =$this->input->post('power');

    $this->db->set('hero_name', $hero_name);
    $this->db->set('real_name', $real_name);
    $this->db->set('umur', $umur);
    $this->db->set('power', $power);
    $this->db->where('id', $id);

    $result = $this->db->update('hero');
    return $result;
  }

  function delete_hero(){
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    $result = $this->db->delete('hero');
    return $result;
  }
}
?>
