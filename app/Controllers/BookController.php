<?php


namespace Step\Controllers;


use Klein\Request;
use Klein\Response;
use Step\Core\Auth;
use Step\Models\Book;

class BookController
{

    function index() {
        return view('books.index', [
            'books' => Book::all(),
            'title' => 'Книги'
        ]);
    }

    function show(Request $request, Response $response) {
        $id = $request->param('id');
        $book = Book::find_by_id($id);
        if ($book === null)
            return $response->code(404);

        return view('books.show', [
            'book' => $book
        ]);
    }

    function create(Request $request, Response $response) {

        if (!Auth::check())
            return $response->code(403);

        return view('books.form');
    }

    function store(Request $request, Response $response) {

        if (!Auth::check())
            return $response->code(403);

        $book = new Book();
        $book->name = $request->param('name');
        $book->user_id = Auth::user()->id;
        $book->save();

        return $response->redirect("/books/{$book->id}");
    }

    function update(Request $request, Response $response) {

        if (!Auth::check())
            return $response->code(403);

        $id = $request->param('id');
        $book = Book::find_by_id($id);

        if ($book === null)
            return $response->code(404);

        return view('books.form', [
            'book' => $book
        ]);
    }

    function edit(Request $request, Response $response) {

        if (!Auth::check())
            return $response->code(403);

        $id = $request->param('id');
        $book = Book::find_by_id($id);

        if ($book === null)
            return $response->code(404);

        $book->name = $request->param('name');
        $book->save();

        return $response->redirect("/books/{$book->id}");
    }

    function delete(Request $request, Response $response) {

        if (!Auth::check())
            return $response->code(403);

        $id = $request->param('id');
        $book = Book::find_by_id($id);

        if ($book === null)
            return $response->code(404);

        $book->delete();
        return $response->redirect('/books');
    }

}
