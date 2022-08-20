<?php

namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table      = 'stok';
    protected $primaryKey = 'id_sparepart';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_sparepart','stok'];
}