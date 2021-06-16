<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['nama', 'foto', 'username', 'id_pegawai', 'email', 'password', 'role_id', 'last_login'];
}
