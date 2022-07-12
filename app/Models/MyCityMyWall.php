<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyCityMyWall extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'my_city_my_wall';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
