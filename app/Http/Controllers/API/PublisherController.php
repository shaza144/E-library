<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function store(PublisherRequest $request)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $publisher = Publisher::create($request->validated());

        return response()->json([
            'message' => 'Publisher created successfully',
            'publisher' => $publisher
        ], 201);
    }

    // عرض كل الناشرين
    public function index()
    {
        return response()->json(Publisher::all());
    }

    // بحث جزئي باسم الناشر
    public function search(Request $request)
    {
        $query = $request->input('q');
        $publishers = Publisher::where('pname', 'like', "%$query%")->get();

        return response()->json($publishers);
    }

    // عرض الكتب لناشر معيّن
    public function books($id)
    {
        $publisher = Publisher::with('books.author')->findOrFail($id);

        return response()->json([
            'publisher' => $publisher->pname,
            'books' => $publisher->books
        ]);
    }

    // تعديل ناشر
    public function update(PublisherRequest $request, $id)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $publisher = Publisher::findOrFail($id);
        $publisher->update($request->validated());

        return response()->json([
            'message' => 'Publisher updated successfully',
            'publisher' => $publisher
        ]);
    }

    // حذف ناشر
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return response()->json([
            'message' => 'Publisher deleted successfully'
        ]);
    }
}
