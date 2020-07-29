<?php
class KelasPembinaan_model extends CI_Model
{
    public function getKelasPembinaan($id_kelas_pembinaan=null)
    {
        if($id_kelas_pembinaan===null){
            
            return $this->db->get('m_kelas_pembinaan')->result_array();
        }else {
          
            return $this->db->get_where('m_kelas_pembinaan',['id_kelas_pembinaan'=>$id_kelas_pembinaan])->result_array();
        }
       
    }

    public function deleteKelasPembinaan($id_kelas_pembinaan){
        $this->db->delete('m_kelas_pembinaan',['id_kelas_pembinaan'=>$id_kelas_pembinaan]);
        return $this->db->affected_rows();
    }

    public function tambahKelasPembinaan($data){
        $this->db->insert('m_kelas_pembinaan',$data);
        return  $this->db->affected_rows();
    }

      public function updateKelasPembinaan($data,$id_kelas_pembinaan){
          // parameter namatabel, data, id_kelas_pembinaan
        $this->db->update('m_kelas_pembinaan',$data,['id_kelas_pembinaan'=>$id_kelas_pembinaan]);
        return  $this->db->affected_rows();
    }
}