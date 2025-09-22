<!DOCTYPE html>
<html>
<head>
    <title>Application Details</title>
</head>
<body>
<h2>Application Details</h2>
<p>Name: {{ $application->user->first_name }} {{ $application->user->last_name }}</p>
<p>Email: {{ $application->user->email }}</p>
<p>Internship Title: {{ $application->internship->title }}</p>
<!-- Add the attachments -->
</body>
</html>
