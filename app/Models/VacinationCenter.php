<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VacinationCenter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vacination_center';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'status'];
}
