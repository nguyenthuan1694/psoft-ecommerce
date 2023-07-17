<?php

namespace App\Models\Traits\Relationship;

trait OrderDetailRelationship
{
    public function order()
    {
        $this->belongsTo('App\Models\Order');
    }

    /**
     * Get the products that owns the comment.
     */
    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
}
