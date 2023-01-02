<?php namespace App\Models;

use Framework\Model;

class BlogPost extends Model
{
    protected $table = 'blogposts';
    protected array $fields = ['title', 'body', 'published', 'image_url'];
    
}