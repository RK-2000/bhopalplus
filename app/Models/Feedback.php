<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $fillable = ['star', 'feedback', 'status', 'user_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
