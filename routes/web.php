<?php
// routes\web.php
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

Route::get('/user-search', function (Request $request) {
    $id = $request->input('id');
    if($id) {
        $users = DB::select("SELECT * FROM users WHERE id = $id");
        return response()->json($users);
    }
    return response()->json(['message' => 'Please provide id parameter']);
})->name('user.search');

Route::get("login", [AuthManager::class,"login"])
        ->name("login");

Route::post("login", [AuthManager::class,"loginPost"])
                ->name("login.post");

Route::get("logout", [AuthManager::class,"logout"])
        ->name("logout");

Route::get("register", [AuthManager::class,"register"])
        ->name("register");

Route::post("register", [AuthManager::class,"registerPost"])
        ->name("register.post");

// Route untuk search user (SQL Injection point)
Route::get("search", [AuthManager::class,"searchUser"])
        ->name("search.user");

Route::middleware("auth")->group(function (){

    Route::get('/', [TaskManager::class, "listTask"])->name('home');

    Route::get("task/add", [TaskManager::class,"addTask"])->name("task.add");

    Route::post("task/add", [TaskManager::class,"addTaskPost"])->name("task.add.post");

    Route::get("task/status/{id}", [TaskManager::class,"updateTaskStatus"])->name("task.status.update");

    Route::get("task/delete/{id}", [TaskManager::class,"deleteTask"])->name("task.delete");

    // Route untuk update profile (XSS point)
    Route::post("profile/update", [AuthManager::class,"updateProfile"])->name("profile.update");

    // Route untuk comment system (XSS point)
    Route::post("comment/add", function(Request $request) {
        $comment = $request->input('comment');
        $user_id = Auth::user()->id;

        // Insert comment tanpa sanitasi - XSS vulnerability
        DB::insert("INSERT INTO comments (user_id, comment, created_at) VALUES (?, '$comment', NOW())", [$user_id]);

        return redirect()->back()->with('success', 'Comment added: ' . $comment);
    })->name('comment.add');

    // Route untuk display comments
    Route::get("comments", function() {
        $comments = DB::select("SELECT c.comment, u.name FROM comments c JOIN users u ON c.user_id = u.id ORDER BY c.created_at DESC");
        return view('comments', compact('comments'));
    })->name('comments.view');
});
