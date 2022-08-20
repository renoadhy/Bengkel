<?php

namespace App\Models;

use CodeIgniter\Model;

class SparepartMasukModel extends Model
{
    protected $table      = 'sparepart_masuk';
    protected $primaryKey = 'id_masuk';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['tgl_masuk', 'id_sparepart', 'jml', 'total', 'id_supplier'];


    public function get_dataJoin()
    {             
        $query =  $this->db->table('sparepart_masuk sm')
         ->join('supplier s', 's.id_supplier = sm.id_supplier') 
         ->join('sparepart sp', 'sp.id_sparepart = sm.id_sparepart') 
         ->get();  
        return $query;
    }

    function tot_sparepart_masuk(){		
        $query = "SELECT count(id_masuk) as total FROM sparepart_masuk";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }
}