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
    return view('index');
})->name('index');

Route::get('/event', function () {
    return view('event-detail');
})->name('event-detail');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/organizer', function () {
    return view('organizer.home');
})->name('organizer.home');

Route::get('/organizer/create', function () {
    return view('organizer.create-organization');
})->name('organizer.create-organization');

Route::get('/organizer/events', function () {
    return view('organizer.events');
})->name('organizer.events');

Route::get('/organizer/events/create', function () {
    return view('organizer.create-event');
})->name('organizer.create-event');


Route::get('/organizer/members', function () {
    return view('organizer.members');
})->name('organizer.members');

Route::get('/organizer/events/dashboard', function () {
    return view('organizer.event.dashboard');
})->name('organizer.event.dashboard');

Route::get('/organizer/events/information', function () {
    return view('organizer.event.information');
})->name('organizer.event.information');

Route::get('/organizer/events/financial', function () {
    return view('organizer.event.financial');
})->name('organizer.event.financial');

Route::get('/organizer/events/order/add', function () {
    return view('organizer.event.add-order');
})->name('organizer.event.add-order');

Route::get('/organizer/events/participants', function () {
    return view('organizer.event.participants');
})->name('organizer.event.participants');

Route::get('/organizer/events/tasks/board', function () {
    return view('organizer.event.tasks.board');
})->name('organizer.event.tasks.board');

Route::get('/organizer/events/tasks/list', function () {
    return view('organizer.event.tasks.list');
})->name('organizer.event.tasks.list');

Route::get('/organizer/events/tasks/add', function () {
    return view('organizer.event.tasks.add');
})->name('organizer.event.tasks.add');

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