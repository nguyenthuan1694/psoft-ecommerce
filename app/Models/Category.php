<?php

namespace App\Models;

use App\Models\Traits\Attribute\CategoryAttribue;
use App\Models\Traits\Relationship\CategoryRelationship;
use App\Models\Traits\Scope\CategoryScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Category extends Model implements Searchable
{
    use CategoryAttribue,
        CategoryScope,
        CategoryRelationship;

    protected $guarded = ['id'];

    protected $table = 'categories';

    protected $with = ['children', 'products'];

    protected $dates = ['created_at', 'updated_at'];

    public function getSearchResult(): SearchResult
    {
        $url = route('categories.show', $this->id);

        return new SearchResult(
            $this,
            $this->name,
            $url
        );
    }
}
