<?php


namespace Step\Controllers;

use Klein\Request;
use Step\Core\Hash;
use Step\Models\Book;
use Step\Models\User;

class SiteController
{
    function index() {

        $books = Book::all();
        $books = array_reverse($books);
        $books = array_slice($books, 0, 3);

        return view('index', [
            'title' => 'Главная',
            'books' => $books
        ]);
    }
}
