<?php

namespace App\Transformers;

use App\Models\Book;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{

    public function transform(Book $book): array
    {
        return [

            'uuid' => $book->uuid,
            'title' => $book->title,
            'description' => $book->description,
            'author_name' => $book->author_name

        ];
    }
}
