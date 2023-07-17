<?php

namespace App\Models;

use App\Models\Traits\Attribute\ProductAttribute;
use App\Models\Traits\Relationship\ProductRelationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Laravel\Scout\Searchable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Product extends Model implements Searchable
{
    use ProductRelationship,
        ProductAttribute,
        SoftDeletes
        ;

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    protected $with = ['images'];

    public $asYouType = true;

    public function getSearchResult(): SearchResult
    {
        $url = route('products.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url,
        );
    }
}
