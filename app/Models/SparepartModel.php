<?php

namespace App\Models;

use CodeIgniter\Model;

class SparepartModel extends Model
{
    protected $table      = 'sparepart';
    protected $primaryKey = 'id_sparepart';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nm_sparepart', 'harga', 'gambar'];


    public function get_dataJoin()
    {             
        $query =  $this->db->table('sparepart s')
         ->join('stok st', 'st.id_sparepart = s.id_sparepart') 
         ->get();  
        return $query;
    }

    public function last_id()
    {             
        $query =  "SELECT max(id_sparepart) as id_terakhir from sparepart"; 
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    public function get_allListSparepart($nm_sparepart)
    {
        $query = "  SELECT * FROM sparepart JOIN stok s ON s.id_sparepart = sparepart.id_sparepart
        WHERE nm_sparepart LIKE '%" . trim($nm_sparepart) . "%'";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    function tot_sparepart(){		
        $query = "SELECT count(id_sparepart) as total FROM sparepart";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }
}