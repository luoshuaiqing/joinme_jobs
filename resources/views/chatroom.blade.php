@extends('layouts.login')
@section('title', 'Chat Room')

{{-- for sending email --}}
@section('links-in-head')
<script src='https://smtpjs.com/v3/smtp.js'></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>

@endsection


@section('post-job')
    @if(Auth::check() && Auth::user()->is_employee == 0)
    <a href="/post_job" class="text-muted">Post Job</a>
    <a href="/posted_jobs" class="text-muted">Posted Jobs</a>
    @endif
@endsection

@section('post-job-collapse')
    @if(Auth::check() && Auth::user()->is_employee == 0)
    <li class="nav__item">
        <a href="/post_job">
            <svg class="nav__icon-post-job">
                <use xlink:href="{{asset('icon/sprite.svg#icon-pencil')}}"></use>
            </svg>
            post job page
        </a>
    </li>
    <li class="nav__item">
        <a href="/posted_jobs">
            <svg class="nav__icon-posted-jobs">
                <use xlink:href="{{asset('icon/sprite.svg#icon-office')}}"></use>
            </svg>
            posted jobs
        </a>
    </li>
    @endif
@endsection


@section('nav-search', 'text-muted')
@section('nav-chat', 'active')
@section('nav-profile', 'text-muted')
@section('nav-about', 'text-muted')
@section('nav-logout', 'text-muted')
@section('body-class', '')

@section('content')
<div class="container">
    <div class="m-header-container">
        <h2>Messages
            {{-- for unread messages --}}
            {{-- <span>(10)</span> --}}
        </h2>
    </div>

    <div class="row">
        <div class="col-4 m-left-container">

            <table class="table table-hover messages-table-left">
                <tbody>

                    @foreach ($chatrooms as $chatroom)
                    @php
                        $otherUser = $chatroom->user_id_1 == Auth::id() ? App\User::find($chatroom->user_id_2) : App\User::find($chatroom->user_id_1);

                        $unread = $chatroom->haveUnreadMessages($user->id, $otherUser->id);
                    @endphp
                        <tr data-user-id="{{$otherUser->id}}">
                            <td class="{{$unread ? 'unread' : ''}}">
                                <div class="messages-table-left-top">
                                    <span class="name">{{$otherUser->first_name}} {{$otherUser->last_name}}</span>
                                </div>
                                {{-- for displaying time --}}
                                <span class="time">{{$chatroom->getLatestMessageTime() ? date('Y-m-d h:i', strtotime($chatroom->getLatestMessageTime())) : 'No Messages'}}</span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-8 m-right-container">

            <div class="message-input-container">
                <input type="text" class="message-input" id="msg-to-send" placeholder="Type a message..." onkeydown="sendMessageEnter(event)">
                <button id="btn-send-msg" onclick="sendMessage()">Send</button>
            </div>
        </div>
    </div>

</div>

@endsection



@section('js')




<!-- defined javascript -->
<script>

let receiverId;
let myId;

@if(session('showChatUserId'))

    receiverId = '{{session('showChatUserId')}}';
    $('.messages-table-left tr[data-user-id="' + receiverId + '"]').addClass('hover-background');
    showAllMsg(receiverId);
@endif

Date.prototype.yyyymmdd = function () {
    var mm = this.getMonth() + 1; // getMonth() is zero-based
    var dd = this.getDate();

    return [this.getFullYear(),
        (mm > 9 ? '' : '0') + mm,
        (dd > 9 ? '' : '0') + dd
    ].join('-');
};



