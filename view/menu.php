<div id="menu">
    <ul class="nav nav-tabs">
        <li><a href="#" id="logs">10000_errors</a></li>
        <li><a href="#" id="rzd">Сервисы - логи</a></li>
        <li><a href="#" id="access">Access</a></li>
        <li><a href="#" id="session">Сессия</a></li>
        <li><a href="#" id="error">Ошибка</a></li>
    </ul>       
</div>
<script src="../js/menu.js"></script>
<script>
     $('#access').click(function(){       
        getLogs('access.log');
    });
</script>
