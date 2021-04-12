<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'age',
        'gender',
        'city',
        'class',
        'country',
        'phone',
        'email',
        'trainer',
        'club',
        'dance',
        'time',
        'kindexercise',
        'parentname',
        'parentphone',
        'parentemail',
        'status',
        'memberable_id',
        'memberable_type'
    ];
    public function competitions()
    {
       return $this->morphedByMany('App\Competition', 'memberable');
    }
}
