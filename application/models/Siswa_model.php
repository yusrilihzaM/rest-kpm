<?php
class Siswa_model extends CI_Model
{
    public function getSiswa($user_id=null)
    {
        if($user_id===null){
            
            return $this->db->get_where('m_user',['jenis_user'=>'siswa'])->result_array();
        }else {     
            return $this->db->get_where('m_user',['user_id'=>$user_id,'jenis_user'=>'siswa'])->result_array();
        } 
    }

    public function deleteSiswa($user_id){
        $this->db->delete('m_user',['user_id'=>$user_id,'jenis_user'=>'siswa']);
        return $this->db->affected_rows();
    }

    public function tambahSiswa($data){
        $this->db->insert('m_user',$data);
        return  $this->db->affected_rows();
    }

      public function updateSiswa($data,$user_id){
          // parameter namatabel, data, user_id
        $this->db->update('m_user',['user_id'=>$user_id,'jenis_user'=>'siswa']);
        return  $this->db->affected_rows();
    }
}