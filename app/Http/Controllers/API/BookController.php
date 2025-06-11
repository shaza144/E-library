<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
        //  إضافة كتاب (Admin فقط)
    public function store(BookRequest $request)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = Book::create($request->validated());

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book
        ], 201);
    }

    // 📚 عرض كل الكتب
    public function index()
    {
        return Book::with(['author', 'publisher'])->get();
    }

    // 🔍 عرض تفاصيل كتاب محدد
    public function show($id)
    {
        $book = Book::with(['author', 'publisher'])->findOrFail($id);

        return response()->json($book);
    }

    //  بحث بعنوان جزئي
    public function search(Request $request)
    {
        $q = $request->input('q');

        $books = Book::with(['author', 'publisher'])
                    ->where('title', 'like', "%$q%")
                    ->get();

        return response()->json($books);
    }

    // ✏️ تعديل كتاب
    public function update(BookRequest $request, $id)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = Book::findOrFail($id);
        $book->update($request->validated());

        return response()->json(['message' => 'Book updated successfully', 'book' => $book]);
    }

    // حذف كتاب
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        Book::findOrFail($id)->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
