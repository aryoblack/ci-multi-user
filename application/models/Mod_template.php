<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_menu extends CI_Model {

    public function aksesMenu($idlevel)
    {
        
        $this->db->select('b.nama_menu,b.icon,b.link,b.id_menu');
        $this->db->join('tbl_menu b', 'a.id_menu=b.id_menu');
        $this->db->join('tbl_userlevel c', 'a.id_level=c.id_level' );
        $this->db->where('a.id_level',$idlevel);
        return $this->db->get('tbl_akses_menu a');
    }

    
}

/* End of file Mod_login.php */
