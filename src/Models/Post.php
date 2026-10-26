<?php

namespace App\Models;

class Post extends Model
{
    public static string $table = 'posts';

    public string $title = '';
    public string $body = '';
    public string $author = '';
    public string $category = '';
    public ?string $image_path = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
}
