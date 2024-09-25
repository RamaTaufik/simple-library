<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::insert([[
            'title' => "Harry Potter: Philosopher's Stone",
            'author' => 'J.K. Rowling',
            'category_id' => 4,
            'published_year' => 1997,
            'is_active' => true,
        ],[
            'title' => "Harry Potter: Chamber of Secrets",
            'author' => 'J.K. Rowling',
            'category_id' => 4,
            'published_year' => 1998,
            'is_active' => true,
        ],[
            'title' => "Harry Potter: Prisoner of Azkaban",
            'author' => 'J.K. Rowling',
            'category_id' => 4,
            'published_year' => 1999,
            'is_active' => true,
        ],[
            'title' => "Harry Potter: Goblet of Fire",
            'author' => 'J.K. Rowling',
            'category_id' => 4,
            'published_year' => 2000,
            'is_active' => false,
        ],[
            'title' => "Uzumaki",
            'author' => 'Junji Ito',
            'category_id' => 3,
            'published_year' => 1999,
            'is_active' => true,
        ],[
            'title' => "Dune",
            'author' => 'Frank Herbert',
            'category_id' => 1,
            'published_year' => 1965,
            'is_active' => true,
        ]]);
    }
}
