<?php

namespace Uiaciel\Adminblog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'status',
        'type',
        'lang',
        'date',
        'id_category',
        'content',
        'excerpt',
        'post_id',
        'count'


    ];

    public function image()
    {
        return $this->hasOne('Uiaciel\Adminblog\Models\Image', 'post_id');
    }

    public function category()
    {
        return $this->belongsTo('Uiaciel\Adminblog\Models\Category', 'id_category');
    }
}
