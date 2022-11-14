<?php

namespace App\Models\Traits\Attribute;

/**
 * Trait CommentAttribute
 * @package App\Models\Traits\Attribute
 */
trait BillAttribute
{
    public function getParentNameAttribute()
    {
        return isset($this->parent) ? $this->parent->name : '';
    }
}
