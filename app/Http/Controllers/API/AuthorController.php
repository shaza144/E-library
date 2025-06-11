<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function store(AuthorRequest $request)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Admins only.'], 403);
        }

        $author = Author::create($request->validated());

        return response()->json([
            'message' => 'Author created successfully',
            'author' => $author
        ], 201);
    }

    // 📖 عرض جميع المؤلفين
    public function index()
    {
        $authors = Author::all();

        return response()->json($authors);
    }

    // 🔍 بحث جزئي باسم المؤلف
    public function search(Request $request)
    {
        $query = $request->input('q');
        $authors = Author::where('fname', 'like', "%$query%")
            ->orWhere('lname', 'like', "%$query%")
            ->get();

        return response()->json($authors);
    }

    // 📚 عرض كتب مؤلف معيّن
    public function books($id)
    {
        $author = Author::with('books.publisher')->findOrFail($id);

        return response()->json([
            'author' => $author->fname . ' ' . $author->lname,
            'books' => $author->books
        ]);
    }

    // تعديل بيانات مؤلف
    public function update(AuthorRequest $request, $id)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Admins only.'], 403);
        }
        $author = Author::findOrFail($id);
        $author->update($request->validated());

        return response()->json([
            'message' => 'Author updated successfully',
            'author' => $author
        ]);
    }

    // حذف مؤلف
    public function destroy($id)
    {
        if (!auth()->user() || !auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized. Admins only.'], 403);
        }
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json([
            'message' => 'Author deleted successfully'
        ]);
    }
}
