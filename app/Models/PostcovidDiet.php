<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostcovidDiet extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'post_covid_diet';
    protected $primaryKey = 'id';
    protected $fillable = ['image', 'title', 'status'];
}
