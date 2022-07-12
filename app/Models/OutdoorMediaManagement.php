<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutdoorMediaManagement extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'outdoor_media_management';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
