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
    
    function getLogs(log, url = "../controller/LogsReader.php")
    {
        $.ajax({
            type: "POST",
            cache: false,
            data: {"log": log},
            url: url,
            success: function(data){
                $('#content').empty();
                $('#content').html(data);
            }
        });
        return false;
        
    }
    
    $('#logs').click(function(){       
        getLogs('/runtime/logs/10000_errors.log');
    });
    
    $('#access').click(function(){       
        getLogs('/runtime/logs/access.log');
    });

    $('#error').click(function(){
        getLogs('/error.log', "../controller/ErrorLogReader.php");
    });