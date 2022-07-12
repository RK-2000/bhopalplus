<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiLevelParking extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'multi_level_parking';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
