<?php
class MenuArtikel_model extends CI_Model
{
    public function getArtikel($id_artikel=null)
    {
        if($id_artikel===null){
            
            return $this->db->get('menu_artikel')->result_array();
        }else {
          
            return $this->db->get_where('menu_artikel',['id_artikel'=>$id_artikel])->result_array();
        }
       
    }

    public function deleteArtikel($id_artikel){
        $this->db->delete('menu_artikel',['id_artikel'=>$id_artikel]);
        return $this->db->affected_rows();
    }

    public function tambahArtikel($data){
        $this->db->insert('menu_artikel',$data);
        return  $this->db->affected_rows();
    }

      public function updateArtikel($data,$id_artikel){
          // parameter namatabel, data, id_artikel
        $this->db->update('menu_artikel',$data,['id_artikel'=>$id_artikel]);
        return  $this->db->affected_rows();
    }
}