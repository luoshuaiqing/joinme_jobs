<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
      <!-- jQuery -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('cc30b71d277a0f1ca850', {
        cluster: 'us3',
        forceTLS: true,
    });

    var channel = pusher.subscribe('chatting-channel');
    channel.bind('new-message', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
