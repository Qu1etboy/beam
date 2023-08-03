<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Orders PDF</title>

        <style>
          @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('_static/fonts/THSarabunNew.ttf') }}") format('truetype');
          }

          @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('_static/fonts/THSarabunNew-Bold.ttf') }}") format('truetype');
          }

          @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('_static/fonts/THSarabunNew-Italic.ttf') }}") format('truetype');
          }

          @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('_static/fonts/THSarabunNew-BoldItalic.ttf') }}") format('truetype');
          } 

          body {
            font-family: "THSarabunNew", sans-serif;
          }

          .w-full {
            width: 100%;
          }

          .bg-gray-50 {
            background-color: #f9fafb;
          }

          .text-left {
            text-align: left;
          }

          .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
          }

          .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
          }

          .text-right {
            text-align: right;
          }

          .mt-3 {
            margin-top: 0.75rem;
          }
        </style>

    </head>
    <body>
      <table class="w-full">
        <thead class="bg-gray-50 text-left">
          <tr>
            <th class="px-6 py-3">#</th>
            <th class="px-6 py-3">Detail</th>
            <th class="px-6 py-3">Cost</th>
          </tr>
        </thead>

        <tbody>
          @foreach($event->orders as $order)
            <tr>
              <td class="px-6 py-3">{{ $loop->iteration }}</td>
              <td class="px-6 py-3">{{ $order->detail }}</td>
              <td class="px-6 py-3">{{ $order->cost }}</td>
            </tr>  
          @endforeach
        </tbody>

      </table>

      <div class="text-right mt-3">
        <p>Total cost : {{ $event->getTotalOrderCost() }} Baht</p>
      </div>
    </body>
</html>