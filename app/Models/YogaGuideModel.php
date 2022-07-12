<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YogaGuideModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'yoga_guide';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'date_time', 'description_agenda', 'google_meet_url', 'youtube_link', 'contact_address', 'contact_number', 'banner_image'];

    public function youtubelink()
    {
        return $this->hasMany(YoutubelinkModel::class, 'yoga_guide_id', 'id')->where('type', 'yogaguide');
    }
    public function imageyoga()
    {
        return $this->hasMany(ImageModel::class, 'image_id', 'id')->where('type', 'yogaguide');
    }
}
