<!DOCTYPE html>
<html>
<head>
    <title>DigitalCare Patients</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="bg-white shadow-lg rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-5 text-center">
        DigitalCare Patient List
    </h1>

    <table class="table-auto w-full border border-gray-300">

        <thead>
            <tr class="bg-blue-500 text-white">
                <th class="p-3 border">ID</th>
                <th class="p-3 border">Name</th>
                <th class="p-3 border">Birth Date</th>
                <th class="p-3 border">Email</th>
                <th class="p-3 border">Phone Number</th>
                <th class="p-3 border">Gender</th>
            </tr>
        </thead>

        <tbody>
            @foreach($patients as $patient)
            <tr class="hover:bg-gray-100">
                <td class="border p-3">{{ $patient->patient_id }}</td>
                <td class="border p-3">{{ $patient->name }}</td>
                <td class="border p-3">{{ $patient->birth_date }}</td>
                <td class="border p-3">{{ $patient->email }}</td>
                <td class="border p-3">{{ $patient->phone_number }}</td>
                <td class="border p-3">{{ $patient->gender }}</td>
            </tr>
            @endforeach
        </tbody>

    </table>

</div>

</body>
</html>