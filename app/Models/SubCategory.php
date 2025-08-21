<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'sub_categories';

    /**
     * Get the parent category that owns the SubCategory
     */
    public function parentCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }

    /**
     * Get all news for this sub category
     */
    public function news(): HasMany
    {
        return $this->hasMany(News::class, 'sub_category_id');
    }
}
