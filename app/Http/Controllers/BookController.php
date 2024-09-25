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
        $book = Book::where('is_active', true)->where('title', 'LIKE', '%'.$searchIndex.'%')->get();
        $category = Category::get();

        if(count($book) <= 20) {
            $book->paginate(20);
        }

        foreach($book as $item) {
            $item['category'] = $category->where('id',$item->category_id)->pluck('name')->first();
        }

        return view('admin.book', compact(['book','category']));
    }

    public function inactiveBooks(Request $search)
    {
        $searchIndex = $search['search'];
        $book = Book::where('is_active', false)->where('title', 'LIKE', '%'.$searchIndex.'%')->get();
        $category = Category::get();

        foreach($book as $item) {
            $item['category'] = $category->where('id',$item->category_id)->pluck('name')->first();
        }

        return view('admin.book-inactive', compact(['book','category']));
    }
    
    public function create(Request $request) 
    {
        Validator::make($request->all(), [
            'title' => ['required','string'],
            'author' => ['required','string'],
            'category_id' => ['required','exists:category'],
            'published_year' => ['required','numeric'],
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
        Book::find($request->book_id)->update([
            'title' => $request['title'],
            'author' => $request['author'],
            'category_id' => $request['category_id'],
            'published_year' => $request['published_year'],
        ]);

        return redirect()->back();
    }

    public function destroy($id) 
    {
        Book::find($id)->delete();

        return redirect()->back();
    }
}
