<?php

namespace App\Http\Controllers;

use App\Filters\MultiFieldSearchFilter;
use App\Http\Requests\User\CreateOrUpdateBookRequest;
use App\Models\Book;
use App\Models\User;
use App\Transformers\BookTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\QueryBuilder\QueryBuilder;
use League\Fractal\Serializer\ArraySerializer as SerializerArraySerializer;
use Spatie\QueryBuilder\AllowedFilter;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        /** @var User $user */
        $user = auth()->user();

        $paginated = QueryBuilder::for(Book::class)
            ->allowedFilters([AllowedFilter::custom('q', new MultiFieldSearchFilter, 'title,description,author_name')])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->paginate();

        $res =  fractal()->collection($paginated, new BookTransformer)->serializeWith(new SerializerArraySerializer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginated))->toArray();

        return response()->json([
            'message' => 'books retrieved successfully',
            'data' => $res['data'],
            'meta' => $res['meta'],


        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateOrUpdateBookRequest $request)
    {
        /** @var User $user */
        $user = auth()->user();

        $book = $user->books()->create($request->validated());

        return response()->json([
            'message' => 'book information stored successfully',
            'data' => fractal()->item($book, new BookTransformer)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateOrUpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return response()->json([
            'message' => 'book information updated successfully',
            'data' => fractal()->item($book, new BookTransformer)
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'book information deleted successfully',

        ]);
    }
}
