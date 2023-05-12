<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'image'];
    use HasFactory;

    protected $appends = ['image_path'];

    //attributes ---------------------------------------

    public function getImagePathAttribute()
    {
        return Storage::url($this->image);
    }
}
