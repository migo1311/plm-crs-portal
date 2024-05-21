<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teaching Assignment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
        }
        .header img {
            width: 100px;
        }
        .header h1 {
            margin: 0;
        }
        .header h2, .header h3 {
            margin: 5px 0;
        }
        .details, .schedule {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .details td, .schedule th, .schedule td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .schedule th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ asset('path/to/logo.png') }}" alt="University Logo">
    <h1>PAMANTASAN NG LUNGSOD NG MAYNILA</h1>
    <h2>(University of the City of Manila)</h2>
    <h3>Intramuros, Manila</h3>
    <h3>College of Information System and Technology Management</h3>
    <h3>TEACHING ASSIGNMENT</h3>
    <h3>2nd Sem, SY 2023-2024</h3>
</div>

<table class="details">
    <tr>
        <td><strong>AGUSTIN, VIVIEN A.</strong></td>
    </tr>
    <tr>
        <td>Assistant Professor III, FULL-TIME</td>
    </tr>
</table>

<p>This College has considered you to teach the following subject(s) for the stipulated term.</p>

<table class="schedule">
    <thead>
    @foreach ($assignments as $assignment)
    <tr>
        <td>{{ $assignment->subject_code_section }}</td>
        <td>{{ $assignment->subject_title }}</td>
        <td>{{ $assignment->units }}</td>
        <td>{{ $assignment->schedule }}</td>
        <td>{{ $assignment->num_students }}</td>
        <td>{{ $assignment->credited_units }}</td>
        <td>{{ $assignment->college_load }}</td>
    </tr>
    @endforeach
    </thead>
    <tbody>
        <tr>
            <td>Administrative Load</td>
            <td>Associate Dean</td>
            <td>12.00</td>
            <td>MTW 10:00AM-7:00PM, ThF 7:00AM-4:00PM</td>
            <td>0</td>
            <td>12.00</td>
            <td>CISTM_AL</td>
        </tr>
    </tbody>
</table>

<table class="details">
    <tr>
        <td>Effectivity: 2024-02-05</td>
        <td>Total No. of Units: 20</td>
        <td>Total Units Credited: 24</td>
    </tr>
</table>

</body>
</html>
