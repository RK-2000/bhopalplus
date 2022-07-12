<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicBikeSharing extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'public_bike_sharing';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
