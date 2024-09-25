<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $search)
    {
        $searchIndex = $search['search'];
        $book = Book::where('is_active', true)->where('title', 'LIKE', '%'.$searchIndex.'%')->paginate(20);
        $category = Category::get();

        return view('admin.book', compact(['book','category']));
    }

    public function inactiveBooks(Request $search)
    {
        $searchIndex = $search['search'];
        $book = Book::where('is_active', false)->where('title', 'LIKE', '%'.$searchIndex.'%')->paginate(20);
        $category = Category::get();

        return view('admin.book-inactive', compact(['book','category']));
    }
    
    public function create(Request $request) 
    {
        $request->validate([
            'title' => ['required','string'],
            'author' => ['required','string'],
            'category_id' => ['required','exists:categories,id'],
            'published_year' => ['required','integer','digits:4'],
        ], [
            'title' => 'Judul tidak sesuai',
            'author' => 'Penulis tidak sesuai',
            'category_id' => 'Kategori tidak sesuai',
            'published_year' => 'Tahun terbit tidak sesuai',
        ]);
        Book::create([
            'title' => $request['title'],
            'author' => $request['author'],
            'category_id' => $request['category_id'],
            'published_year' => $request['published_year'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.book');
    }

    public function activate($id) 
    {
        $product = Book::find($id);
        $product->is_active = true;
        $product->save();

        return redirect()->back();
    }

    public function inactivate($id) 
    {
        $product = Book::find($id);
        $product->is_active = false;
        $product->save();

        return redirect()->back();
    }

    public function update(Request $request) 
    {
        $request->validate([
            'title-edit' => ['required','string'],
            'author-edit' => ['required','string'],
            'category_id-edit' => ['required','exists:categories,id'],
            'published_year-edit' => ['required','integer','digits:4'],
        ], [
            'title-edit' => 'Judul tidak sesuai',
            'author-edit' => 'Penulis tidak sesuai',
            'category_id-edit' => 'Kategori tidak sesuai',
            'published_year-edit' => 'Tahun terbit tidak sesuai',
        ]);
        Book::find($request->book_id)->update([
            'title' => $request['title-edit'],
            'author' => $request['author-edit'],
            'category_id' => $request['category_id-edit'],
            'published_year' => $request['published_year-edit'],
        ]);

        return redirect()->back();
    }

    public function destroy($id) 
    {
        Book::find($id)->delete();

        return redirect()->back();
    }
}
