<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>New Message</title>
</head>
<body>
<p>
Heads up Beastly Team, {{ $department->name }}. A message has been opened. The details of your ticket are shown below:
</p>
 
<p>Title: {{ $ticket->title }}</p>
<p>Status: {{ $ticket->status }}</p>
 
<p>
View and reply on ticket dashboard <a href="{{ url('dashboard?messages&open=' . $ticket->ticket_id) }}" target="_blank">{{ url('dashboard?messages&open=' . $ticket->ticket_id) }}</a>
</p>
 
</body>
</html>