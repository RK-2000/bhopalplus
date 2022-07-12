<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubelinkModel extends Model
{
    use HasFactory;
    use HasFactory;
    public $timestamps = false;
    protected $table = 'youtube_link';
    protected $primaryKey = 'id';
    protected $fillable = ['yoga_guide_id', 'url', 'type'];
}
