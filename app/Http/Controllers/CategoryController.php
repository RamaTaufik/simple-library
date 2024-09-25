<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category = Category::get();

        return view('admin.category', compact('category'));
    }
    
    public function create(Request $request) 
    {
        Validator::make($request->all(), [
            'name' => ['required','string'],
        ], [
            'name' => 'Nama tidak sesuai',
        ]);
        Category::create([
            'name' => $request['name'],
        ]);

        return redirect()->route('admin.category');
    }

    public function update(Request $request) 
    {
        Category::find($request->category_id)->update([
            'name' => $request['name'],
        ]);

        return redirect()->route('admin.category');
    }

    public function destroy($id) 
    {
        Category::find($id)->delete();

        return redirect()->back();
    }
}
