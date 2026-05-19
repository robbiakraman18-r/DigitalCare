<!DOCTYPE html>
<html>
<head>
    <title>DigitalCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<div class="bg-white p-6 rounded-lg shadow-lg">

    <h1 class="text-2xl font-bold mb-5">
        DigitalCare Prescription List
    </h1>

    <table class="table-auto w-full border border-collapse">
        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="p-2">ID</th>
                <th class="p-2">Medicine</t
                
                h>
                <th class="p-2">Dosage</th>
                <th class="p-2">Quantity</th>
                <th class="p-2">Instructions</th>
            </tr>
        </thead>

        <tbody>
            @if(count($obat) > 0)
                @foreach($obat as $item)
                <tr class="hover:bg-gray-100">
                    <td class="border p-2">{{ $item->id }}</td>
                    <td class="border p-2">{{ $item->medicine_name }}</td>
                    <td class="border p-2">{{ $item->dosage }}</td>
                    <td class="border p-2">{{ $item->quantity }}</td>
                    <td class="border p-2">{{ $item->usage_instructions }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center p-4">
                        No data available
                    </td>
                </tr>
            @endif
        </tbody>

    </table>
</div>

</body>
</html>