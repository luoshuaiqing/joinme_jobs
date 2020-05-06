<div class="header">
    <img src="{{asset("user_photos/{$otherUser->img_url}")}}" alt="the other user's photo">
    <h4 class="message-user-name">{{$otherUser->first_name}} {{$otherUser->last_name}}</h4>
</div>


<div class="messages-container">
    @foreach ($messages as $message)
        @if($message->from == $user->id)
        <div class="message-self-container">
            <img src="{{asset("user_photos/{$user->img_url}")}}" alt="the other user's photo" class="user-photo-self">
            <div class="message-self">
                {{$message->message}}
            </div>
            <span class="time">
                {{date('Y-m-d h:i', strtotime($message->created_at))}}
            </span>
        </div>

        @else
        <div class="message-other-container">
            <img src="{{asset("user_photos/{$otherUser->img_url}")}}" alt="the other user's photo" class="user-photo">
            <div class="message-other">
                {{$message->message}}
            </div>
            <span class="time">
                {{date('Y-m-d h:i', strtotime($message->created_at))}}
            </span>
        </div>
        @endif

    @endforeach

    {{-- <div class="message-other-container">
        <div class="message-other">
            Thank you for reaching out! I would
            love to tutor you in ARCH 110
        </div>
        <span class="time">time</span>
    </div>
    <div class="message-self-container">
        <div class="message-self"> That sounds great! I’ll check your
            calendar and see when we can
            meet up!
        </div>
        <span class="time">time</span>
    </div> --}}


</div>


<div class="message-input-container">
    <input type="text" class="message-input" id="msg-to-send" placeholder="Type a message..." onkeydown="sendMessageEnter(event)">
    <button id="btn-send-msg" onclick="sendMessage()" >Send</button>
</div>

