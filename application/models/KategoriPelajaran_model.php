<?php
class KategoriPelajaran_model extends CI_Model
{
    public function getKategoriPelajaran($id_kategori_pelajaran=null)
    {
        if($id_kategori_pelajaran===null){
            
            return $this->db->get('m_kategori_pelajaran')->result_array();
        }else {
          
            return $this->db->get_where('m_kategori_pelajaran',['id_kategori_pelajaran'=>$id_kategori_pelajaran])->result_array();
        }
       
    }

    public function deleteKategoriPelajaran($id_kategori_pelajaran){
        $this->db->delete('m_kategori_pelajaran',['id_kategori_pelajaran'=>$id_kategori_pelajaran]);
        return $this->db->affected_rows();
    }

    public function tambahKategoriPelajaran($data){
        $this->db->insert('m_kategori_pelajaran',$data);
        return  $this->db->affected_rows();
    }

      public function updateKategoriPelajaran($data,$id_kategori_pelajaran){
          // parameter namatabel, data, id_kategori_pelajaran
        $this->db->update('m_kategori_pelajaran',$data,['id_kategori_pelajaran'=>$id_kategori_pelajaran]);
        return  $this->db->affected_rows();
    }
}