<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Observer extends Model
{
    

    protected $fillable = [
        'uri','ip','explain','event','ipcountry','user_agent','headers','host','referer'
    ];
}
