<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrantQuestionController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaskController;
use App\Mail\AcceptedMail;
use App\Mail\WelcomeMail;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


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

Route::get('/', [EventController::class, 'index'])->name('index');

Route::get('/search', [EventController::class, 'search'])->name('events.search');

Route::get('/event/{event}', [EventController::class, 'show'])->name('event-detail');
Route::post('/event/{event}', [EventController::class, 'register'])->name('event-register');

// Define routes that required user to authenticate first to access
Route::middleware('auth')->group(function () {

    Route::get('/orders', [UserController::class, 'orders'])->name('orders');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::put('/settings', [UserController::class, 'update'])->name('settings.update');
    Route::get('/organizer', [OrganizerController::class, 'home'])->name('organizer.home');
    Route::get('/organizer/create', [OrganizerController::class, 'createOrganization'])->name('organizer.create-organization');
    Route::post('/organizer/create', [OrganizerController::class, 'storeOrganization'])->name('organizer.store-organization');
    
    // Define routes related to organizer with only owner and members of the organization can acess
    Route::middleware('check.organizer.access')->group(function () {
        
        Route::prefix('organizer/{organizer}')->group(function () {
            Route::get('/', [OrganizerController::class, 'events'])->name('organizer.events');
            Route::get('/settings', [OrganizerController::class, 'edit'])->name('organizer.edit');
            Route::put('/', [OrganizerController::class, 'update'])->name('organizer.update');
            Route::delete('/', [OrganizerController::class, 'destroy'])->name('organizer.destroy');
            

            Route::get('/events/create', [OrganizerController::class, 'createEvent'])->name('organizer.create-event');
            Route::post('/events/create', [OrganizerController::class, 'storeEvent'])->name('organizer.store-event');
            Route::get('/members', [OrganizerController::class, 'members'])->name('organizer.members');
            Route::post('/members/add', [OrganizerController::class, 'addMember'])->name('organizer.add-member');
            Route::delete('/members/{user}', [OrganizerController::class, 'removeMember'])->name('organizer.remove-member');
            // Define routes related to event
            Route::prefix('events/{event}')->group(function () {
                Route::get('/dashboard', [EventController::class, 'dashboard'])->name('organizer.event.dashboard');
                
                Route::put('/information', [EventController::class, 'updateInformation'])->name('organizer.event.update-information');
                Route::get('/information', [EventController::class, 'information'])->name('organizer.event.information');
                
                Route::post('/publish',[EventController::class, 'togglePublish'])->name('organizer.event.publish');
                
                Route::get('/financial', [OrderController::class, 'financial'])->name('organizer.event.financial');
                
                Route::resource('orders', OrderController::class);
                
                Route::post('/orders/export-csv', [OrderController::class, 'exportOrderToCSV'])->name('orders.export-order-csv');
                Route::post('/orders/export-pdf', [OrderController::class, 'exportOrderToPDF'])->name('orders.export-order-pdf');
                
                Route::get('/participants/submission', [EventController::class, 'participantSubmissions'])->name('organizer.event.participants.submission');
                Route::get('/participants/accepted', [EventController::class, 'participantAccepted'])->name('organizer.event.participants.accepted');
                Route::put('/participants', [EventController::class, 'setParticipantStatus'])->name('organizer.event.set-participants-status');
                
                // Define routes related to event tasks
                Route::resource('task', TaskController::class)->except(['index', 'show']);
                Route::prefix('tasks')->group(function () {
                    Route::get('/board', [TaskController::class, 'board'])->name('organizer.event.tasks.board');
                    Route::get('/list', [TaskController::class, 'list'])->name('organizer.event.tasks.list');
                    Route::put('/board/{task}', [TaskController::class, 'updateStatus'])->name('organizer.event.tasks.update');
                    Route::put('/list/{task}', [TaskController::class, 'updateStatus'])->name('organizer.event.tasks.update');
                    // Route::get('/add', [TaskController::class, 'add'])->name('organizer.event.tasks.add');
                    // Route::post('/store', [TaskController::class, 'store'])->name('organizer.event.tasks.store');
                });
                Route::resource('question', RegistrantQuestionController::class)->except(['create', 'show']);
            });
        });
    });
});




// ------------------- for show view -------------------

// Route::get('/', function () {
//     return view('index');
// })->name('index');
// Route::get('/event', function () {
//     return view('event-detail');
// })->name('event-detail');
// Route::get('/orders', function () {
//     return view('orders');
// })->name('orders');
// Route::get('/settings', function () {
//     return view('settings');
// })->name('settings');

// Define routes related to organizer
// Route::group(['prefix' => 'organizer'], function () {
    // Route::get('/', function () {
    //     return view('organizer.home');
    // })->name('organizer.home');
    // Route::get('/create', function () {
    //     return view('organizer.create-organization');
    // })->name('organizer.create-organization');
//     Route::get('/events', function () {
//         return view('organizer.events');
//     })->name('organizer.events');
//     Route::get('/events/create', function () {
//         return view('organizer.create-event');
//     })->name('organizer.create-event');
//     Route::get('/members', function () {
//         return view('organizer.members');
//     })->name('organizer.members');
//     // Define routes related to event
//     Route::group(['prefix' => 'events'], function () {
//         Route::get('/dashboard', function () {
//             return view('organizer.event.dashboard');
//         })->name('organizer.event.dashboard');
//         Route::get('/information', function () {
//             return view('organizer.event.information');
//         })->name('organizer.event.information');
//         Route::get('/financial', function () {
//             return view('organizer.event.financial');
//         })->name('organizer.event.financial');
//         Route::get('/order/add', function () {
//             return view('organizer.event.add-order');
//         })->name('organizer.event.add-order');
//         Route::get('/participants', function () {
//             return view('organizer.event.participants');
//         })->name('organizer.event.participants');
//         // Define routes related to event tasks
//         Route::group(['prefix' => 'tasks'], function () {
//             Route::get('/board', function () {
//                 return view('organizer.event.tasks.board');
//             })->name('organizer.event.tasks.board');
//             Route::get('/list', function () {
//                 return view('organizer.event.tasks.list');
//             })->name('organizer.event.tasks.list');
//             Route::get('/add', function () {
//                 return view('organizer.event.tasks.add');
//             })->name('organizer.event.tasks.add');
//         });
//     });
// });

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

Route::get('/test/send-email', function (Request $request) {

    Mail::to("qu1etboy@dev.io")->send(new WelcomeMail(Auth::user()));

    return "successfully sent email";
    
})->name('test.send-email');

Route::get('/test/send-email', function (Request $request) {

    Mail::to("urawit3240@gmail.com")->send(new AcceptedMail(Auth::user(), Event::event()));

    return "successfully sent email";
    
})->name('test.send-email');

require __DIR__ . '/auth.php';