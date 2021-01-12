<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Support Ticket</title>
</head>
<body>
<p>
    Hey {{ $ticketUsername }} you have a new reply from the Beastly Team. <a href="{{ url('dashboard?messages&open=' . $ticket->ticket_id) }}" target="_blank">View message on BeastlyBot.com</a>.
</p>
 
---
<p>Title: {{ $ticket->title }}</p>
<p>Message ID: {{ $ticket->ticket_id }}</p>
<p>Status: {{ $ticket->status }}</p>
 
<p>
    You can view the ticket at any time at {{ url('dashboard?messages&open=' . $ticket->ticket_id) }}
</p>
 
</body>
</html>