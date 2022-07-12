<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPsychlogist extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'contact_psychologist';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'phone_code', 'number', 'status', 'type'];
}
