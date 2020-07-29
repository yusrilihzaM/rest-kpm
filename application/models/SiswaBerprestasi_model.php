<?php
class SiswaBerprestasi_model extends CI_Model
{
    public function getSiswaBerprestasi($id_siswa_berprestasi=null)
    {
        if($id_siswa_berprestasi===null){
            
            return $this->db->get('menu_siswa_berprestasi')->result_array();
        }else {
          
            return $this->db->get_where('menu_siswa_berprestasi',['id_siswa_berprestasi'=>$id_siswa_berprestasi])->result_array();
        }
       
    }

    public function deleteSiswaBerprestasi($id_siswa_berprestasi){
        $this->db->delete('menu_siswa_berprestasi',['id_siswa_berprestasi'=>$id_siswa_berprestasi]);
        return $this->db->affected_rows();
    }

    public function tambahSiswaBerprestasi($data){
        $this->db->insert('menu_siswa_berprestasi',$data);
        return  $this->db->affected_rows();
    }

      public function updateSiswaBerprestasi($data,$id_siswa_berprestasi){
          // parameter namatabel, data, id_siswa_berprestasi
        $this->db->update('menu_siswa_berprestasi',$data,['id_siswa_berprestasi'=>$id_siswa_berprestasi]);
        return  $this->db->affected_rows();
    }
}