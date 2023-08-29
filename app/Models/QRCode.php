<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;


class QRCode extends Model
{
    protected $connection = 'mongodb';

    use HasFactory;
    protected $collection = 'qr_codes';


    protected $fillable = [
        'brand_logo_circle',
        'brand_logo_rectangle',
        'brand_name',
        'brand_title',
        'background_color',
        'background_gradient',
        'background_gradient_1',
        'custom_url',  //JSON field
        'social_media_link',
        'social'
    ];
}
// brand_logo_circle
// brand_logo_rectangle
// brand_name
// brand_title
// background_color
// background_gradient
// custom_url -> Json
// social_media_link