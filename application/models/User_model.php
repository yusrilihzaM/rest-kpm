<?php
class User_model extends CI_Model
{
    public function getUser($id=null)
    {
        if($id===null){
            return $this->db->get('m_user')->result_array();
        }else {
            return $this->db->get_where('m_user',['user_id'=>$id])->result_array();
        }
       
    }

    public function deleteUser($id){
        $this->db->delete('m_user',['user_id'=>$id]);
        return $this->db->affected_rows();
    }

    public function tambahUser($data){
        $this->db->insert('m_user',$data);
        return  $this->db->affected_rows();
    }

      public function updateUser($data,$id){
          // parameter namatabel, data, id
        $this->db->update('m_user',$data,['user_id'=>$id]);
        return  $this->db->affected_rows();
    }
}