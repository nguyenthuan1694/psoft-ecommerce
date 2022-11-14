<?php


namespace App\Models\Traits\Relationship;


trait BillDetailRelationship
{
    public function books()
    {
        return $this->hasMany('App\Models\Book', 'id', 'book_id');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\Bill', 'id', 'bill_id');
    }
}
