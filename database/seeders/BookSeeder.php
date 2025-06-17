<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // إنشاء مجلد الصور إذا لم يكن موجوداً
        if (!Storage::exists('public/book_covers')) {
            Storage::makeDirectory('public/book_covers');
        }

        $categories = [
            'Programming', 'Web Development', 'Science Fiction',
            'Biography', 'History', 'Self Help',
            'Fantasy', 'Business', 'Cooking', 'Art'
        ];

        for ($i = 0; $i < 30; $i++) {
            $title = $this->generateBookTitle();

            Book::create([
                'title' => $title,
                'type' => fake()->randomElement($categories),
                'description' => $this->generateDescription(),
                'cover_image' => $this->generateCoverImage($title),
                'price' => fake()->randomFloat(2, 9.99, 99.99),
                'author_id' => fake()->numberBetween(1, 15),
                'pubId' => fake()->numberBetween(1, 10)
            ]);
        }

    }
   protected function generateBookTitle(): string
    {
        $adjectives = ['Advanced', 'Complete', 'Essential', 'Practical', 'The Art of'];
        $topics = ['Programming', 'Web Development', 'Algorithms', 'Database', 'Design Patterns'];
        $nouns = ['Guide', 'Handbook', 'Mastery', 'Secrets', 'Fundamentals'];

        return fake()->randomElement($adjectives) . ' ' .
               fake()->randomElement($topics) . ' ' .
               fake()->randomElement($nouns);
    }

    protected function generateDescription(): string
    {
        return implode("\n\n", fake()->paragraphs(3));
    }

    protected function generateCoverImage(string $title): string
    {
        // استخدام خدمة Unsplash للحصول على صور واقعية
        $searchTerms = ['book', 'cover', Str::slug($title), 'technology'];
        $randomTerm = fake()->randomElement($searchTerms);

        return 'https://source.unsplash.com/random/300x400/?' . $randomTerm;
    }
}
