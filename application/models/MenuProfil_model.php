<?php
class MenuProfil_model extends CI_Model
{
    public function getMenuProfil($id_profil=null)
    {
        if($id_profil===null){
            
            return $this->db->get('menu_profil')->result_array();
        }else {
          
            return $this->db->get_where('menu_profil',['id_profil'=>$id_profil])->result_array();
        }
       
    }

    public function deleteMenuProfil($id_profil){
        $this->db->delete('menu_profil',['id_profil'=>$id_profil]);
        return $this->db->affected_rows();
    }

    public function tambahMenuProfil($data){
        $this->db->insert('menu_profil',$data);
        return  $this->db->affected_rows();
    }

      public function updateMenuProfil($data,$id_profil){
          // parameter namatabel, data, id_profil
        $this->db->update('menu_profil',$data,['id_profil'=>$id_profil]);
        return  $this->db->affected_rows();
    }
}