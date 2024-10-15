<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'user_id','file_path'];

    // Document belongs to a Category
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }

    // Document belongs to a User (the creator of the document)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
