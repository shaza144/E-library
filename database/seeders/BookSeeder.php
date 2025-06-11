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
         $books = [
            ['title' => 'Learn Laravel Basics', 'type' => 'Programming', 'price' => 15.5, 'pubId' => 1, 'author_id' => 1],
            ['title' => 'PHP for Beginners', 'type' => 'Programming', 'price' => 10.0, 'pubId' => 2, 'author_id' => 2],
            ['title' => 'The Art of Flutter', 'type' => 'Mobile Dev', 'price' => 18.0, 'pubId' => 3, 'author_id' => 3],
            ['title' => 'Introduction to AI', 'type' => 'AI', 'price' => 22.5, 'pubId' => 4, 'author_id' => 4],
            ['title' => 'Data Structures in Depth', 'type' => 'CS', 'price' => 20.0, 'pubId' => 5, 'author_id' => 5],
            ['title' => 'Machine Learning Guide', 'type' => 'AI', 'price' => 25.0, 'pubId' => 6, 'author_id' => 6],
            ['title' => 'Web Development Handbook', 'type' => 'Web', 'price' => 17.0, 'pubId' => 7, 'author_id' => 7],
            ['title' => 'Mastering JavaScript', 'type' => 'Web', 'price' => 16.0, 'pubId' => 8, 'author_id' => 8],
            ['title' => 'Android Development', 'type' => 'Mobile Dev', 'price' => 19.5, 'pubId' => 9, 'author_id' => 9],
            ['title' => 'Algorithms Unlocked', 'type' => 'CS', 'price' => 21.0, 'pubId' => 10, 'author_id' => 10],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
