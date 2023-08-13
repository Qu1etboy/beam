<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Order;
use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    /**
     * Display the financial status of the given event.
     */
    public function financial(Organizer $organizer, Event $event)
    {
        $orders = $event->orders;
        return view('organizer.event.financial', compact('organizer', 'event', 'orders'));
    }

    public function create(Organizer $organizer, Event $event) {
        return view('organizer.event.orders.add', compact('organizer', 'event'));
    }

    /**
     * Store a newly created order for the given event.
     */
    public function store(Request $request, Organizer $organizer, Event $event)
    {
        $validatedData = $request->validate([
            'detail' => 'required|min:1|max:255',
            'cost' => 'required|numeric|min:0',
        ]);
        
        $order = new Order($validatedData);
        $event->orders()->save($order);

        return redirect()->route('organizer.event.financial', ['organizer' => $organizer->id, 'event' => $event->id]);
    }

    public function edit(Organizer $organizer, Event $event, Order $order) {
        return view('organizer.event.orders.edit', compact('organizer', 'event', 'order'));
    }

    /**
     * Update an order for the given event.
     */
    public function update(Request $request, Organizer $organizer, Event $event, Order $order)
    {
        $request->validate([
            'detail' => 'required|min:1|max:255',
            'cost' => 'required|numeric|min:0',
        ]);
        
        $order->detail = $request->get('detail');
        $order->cost = $request->get('cost');
        $order->save();

        // $event->orders()->save($order);

        return redirect()->route('organizer.event.financial', ['organizer' => $organizer->id, 'event' => $event->id]);
    }

    public function destroy(Organizer $organizer, Event $event, Order $order) {
        
        $order->delete();

        return redirect()->back();
    }

    /**
     * Route for export orders into csv file
     * credit: https://dev.to/techsolutionstuff/how-to-export-csv-file-in-laravel-example-12ip
     */
    public function exportOrderToCSV(Organizer $organizer, Event $event) {
        $fileName = $event->event_name . '-orders.csv';
        $orders = $event->orders;

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // Define columns. Add more columns by putting column name in array
        $columns = array('Detail', 'Cost');

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Loop data into each row
            foreach ($orders as $order) {
                $row['Detail']  = $order->detail;
                $row['Cost']    = $order->cost;

                fputcsv($file, array($row['Detail'], $row['Cost']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportOrderToPDF(Organizer $organizer, Event $event) {
        $pdf = PDF::loadView('organizer.event.pdf-order', array('event' => $event))
            ->setPaper('a4', 'portrait');

        return $pdf->download($event->event_name . '-orders.pdf');

    }
}