    function versionList(url)
    {
        $('#content').empty();
            $.ajax({
                url: url,
                success: function(data){
                    $('#content').empty();
                    $('#content').html(data);
                }
        });
        return false;
    }
    
    $('#session').click(function(){
        versionList("../view/sessionMenu.php");
    });
    
    $('#error').click(function(){
        versionList("../view/errorMenu.php");
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



