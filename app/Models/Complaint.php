<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'complaint';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'phone_code', 'number', 'status', 'type'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
