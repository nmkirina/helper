        $('#session').click(function(){
        $('#content').empty();
        $.ajax({
            url: "../view/sessionList.php",
            success: function(data){
                $('#content').empty();
                $('#content').html(data);
            }
        });
        return false;
    });
    
    function getLogs(log)
    {
        $.ajax({
            type: "POST",
            cache: false,
            data: {"log": log},
            url: "../controller/LogsReader.php",
            success: function(data){
                $('#content').empty();
                $('#content').html(data);
            }
        });
        return false;
        
    }
    
    $('#logs').click(function(){       
        getLogs('10000_errors.log');
    });
    
    $('#rzd').click(function(){       
        getLogs('rzdServices.log');
    });
    
    $('#access').click(function(){       
        getLogs('access.log');
    });



