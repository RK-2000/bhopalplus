<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeathRegistration extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'death_registration';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
