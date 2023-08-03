<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display the financial status of the given event.
     */
    public function financial(Organizer $organizer, Event $event)
    {
        // $orders = $event->orders;
        // return view('organizer.event.financial', compact('organizer', 'event', 'orders'));
    }

    /**
     * Store a newly created order for the given event.
     */
    public function addOrder(Request $request, Organizer $organizer, Event $event)
    {
        // $validatedData = $request->validate([
        //     'detail' => 'required|max:255',
        //     'cost' => 'required|numeric|min:0',
        // ]);
        // $order = new Order($validatedData);
        // $event->orders()->save($order);

        // return redirect()->route('organizer.event.dashboard', ['organizer' => $organizer->id, 'event' => $event->id]);
    }
}
