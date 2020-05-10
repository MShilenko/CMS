<?php

namespace App\CoreClasses;

use \App\Exceptions\NotFoundException;
use \App\Model\Book;

class Controller
{
    public function index()
    {
        return new View('index', ['title' => 'Index Page']);
    }

    public function about()
    {
        return new View('company.about', ['title' => 'About company']);
    }

    public function allBooks()
    {
        return new View('book.all', Book::all()->toArray());
    }

    public function book(int $id)
    {
        if ($book = Book::find($id)) {
            return new View('book.current', $book->toArray());
        }

        throw new NotFoundException('Страница не найдена', 404);
    }
}
