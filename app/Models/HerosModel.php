<?php

namespace App\Models;
use CodeIgniter\Model;

/* HERO MODEL */
class HerosModel extends Model {
    protected $table = 'hero';      // table from bd
    protected $primaryKey = 'id';   // table primary key
    protected $allowedFields = ['name', 'description', 'thumbnail_path'];   // fields that are allow to be changed 
}