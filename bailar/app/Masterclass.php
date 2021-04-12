<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masterclass extends Model
{
    protected $table = 'masterclasses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'city',
        'date',
        'date_begin',
        'date_end',
        'path',
        'address',
        'contacts',
        'age',
        'kind',
        'duration',
        'price',
        'recording',
        'lat',
        'lng',
        'school_id'];
    public static $VALIDATION_RULES =[
        'title'=>['required', 'regex:/^[\w\- \p{Cyrillic}]*$/u', 'min:3', 'max:300'],
        'path'=>['required', 'string', 'min:3', 'max:300'],
        'city'=>['required', 'string', 'min:3'],
        'date'=>['required','date_format:"Y-m-d"'],
        'date_begin'=>['required','date_format:"Y-m-d"'],
        'date_end'=>['required','date_format:"Y-m-d"'],
        'address'=>['required', 'string', 'min:3', 'max:300'],
        'contacts'=>['required', 'string', 'min:3', 'max:19'],
        'age'=>['date_format:"Y-m-d"'],
        'kind'=>['required', 'regex:/^[\w\- \p{Cyrillic}]*$/u', 'min:3', 'max:300'],
        'duration'=>['regex:/^[\w\- \p{Cyrillic}]*$/u'],
        'price'=>['required', 'numeric', 'min:3', 'max:100000'],
        'recording'=>['required', 'numeric', 'min:3', 'max:1000'],
    ];
    public function images()
    {
        return $this->morphMany('App\Image', 'imageable');
    }
}
