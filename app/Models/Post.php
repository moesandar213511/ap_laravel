<?php

namespace App\Models;

use App\Mail\PostStored;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','category_id','user_id']; //fillable is better for security  or protected $guarded = [];

    // protected $table = 'post';

    public function categories()// table name နဲ့တူပေး။
    {
        return $this->belongsTo('App\Models\Category','category_id');
        // category_id is foreign key
    }

    // protected static function booted()
    // {
    //     static::created(function ($post) {
    //         Mail::to('moesandar213511@gmail.com')->send(new PostStored($post));
    //     });
    // }
}
