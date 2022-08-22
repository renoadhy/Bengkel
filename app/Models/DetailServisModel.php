<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailServisModel extends Model
{
    protected $table      = 'detail_servis';
    protected $primaryKey = 'id_detail';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_keluar', 'id_servis', 'harga', 'total'];
}
