<?php

namespace App\Models;

class User extends Model
{
    public static string $table = 'users';

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public ?string $created_at = null;
    public ?string $updated_at = null;
}
