<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteForYourCity extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'vote_for_your_city';
    protected $primaryKey = 'id';
    protected $fillable = ['description', 'status'];
}
