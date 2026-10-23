<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    // 1. Menampilkan daftar semua buku
    public function index()
    {
        $books = Book::all();
        return Inertia::render('Books/Index', [
            'books' => $books
        ]);
    }

    // 2. Menampilkan formulir tambah buku
    public function create()
    {
        return Inertia::render('Books/Create');
    }

    // 3. Menyimpan buku baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:books',
            'judul'     => 'required',
            'pengarang' => 'required',
            'penerbit'  => 'nullable',
            'tahun'     => 'nullable',
            'stok'      => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index');
    }

    // 4. Menampilkan formulir edit buku (Ini yang tadi kurang)
    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book
        ]);
    }

    // 5. Memperbarui data buku di database
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $book->id,
            'judul'     => 'required',
            'pengarang' => 'required',
            'penerbit'  => 'nullable',
            'tahun'     => 'nullable',
            'stok'      => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index');
    }

    // 6. Menghapus data buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index');
    }
}