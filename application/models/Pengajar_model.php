<?php
class Pengajar_model extends CI_Model
{
    public function getPengajar($user_id=null)
    {
        if($user_id===null){
            
            return $this->db->get_where('m_user',['jenis_user'=>'pengajar'])->result_array();
        }else {     
            return $this->db->get_where('m_user',['user_id'=>$user_id,'jenis_user'=>'pengajar'])->result_array();
        } 
    }

    public function deletePengajar($user_id){
        $this->db->delete('m_user',['user_id'=>$user_id,'jenis_user'=>'pengajar']);
        return $this->db->affected_rows();
    }

    public function tambahPengajar($data){
        $this->db->insert('m_user',$data);
        return  $this->db->affected_rows();
    }

      public function updatePengajar($data,$user_id){
          // parameter namatabel, data, user_id
        $this->db->update('m_user',['user_id'=>$user_id,'jenis_user'=>'pengajar']);
        return  $this->db->affected_rows();
    }
}