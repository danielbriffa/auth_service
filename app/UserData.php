<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table = 'user_data';
    //UserData table is just an 1-1 extenstion of users table
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //cast json column to array
    protected $casts = [
        'data' => 'array'
    ];
}
