<?php
class MenuPengumuman_model extends CI_Model
{
    public function getPengumuman($id_pengumuman=null)
    {
        if($id_pengumuman===null){
            
            return $this->db->get('menu_pengumuman')->result_array();
        }else {
          
            return $this->db->get_where('menu_pengumuman',['id_pengumuman'=>$id_pengumuman])->result_array();
        }
       
    }

    public function deletePengumuman($id_pengumuman){
        $this->db->delete('menu_pengumuman',['id_pengumuman'=>$id_pengumuman]);
        return $this->db->affected_rows();
    }

    public function tambahPengumuman($data){
        $this->db->insert('menu_pengumuman',$data);
        return  $this->db->affected_rows();
    }

      public function updatePengumuman($data,$id_pengumuman){
          // parameter namatabel, data, id_pengumuman
        $this->db->update('menu_pengumuman',$data,['id_pengumuman'=>$id_pengumuman]);
        return  $this->db->affected_rows();
    }
}