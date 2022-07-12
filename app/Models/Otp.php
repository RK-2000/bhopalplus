<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'otp';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'status', 'otp'];
}
