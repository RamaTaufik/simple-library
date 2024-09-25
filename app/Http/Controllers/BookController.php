<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.book');
    }
    
    public function create(Request $request) 
    {
        Validator::make($request->all(), [
        ], [
        ]);
        Book::create([
        ]);

        return redirect()->route('admin.book');
    }

    public function activate($id) 
    {
        $product = Book::find($id);
        $product->is_active = 'true';
        $product->save();

        return redirect()->route('admin.book');
    }

    public function inactivate($id) 
    {
        $product = Book::find($id);
        $product->is_active = 'false';
        $product->save();

        return redirect()->route('admin.book');
    }

    public function update() {}

    public function destroy() {}
}
