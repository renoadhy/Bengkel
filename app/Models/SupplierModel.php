<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table      = 'supplier';
    protected $primaryKey = 'id_supplier';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['nm_supplier', 'alamat', 'no_telp'];

    function tot_supplier(){		
        $query = "SELECT count(id_supplier) as total FROM supplier";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }
}