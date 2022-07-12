<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'service_category';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'status', 'url', 'icon'];
}
