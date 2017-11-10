
$('#send-captcha').click(function(){
    captchaValue = $('#captcha-value').val();
    login = $('#login').val();
    path = $('#path').val();
    device = $('#device').val();
    $.ajax({
       url: "../controller/ReadCaptcha.php",
       type: "POST",
       data: {"captcha": captchaValue, "login": login, "path": path, "device": device},
       success: function(data){
           $('#session-id').val(data);
       }
    });
});
