<?php

namespace App\Models;

use CodeIgniter\Model;

class PostsModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id_post';
    protected $allowedFields = ['foto_post', 'deskripsi', 'id_pegawai', 'author', 'created_at'];
}