$( document ).ready(function() {
    myId = "{{$user->id}}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('cc30b71d277a0f1ca850', {
        cluster: 'us3',
        forceTLS: true
    });

    var channel = pusher.subscribe('chatting-channel');
    channel.bind('new-message', function(data) {
        data = data.message;

        console.log("my id: " + myId);
        console.log("data: " + data);
        console.log("from: " + data.from);
        console.log("to: " + data.to);


        // if I am the sender
        if(myId == data.from) {

        }
        // if receiving a message
        else if(myId == data.to) {
            let d = new Date(data.time);
            let time = d.yyyymmdd() + " " + d.getHours() + ":" + getMinutesFormat(d);

            // if receiver is selected, push the data to the window
            if(receiverId && receiverId == data.from) {
                let msg = `<div class="message-other-container">
                    <img src="${data.img_url_sender}" alt="the other user's photo" class="user-photo">
                    <div class="message-other">
                    ${data.msg}
                    </div>
                    <span class="time">
                    ${time}
                    </span>
                </div>`;

                $('.messages-container').append(msg);
                scrollToBottom();

            }
            // if not selected, update there is unread message!
            else {
                $('.messages-table-left tr[data-user-id="' + data.from + '"] td').addClass('unread');
            }

            // update the time on the left
            $('.messages-table-left tr[data-user-id="' + data.from + '"] .time').html(time);


        }
        // if this message has nothing to do with the current user( neither to nor from)
        else {
            console.log('this message is not for me');
        }
    });




    $('.messages-table-left tr').click(function() {
        // if the user clicked on the same chatbox, dont do anything
        if(receiverId && receiverId == $(this).attr('data-user-id')) {
            return;
        }

        // if there was a chatbox, make it to normal state
        if($('.messages-table-left tr[data-user-id="' + receiverId + '"]')[0]) {
            $('.messages-table-left tr[data-user-id="' + receiverId + '"]').removeClass('hover-background');
        }


        $(this).addClass('hover-background');

        receiverId = $(this).attr('data-user-id')

        showAllMsg($(this).attr('data-user-id'));
    });

})


function getMinutesFormat(date) {
    if (date.getMinutes() < 10) {
        return "0" + date.getMinutes();
    }
    return date.getMinutes();
}

function sendMessage() {
    let message = $('#msg-to-send').val();

    let validMsg = message && message.trim().length !== 0 && receiverId;
    // if is valid message and have clicked on someone to send the message
    if(!validMsg) {
        alert("You must select a chatbox and input a valid message!");
        return;
    }


    // IMPORTANT: directly push this message to the chatbox, instead of pushing it to the window after receiving the event!
    let d = new Date();
    let time = d.yyyymmdd() + " " + d.getHours() + ":" + getMinutesFormat(d);

    let img_url = "{{asset("user_photos")}}" + "/" + "{{$user->img_url}}";

    let msg = `<div class="message-self-container">
                    <img src="${img_url}" alt="current user's photo" class="user-photo-self">
                    <div class="message-self">
                    ${message}
                    </div>
                    <span class="time">
                    ${time}
                    </span>
                </div>`;

    $('.messages-container').append(msg);
    $('.messages-table-left tr[data-user-id="' + receiverId + '"] .time').html(time);
    $('#msg-to-send').val('');
    scrollToBottom();


    // TODO: make it to json data
    // sending message here
    let datastr = "receiver_id=" + receiverId + "&message=" + message;

    $.ajax({
        type: 'post',
        url: '/messages',
        data: datastr,
        cache: false,
        success: function(data) {
            // $('#msg-to-send').val('');

        },
        error: function(jqXHR, status, err) {
            alert("wrong!")
        },
        complete: function() {
            // scroll to the bottom
            // scrollToBottom();
        }
    });
}

function viewUserProfile(userId) {
    window.location.href = '/view_profile/' + userId + '?from=messages';
}


function sendMessageEnter(e) {
    if (e.keyCode == 13) {
        sendMessage();
    }
}


function scrollToBottom() {
    $('.messages-container').animate({
        scrollTop: $('.messages-container')[0].scrollHeight
    }, );
}

function showAllMsg(userId) {
    $.ajax({
        type: 'GET',
        url: '/detailedMessages/' + userId,
        data: "",
        cache: "false",
        success: function(data) {
            $('.m-right-container').html(data);

            // maark as read
            $('.messages-table-left tr[data-user-id="' + receiverId + '"] td').removeClass('unread');

            // scroll to the bottom
            scrollToBottom();
        },
        error: function(err) {
            console.log(err);
        }
    })
}

</script>

@endsection

