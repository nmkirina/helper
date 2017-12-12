$('.session-list li a').click(function(){
    kontur = $(this).attr('id');
    $.ajax({
        url: "../controller/ErrorTest.php",
        type: "POST",
        cache: false,
        data: {"kontur": kontur},
        success: function(data){
            $('#content').html(data);
        }
    });
    return false;
});

