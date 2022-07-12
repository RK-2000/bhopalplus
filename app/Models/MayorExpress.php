<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MayorExpress extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'mayor_express';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
