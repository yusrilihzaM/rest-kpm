<?php
class MenuHome_model extends CI_Model
{
    public function getHome($id_home=null)
    {
        if($id_home===null){
            
            return $this->db->get('menu_home')->result_array();
        }else {
          
            return $this->db->get_where('menu_home',['id_home'=>$id_home])->result_array();
        }
       
    }

    public function deleteHome($id_home){
        $this->db->delete('menu_home',['id_home'=>$id_home]);
        return $this->db->affected_rows();
    }

    public function tambahHome($data){
        $this->db->insert('menu_home',$data);
        return  $this->db->affected_rows();
    }

      public function updateHome($data,$id_home){
          // parameter namatabel, data, id_home
        $this->db->update('menu_home',$data,['id_home'=>$id_home]);
        return  $this->db->affected_rows();
    }
}