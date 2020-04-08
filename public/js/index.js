$("video")[0].playbackRate = .3;
	
    
let width = $(window).width();
if(width <= 768) {
    $(".index-container__signup").css("display", "none");
}
else {
    $(".index-container__signup > form").css("display", "none");
}

let loginShowed = true;
$('.index-toggle-display').click((e) => {    
    e.preventDefault();
    if (loginShowed) {
        if(width <= 768) {
            $(".index-container__login").css("display", "none");
            $(".index-container__signup").fadeIn(1000);
        }
        else {
            $(".index-container__login > form").css("display", "none");
            $(".index-container__signup > form").fadeIn(1000);
        }
        
    } else {
        if(width <= 768) {
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