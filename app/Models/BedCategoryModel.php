<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedCategoryModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'beds_category';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'available', 'capacity', 'status'];
}
