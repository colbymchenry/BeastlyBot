<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Comment</title>
</head>
<body>
<p>
    {{ $comment->comment }}
</p>
 
---
<p>Replied by: {{ $category->name }} [Beastly Team]</p>
 
<p>Title: {{ $ticket->title }}</p>
<p>Ticket ID: {{ $ticket->ticket_id }}</p>
<p>Status: {{ $ticket->status }}</p>
 
<p>
View and reply on the message dashboard <a href="{{ url('dashboard?messages&open=' . $ticket->ticket_id) }}" target="_blank">{{ url('dashboard?messages&open=' . $ticket->ticket_id) }}</a>
</p>
 
</body>
</html>