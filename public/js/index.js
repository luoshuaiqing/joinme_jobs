// $(document).ready(function() {
//     $(".animsition").animsition({
//         inClass: 'fade-in-right',
//         outClass: 'fade-out-right',
//         inDuration: 1500,
//         outDuration: 800,
//         linkElement: '.animsition-link',
//         // e.g. linkElement: 'a:not([target="_blank"]):not([href^="#"])'
//         loading: true,
//         loadingParentElement: 'body', //animsition wrapper element
//         loadingClass: 'animsition-loading',
//         loadingInner: '', // e.g '<img src="loading.svg" />'
//         timeout: false,
//         timeoutCountdown: 5000,
//         onLoadEvent: true,
//         browser: ['animation-duration', '-webkit-animation-duration'],
//         // "browser" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
//         // The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
//         overlay: false,
//         overlayClass: 'animsition-overlay-slide',
//         overlayParentElement: 'body',
//         transition: function(url) {
//             window.location.href = url;
//         }
//     });
// });

$("video")[0].playbackRate = .3;


let width = $(window).width();
if(width < 768) {
    $(".index-container__signup").css("display", "none");
}
else {
    $(".index-container__signup > form").css("display", "none");
}

let loginShowed = true;
$('.index-toggle-display').click((e) => {
    e.preventDefault();
    if (loginShowed) {
        if(width < 768) {
            $(".index-container__login").css("display", "none");
            $(".index-container__signup").fadeIn(1000);
        }
        else {
            $(".index-container__login > form").css("display", "none");
            $(".index-container__signup > form").fadeIn(1000);
        }

    } else {
        if(width < 768) {
            $(".index-container__signup").css("display", "none");
            $(".index-container__login").fadeIn(1000);
        }
        else {
            $(".index-container__signup > form").css("display", "none");
            $(".index-container__login > form").fadeIn(1000);
        }
    }
    loginShowed = !loginShowed;
});

$('.index-container__signup .btn-send').click(() => {
    alert('email sent');
})


$('.submit.submit-signup').click(() => {
    event.preventDefault();

});


// only use ajax for signup
$('.submit.submit-login').click(() => {
    event.preventDefault();


    $(".button__verify").click(function() {
        alert("Please check your email to see the verification code");
        var xhr = new XMLHttpRequest();
        xhr.open('POST', "backend/auth.php", true);
        xhr.setRequestHeader('Content-type', "application/json");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                // var json = JSON.parse(xhr.responseText);
                // console.log(json);
            }
        };

        let email = $('#signup-email').val();
        let password = $('#password').val();
        let verificationCode = $('#verification-code').val();

        let data = {
            "email": email,
            "password": password,
            "verification-code": verificationCode
        }
        xhr.send(data);

        

    });

});

