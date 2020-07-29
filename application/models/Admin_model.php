<?php
class Admin_model extends CI_Model
{
    public function getAdmin($id_admin=null)
    {
        if($id_admin===null){
            
            return $this->db->get('m_admin')->result_array();
        }else {     
            return $this->db->get_where('m_admin',['id_admin'=>$id_admin])->result_array();
        } 
    }

    public function deleteAdmin($id_admin){
        $this->db->delete('m_admin',['id_admin'=>$id_admin]);
        return $this->db->affected_rows();
    }

    public function tambahAdmin($data){
        $this->db->insert('m_admin',$data);
        return  $this->db->affected_rows();
    }

      public function updateAdmin($data,$id_admin){
          // parameter namatabel, data, id_admin
        $this->db->update('m_admin',$data,['id_admin'=>$id_admin]);
        return  $this->db->affected_rows();
    }
}