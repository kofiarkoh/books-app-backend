<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class MultiFieldSearchFilter implements Filter
{

    public function __invoke(Builder $query, $value, string $property)
    {
        $search = '%' . $value . '%';

        $fields = explode(',', $property);

        foreach ($fields as $field) {
            $query = $query->orWhere($field, 'like', $search);
        }

        // $query->where('first_name', 'like', $search)->orWhere('last_name', 'like', $search)->orWhere('email', 'like', $search);
    }
}
