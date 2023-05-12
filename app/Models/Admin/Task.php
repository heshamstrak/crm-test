<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'deadline', 'project_id', 'status'];
    use HasFactory;

    public function project()
    {
        return $this->belongsTo('App\Models\Admin\Project', 'project_id', 'id')->first();
    }// end of Project

}
