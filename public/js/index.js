

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
    alert('the verification code is \'joinmenow\'');
})


$('.submit.submit-signup').click(() => {
    event.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let asEmployee = 1;
    if($(this).hasClass('as-employer')) {
        asEmployee = 0;
    }

    $.ajax({
        type:'POST',
        url:'/signup',
        data: {
            email: $('#signup-email').val(),
            password: $('#signup-password').val(),
            verificationCode: $('#verification-code').val(),
            asEmployee: asEmployee
        },
        success: signupSuccess,
        error: function(data) {
            // if the error is caused by the validation
            if(data.status === 422) {
                let { errors } = data.responseJSON;
                let { email, password, verificationCode } = errors;

                if(email) {
                    $('#signup__error').html(email[0]);
                }
                else if(password){
                    $('#signup__error').html(password[0]);
                }
                else if(verificationCode) {
                    $('#signup__error').html(verificationCode[0]);
                }
            }
            else {
                console.log(data);
            }
        }
     });

});

$('.submit.submit-login').click(() => {
    event.preventDefault();
    $('#login-form').submit();
});

function signupSuccess(data) {
    console.log('success');
    window.location.href = '/profile';
}
