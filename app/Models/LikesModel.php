<?php

namespace App\Models;

use CodeIgniter\Model;

class LikesModel extends Model
{
    protected $table = 'liked';
    protected $primaryKey = 'id_liked';
    protected $allowedFields = ['id_post', 'id_user'];
}
