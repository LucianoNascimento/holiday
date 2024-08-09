<!DOCTYPE html>
<html>
<head>
    <title>Holiday Plan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            margin: 20px;
        }

        .content h2 {
            margin-bottom: 10px;
        }

        .content p {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $holidayPlan->title }}</h1>
    </div>
    <div class="content">
        <h2>Description</h2>
        <p>{{ $holidayPlan->description }}</p>
        <h2>Date</h2>
        <p>{{ $holidayPlan->date }}</p>
        <h2>Location</h2>
        <p>{{ $holidayPlan->location }}</p>
        @if($holidayPlan->participants)
            <h2>Participants</h2>
            <p>{{ $holidayPlan->participants }}</p>
        @endif
    </div>
</div>
</body>
</html>
