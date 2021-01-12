<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Message Sent!</title>
</head>
<body>
<p>
Thank you {{ ucfirst($user->name) }} for contacting us. You will be notified when a response is made by email. The details of your message are shown below:
</p>
 
<p>Title: {{ $ticket->title }}</p>
<p>Status: {{ $ticket->status }}</p>
 
<p>
You can view your message any time at {{ url('tickets/'. $ticket->ticket_id) }}
</p>
 
</body>
</html>