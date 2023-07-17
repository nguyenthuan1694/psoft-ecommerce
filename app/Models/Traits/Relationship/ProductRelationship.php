<?php

namespace App\Models\Traits\Relationship;

trait ProductRelationship
{
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'product_category');
    }

    // public function tags()
    // {
    //     return $this->morphToMany('App\Models\Tag', 'taggable');
    // }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    // public function promotions()
    // {
    //     return $this->hasMany('App\Models\ProductPromotion', 'product_id', 'id');
    // }

    /**
     * Get the order_detail that owns the comment.
     */
    public function order_detail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
