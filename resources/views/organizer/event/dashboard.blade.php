@extends('layouts.event')

@section('title', $event->event_name . "'s " . 'Dashboard - Beam Organizer')

@section('content')
<div class="p-3">
    <h1 class="font-bold mb-8 text-2xl sm:text-3xl md:text-4xl my-3">Event Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Submission</h5>
            <p class="text-lg font-normal text-gray-700">{{ $event->participants()->count() }}</p>
        </div>
        <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Total Cost</h5>
            <p class="text-lg font-normal text-gray-700">{{ $totalCost }} ฿</p>
        </div>
        <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">Tasks</h5>
            <p class="text-lg font-normal text-gray-700">{{ $event->tasks()->count() }}</p>
        </div>
    </div>

    <div class="mt-6 flex flex-col md:flex-row justify-around gap-8">
        <div class="md:w-4/12">
            <h2 class="font-bold mb-4 text-xl sm:text-2xl md:text-3xl">Participant Status Distribution</h2>
            <canvas id="participantStatusChart"></canvas>
        </div>
        <div class="md:w-8/12">
            <h2 class="font-bold mb-4 text-xl sm:text-2xl md:text-3xl">Daily Event Registrations for {{ date('F') }}</h2>
            <canvas id="dailyRegistrationsChart"></canvas>
        </div>
    </div>
</div>


<script>
    const statusCtx = document.getElementById('participantStatusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Accepted', 'Pending', 'Rejected'],
            datasets: [{
                data: [@json($acceptedCount), @json($pendingCount), @json($rejectedCount)],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.6)', // Greenish color for accepted
                    'rgba(255, 206, 86, 0.6)',  // Yellowish color for pending
                    'rgba(255, 99, 132, 0.6)'   // Reddish color for rejected
                ],
                borderWidth: 1
            }]
        }
    });
    let ctx = document.getElementById('dailyRegistrationsChart').getContext('2d');
    let dailyRegistrationsChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($days),  // e.g. ['1', '2', '3', ...]
            datasets: [{
                label: 'Registrations',
                data: @json($registrations),  // e.g. [5, 23, 14, ...]
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection