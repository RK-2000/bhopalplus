<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IsolationSuidelines extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'isolation_suidelines';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
