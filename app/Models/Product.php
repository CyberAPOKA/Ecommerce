<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'category',
        'color',
        'description',
        'details',
        'views'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function genders()
    {
        return $this->belongsToMany(Gender::class);
    }

    public function highlights()
    {
        return $this->hasMany(Highlight::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'evaluations');
    }
}
