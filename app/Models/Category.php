<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    protected $table = 'categories';
    protected $guarded = [];


    public function items()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


    public function subCategory()
    {
        return $this->hasMany(Category::class, 'category_up', 'id');
    }

    public function category()
    {
        return $this->hasone(Category::class, 'id', 'category_up');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
