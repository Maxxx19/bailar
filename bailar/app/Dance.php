<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dance extends Model
{
    //
    protected $table = 'dances';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        
    ];
    public static $VALIDATION_RULES = [
        'title'=>['required','regex:/\w*\W*/', 'min:3','max:300'],
        'description'=>['required', 'string', 'min:3', 'max:10000'],
    ];

    public function schools()
    {
       return $this->morphedByMany('App\School', 'dancable');
    }
    public function dancepartners()
    {
       return $this->morphedByMany('App\Dancepartner', 'dancable');
    }
    public function choreographers()
    {
       return $this->morphedByMany('App\Choreographer', 'dancable');
    }
    public function competitions()
    {
       return $this->morphedByMany('App\Competition', 'dancable');
    }
    public function conquers()
    {
       return $this->morphedByMany('App\Conquer', 'dancable');
    }
    public function parties()
    {
       return $this->morphedByMany('App\Party', 'dancable');
    }
}
