<?php
class MenuHubKami_model extends CI_Model
{
    public function getHubKami($id_hub=null)
    {
        if($id_hub===null){
            
            return $this->db->get('menu_hubungi_kami')->result_array();
        }else {
          
            return $this->db->get_where('menu_hubungi_kami',['id_hub'=>$id_hub])->result_array();
        }
       
    }

    public function deleteHubKami($id_hub){
        $this->db->delete('menu_hubungi_kami',['id_hub'=>$id_hub]);
        return $this->db->affected_rows();
    }

    public function tambahHubKami($data){
        $this->db->insert('menu_hubungi_kami',$data);
        return  $this->db->affected_rows();
    }

      public function updateHubKami($data,$id_hub){
          // parameter namatabel, data, id_hub
        $this->db->update('menu_hubungi_kami',$data,['id_hub'=>$id_hub]);
        return  $this->db->affected_rows();
    }
}