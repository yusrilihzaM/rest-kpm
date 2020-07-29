<?php
class Mahasiswa_model extends CI_Model
{
    public function getMahasiswa($id=null)
    {
        if($id===null){
            // $this->db->select('*');
            // $this->db->from('mahasiswa');
            // $this->db->join('prestasi','mahasiswa.id=prestasi.id');
            // $query=$this->db->get();
            // $data=$query->result_array();
            // return $data;
            return $this->db->get('m_user')->result_array();
        }else {
            // $this->db->select('*.mahasiswa,*.prestasi');
            // $this->db->from('mahasiswa');
            // $this->db->join('prestasi','mahasiswa.id=prestasi.id');
            // $query=$this->db->get();
            // $data=$query->result_array();
            // return $data;
            return $this->db->get_where('m_user',['id'=>$id])->result_array();
        }
       
    }

    public function deleteMahasiswa($id){
        $this->db->delete('m_user',['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function tambahMahasiswa($data){
        $this->db->insert('m_user',$data);
        return  $this->db->affected_rows();
    }

      public function updateMahasiswa($data,$id){
          // parameter namatabel, data, id
        $this->db->update('m_user',$data,['id'=>$id]);
        return  $this->db->affected_rows();
    }
}