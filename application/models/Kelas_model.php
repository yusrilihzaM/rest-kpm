<?php
class Kelas_model extends CI_Model
{
    public function getKelas($id_kelas=null)
    {
        if($id_kelas===null){
            
            return $this->db->get('kelas')->result_array();
        }else {
          
            return $this->db->get_where('kelas',['id_kelas'=>$id_kelas])->result_array();
        }
       
    }

    public function deleteKelas($id_kelas){
        $this->db->delete('kelas',['id_kelas'=>$id_kelas]);
        return $this->db->affected_rows();
    }

    public function tambahKelas($data){
        $this->db->insert('kelas',$data);
        return  $this->db->affected_rows();
    }

      public function updateKelas($data,$id_kelas){
          // parameter namatabel, data, id_kelas
        $this->db->update('kelas',$data,['id_kelas'=>$id_kelas]);
        return  $this->db->affected_rows();
    }
}