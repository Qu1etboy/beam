<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrantQuestionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;
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
Route::get('/orders', [UserController::class, 'orders'])->name('orders');
Route::get('/settings', [UserController::class, 'settings'])->name('settings');
Route::put('/settings', [UserController::class, 'update'])->name('settings.update');
Route::get('/organizer', [OrganizerController::class, 'home'])->name('organizer.home');
Route::get('/organizer/create', [OrganizerController::class, 'createOrganization'])->name('organizer.create-organization');
Route::post('/organizer/create', [OrganizerController::class, 'storeOrganization'])->name('organizer.store-organization');

// Define routes related to organizer
Route::prefix('organizer/{organizer}')->group(function () {
    Route::get('/', [OrganizerController::class, 'events'])->name('organizer.events');
    Route::get('/events/create', [OrganizerController::class, 'createEvent'])->name('organizer.create-event');
    Route::post('/events/create', [OrganizerController::class, 'storeEvent'])->name('organizer.store-event');
    Route::get('/members', [OrganizerController::class, 'members'])->name('organizer.members');
    Route::post('/members/add', [OrganizerController::class, 'addMember'])->name('organizer.add-member');
    // Define routes related to event
    Route::group(['prefix' => 'events'], function () {
        Route::get('/dashboard', function () {
            return view('organizer.event.dashboard');
        })->name('organizer.event.dashboard');
        Route::get('/information', function () {
            return view('organizer.event.information');
        })->name('organizer.event.information');
        Route::get('/financial', function () {
            return view('organizer.event.financial');
        })->name('organizer.event.financial');
        Route::get('/order/add', function () {
            return view('organizer.event.add-order');
        })->name('organizer.event.add-order');
        Route::get('/participants', function () {
            return view('organizer.event.participants');
        })->name('organizer.event.participants');
        // Define routes related to event tasks
        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/board', function () {
                return view('organizer.event.tasks.board');
            })->name('organizer.event.tasks.board');
            Route::get('/list', function () {
                return view('organizer.event.tasks.list');
            })->name('organizer.event.tasks.list');
            Route::get('/add', function () {
                return view('organizer.event.tasks.add');
            })->name('organizer.event.tasks.add');
        });
    });
});

// Define routes for profile operations with auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Test get rich text editor content
 */
Route::post('/test/create/event', function (Request $request) {

    // Rich text editor content -> HTML
    $description = $request->get('description');
    
    return gettype($description); // It a string!
})->name('test.create.event');

/**
 * Sample on how to upload a file in laravel
 */
Route::post('/test/file', function (Request $request) {

    $request->validate([
        'fileName' => ['required', 'string', 'max:255'],
        'image' => ['required', 'file', 'image', 'max:2048']
    ]);

    // NOTE: If not specified file name, laravel will generate for us.
    // Specified file name and store in storage
    $file = $request->file('image');
    $path = $file->storeAs(
        'public/images',
        $request->get('fileName') . '.' . $file->getClientOriginalExtension()
    );

    $filePath = str_replace('public/', '', $path);

    return redirect(asset('storage/' . $filePath));
})->name('test.file');

require __DIR__ . '/auth.php';