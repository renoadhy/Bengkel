<?php

namespace App\Models;

use CodeIgniter\Model;

class ServisModel extends Model
{
    protected $table      = 'servis';
    protected $primaryKey = 'id_servis';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nm_servis', 'harga'];

    public function semua()
    {
        $query = "SELECT * FROM servis";
        $sql = $this->db->query($query);
        return $sql->getResult();
        //return $this->db->get("servis")->result_array();
    }
    
    public function last_id()
    {             
        $query =  "SELECT max(id_servis) as id_terakhir from servis"; 
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    public function get_allListServis($nm_servis)
    {
        $query = "  SELECT * FROM servis
        WHERE nm_servis LIKE '%" . trim($nm_servis) . "%'";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    function tot_servis(){		
        $query = "SELECT count(id_servis) as total FROM servis";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    public function ambilServis($id)
	{
        $query = "SELECT * FROM servis 
        WHERE `id_servis`=($id)";
        $sql = $this->db->query($query);
        return $sql->getResult();
        }

    
}