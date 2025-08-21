<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'category';
    protected $with = ['news'];

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    /**
     * Get all sub categories for this category
     */
    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'parent_category_id');
    }
}
