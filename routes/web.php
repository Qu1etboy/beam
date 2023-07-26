<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/event', function () {
    return view('event-detail');
});

Route::get('/organizer/events', function () {
    return view('organizer.events');
});

Route::get('/organizer/events/create', function () {
    return view('organizer.create-event');
});


Route::get('/organizer/members', function () {
    return view('organizer.members');
});

Route::get('/organizer/events/dashboard', function () {
    return view('organizer.event.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Sample on how to upload a file in laravel
 */
Route::post('/test/file', function(Request $request) {
    
    $request->validate([
        'fileName' => ['required', 'string', 'max:255'],
        'image' => ['required', 'file', 'image', 'max:2048']
    ]);
    
    // NOTE: If not specified file name, laravel will generate for us.
    // Specified file name and store in storage
    $file = $request->file('image');
    $path = $file->storeAs(
        'public/images', $request->get('fileName') . '.' . $file->getClientOriginalExtension()
    );
 
    $filePath = str_replace('public/', '', $path);

    return redirect(asset('storage/' . $filePath));
})->name('test.file');

require __DIR__.'/auth.php';