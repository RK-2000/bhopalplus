<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmartQrScanner extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'smart_qr_scanner';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
