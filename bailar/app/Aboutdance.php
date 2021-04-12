<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreateImage;

class Aboutdance extends Model
{
    use CreateImage;

    protected $table = 'aboutdances';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        
    ];
    public static $VALIDATION_RULES = [
        'title'=>['required','regex:/\w*\W*/', 'min:3','max:300'],
        'description'=>['required', 'string', 'min:3', 'max:10000'],
    ];
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
