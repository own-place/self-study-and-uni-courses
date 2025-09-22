<!DOCTYPE html>
<html>
<head>
    <title>You have been assigned a new student</title>
</head>
<body>
<h1>Hello {{ $application->user->assignedMentor->first_name }},</h1>
<p>You have been assigned a new student:</p>
<p>
    <strong>Name:</strong> {{ $application->user->first_name }} {{ $application->user->last_name }}<br>
    <strong>Email:</strong> {{ $application->user->email }}
</p>
<p>Please in your account review the student's application and documents and give your feedback.</p>
<p>Thank you!</p>
</body>
</html>
