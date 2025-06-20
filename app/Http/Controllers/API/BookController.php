<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



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
// if ($request->hasFile('cover_image')) {
//     $image = $request->file('cover_image');
//     $filename = uniqid() . '.' . $image->getClientOriginalExtension();

//     // يخزن في storage/app/public/book_covers
//     $path = $image->storeAs('public/book_covers', $filename);

//     $data['cover_image'] = 'storage/book_covers/' . $filename;
// }
 if ($request->hasFile('cover_image')) {
        $uploadedFileUrl = Cloudinary::upload($request->file('cover_image')->getRealPath())->getSecurePath();
        $data['cover_image'] = $uploadedFileUrl; // رابط مباشر للصورة
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
    // if ($request->hasFile('cover_image')) {
    //     // حذف الصورة القديمة إذا كانت موجودة
    //     if ($book->cover_image) {
    //         // احذف من المسار داخل public فقط
    //         $oldPath = str_replace('storage/', '', $book->cover_image);
    //         Storage::disk('public')->delete($oldPath);
    //     }
    //     $image = $request->file('cover_image');
    //     $filename = uniqid() . '.' . $image->getClientOriginalExtension();
    //     $path = $image->storeAs('public/book_covers', $filename);
    //     $data['cover_image'] = 'storage/book_covers/' . $filename;
    // }

     if ($request->hasFile('cover_image')) {
        // لا حاجة لحذف من التخزين المحلي بعد الآن، فقط نحذف القديم من Cloudinary إن أردت (اختياري)

        $uploadedFileUrl = Cloudinary::upload($request->file('cover_image')->getRealPath())->getSecurePath();
        $data['cover_image'] = $uploadedFileUrl;
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
