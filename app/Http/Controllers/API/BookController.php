<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
        //  إضافة كتاب (Admin فقط)
    public function store(BookRequest $request)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


       $data = $request->validated();
              /**
 * @var \Illuminate\Http\Request|\App\Http\Requests\CarRequest $request
 */
        // معالجة رفع الصورة
        // if ($request->hasFile('cover_image')) {
        //     $data['cover_image'] = asset('storage/' . $request->file('cover_image')->store('book_covers', 'public'));

        //     // $data['cover_image'] = $request->file('cover_image')->store('book_covers', 'public');
        // }
if ($request->hasFile('cover_image')) {
    $image = $request->file('cover_image');
    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
    $image->move(public_path('book_covers'), $filename);

    // حفظ الرابط الكامل
    $data['cover_image'] = url('book_covers/' . $filename);
}

        $book = Book::create($data);

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book
        ], 201);
    }

    //  عرض كل الكتب
    public function index()
    {
        // return Book::with(['author', 'publisher'])->paginate(10);
         $books = Book::with(['author', 'publisher'])->paginate(10);
    return response()->json($books);
    }

    //  عرض تفاصيل كتاب محدد
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

    //  تعديل كتاب
    public function update(BookRequest $request, $id)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $book = Book::findOrFail($id);
         $data = $request->validated();
              /**
 * @var \Illuminate\Http\Request|\App\Http\Requests\CarRequest $request
 */
        // معالجة رفع الصورة الجديدة
        if ($request->hasFile('cover_image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('book_covers', 'public');
        }

        $book->update($data);

        return response()->json(['message' => 'Book updated successfully', 'book' => $book]);

    }

    // حذف كتاب
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
$book = Book::findOrFail($id);

        // حذف الصورة المرتبطة إذا كانت موجودة
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }
}
