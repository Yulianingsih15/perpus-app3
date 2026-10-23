<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookController extends Controller
{
    // 1. Menampilkan daftar semua buku dengan fitur pencarian & paginasi
    public function index(Request $request)
    {
        $books = Book::when($request->search, function ($query, $search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('pengarang', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return Inertia::render('Books/Index', [
            'books' => $books,
            'search' => $request->search,
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
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku',
            'judul'     => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit'  => 'nullable|max:255',
            'tahun'     => 'nullable|digits:4',
            'stok'      => 'required|integer|min:0',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    // 4. Menampilkan formulir edit buku (menggunakan Route Model Binding)
    public function edit(Book $book)
    {
        return Inertia::render('Books/Edit', [
            'book' => $book
        ]);
    }

    // 5. Memperbarui data buku di database
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,' . $book->id,
            'judul'     => 'required|max:255',
            'pengarang' => 'required|max:255',
            'penerbit'  => 'nullable|max:255',
            'tahun'     => 'nullable|digits:4',
            'stok'      => 'required|integer|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui');
    }

    // 6. Menghapus data buku
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus');
    }
}