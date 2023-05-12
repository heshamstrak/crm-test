<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['title', 'description', 'deadline', 'user_id', 'client_id', 'status'];
    use HasFactory;

    public function client()
    {
        return $this->belongsTo('App\Models\Admin\Client', 'client_id', 'id')->first();
    }// end of client

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id')->first();
    }// end of user


}
