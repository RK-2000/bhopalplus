<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feverclinic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'fever_clinic';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'phone_code', 'number', 'status'];
}
