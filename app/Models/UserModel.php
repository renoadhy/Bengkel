<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'user_login';
    protected $primaryKey = 'id_user';

    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'username', 'password', 'nm_user','level'];
}