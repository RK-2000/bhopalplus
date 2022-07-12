<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'image';
    protected $primaryKey = 'id';
    protected $fillable = ['image_id', 'name', 'path', 'type'];
}
