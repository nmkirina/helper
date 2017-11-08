<script src="../js/captcha.js"></script>
<?php include_once '../controller/Session.php';?>
<?php $image = $_POST['image'];?>
<img src=<?="/tmp/" . $image . ""?>>
<form>
        <div class="form-group"> <label for="captcha-value">Captcha</label>
            <input type="text" class="form-control" id="captcha-value"></div>
        <div class="form-group"> <label for="jsession">Jsession ID</label>
            <input type="text" class="form-control" id="jsession" value="<?= Session::get('jsessionId')?>"></div>
        <div class="form-group"> <label for="login" >Login</label>
            <select class="form-control" id="login" value="alt.man">
                <option value="enter">enter</option>
                <option value="enter">enter</option>
                <option value="enter">enter</option>
                <option value="enter">enter</option>
            </select>
        </div>
        <div class="form-group"> <label for="path">Password</label>
            <input type="text" class="form-control" id="path" value="qazxswedc"></div>
        <div class="form-group"> <label for="device">Device Guid</label>
            <input type="text" class="form-control" id="device" value="1267617sdfsdf2ad78236fa78234634cd28347312"></div>    
        <div><a class="btn   btn-primary btn-lg" role="button" id="send-captcha">Go</a></div>
        <div class="form-group"> <label for="session-id">Session Id</label>
            <input type="text" class="form-control" id="session-id"></div>
</form>