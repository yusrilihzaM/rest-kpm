<?php
class MenuInfoInfaq_model extends CI_Model
{
    public function getMenuInfoInfaq($menu_info_infaq=null)
    {
        if($menu_info_infaq===null){
            
            return $this->db->get('menu_profil')->result_array();
        }else {
          
            return $this->db->get_where('menu_profil',['menu_info_infaq'=>$menu_info_infaq])->result_array();
        }
       
    }

    public function deleteMenuInfoInfaq($menu_info_infaq){
        $this->db->delete('menu_profil',['menu_info_infaq'=>$menu_info_infaq]);
        return $this->db->affected_rows();
    }

    public function tambahMenuInfoInfaq($data){
        $this->db->insert('menu_profil',$data);
        return  $this->db->affected_rows();
    }

      public function updateMenuInfoInfaq($data,$menu_info_infaq){
          // parameter namatabel, data, menu_info_infaq
        $this->db->update('menu_profil',$data,['menu_info_infaq'=>$menu_info_infaq]);
        return  $this->db->affected_rows();
    }
}