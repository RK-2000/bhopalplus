<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeleConsultationModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tele_consultation';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'phone_code', 'number', 'status'];
}
