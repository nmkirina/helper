$('.session-list li a').click(function(){
    kontur = $(this).attr('id');
    $.ajax({
        url: "../controller/GetSession.php",
        type: "POST",
        cache: false,
        data: {"kontur": kontur},
        success: function(data){
            if(data){
                $.ajax({
                    url: "../view/captcha.php",
                    type: "POST",
                    data: {"image": data},
                    success: function(data){
                        $('#content').html(data);
                    }
                });
            }
        }
    });
    return false;
});
