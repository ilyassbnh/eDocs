<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // You can define relationships for permission, e.g., roles or users
    // If you are using a package like Laratrust, these relationships can be configured here.

    // Example: A Permission may belong to many Roles (if using a pivot table)
    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class);
    // }
}
