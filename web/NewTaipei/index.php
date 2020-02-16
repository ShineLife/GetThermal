<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新北市校園自製紅外線感測成像專題</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="jquery.min.js"></script>
    <script src="bootstrap.min.js"></script>
    <?php
        if(isset($_COOKIE["validate"]))
        {
            unset($_COOKIE['validate']);
            setcookie("validate", null, -1, "/newtaipei");
        }
        if(!isset($_COOKIE["max_temperature"]))
            setcookie("max_temperature", 38);
        if(!isset($_COOKIE["temperature_gain"]))
            setcookie("temperature_gain", 0);
    ?>
    <style>
        #init {
            position: absolute;
            margin-right: 0px;
            margin-left: 0px;
            margin-top: 0px;
            margin-bottom: 0px;
            z-index: 1000;
        }
    </style>
</head>
<body style="background-color:#3F3F3F!important;" onload="init()">
    <div class="modal" id="modal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);width: 90%;" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-size:24px;">有人體溫過高</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mx-auto" data-dismiss="modal">關閉音效</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade-modal" id="123" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);width: 90%;" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <p style="font-size:24px;">請點擊按鈕或任意處開啟音效</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary mx-auto" data-dismiss="modal" onclick="opening = true;">開啟音效</button>
                </div>
            </div>
        </div>
    </div>
    <audio id="audioi" >
        <source src="warning.mp3" type="audio/mp3">
    </audio>
    <div>
        <div class="row mb-5 mt-5 mx-auto" style="width:90%;">
            <div class="col-12 text-center p-0 ">
                <img src="logo-w.png" style="width:60px;height:60px;" alt="">
                <h3 class="text-white" style="font-size:30px;">新北市校園自製紅外線感測成像專題</h3>
                <div class="container">
                    <div class="row">
                        <div class="input-group justify-content-center mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">溫度限制</span>
                            </div>
                            <input type="number" name="" value="<?=isset($_COOKIE["max_temperature"]) ? $_COOKIE["max_temperature"] : '38'?>" id="max_temperature">
                            <div class="input-group-append">
                                <input type="button" value="修改" id="max_change">
                            </div>
                        </div>
                        <div class="input-group justify-content-center mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">溫度補償</span>
                            </div>
                            <input type="number" name="" value="<?=isset($_COOKIE["temperature_gain"]) ? $_COOKIE["temperature_gain"] : '0'?>" id="temperature_gain">
                            <div class="input-group-append">
                                <input type="button" value="修改" id="gain_change">
                            </div>
                        </div>
                    </div>
                    <div class="input-group justify-content-center">
                        <input type="text" name="" class="p-2" placeholder="輸入密碼" id="sendtext">
                        <div class="input-group-append">
                            <input type="button" id="sendbutton" value="進入進階模式" class="btn btn-outline-light">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12 mx-auto" style="width:90%;">
                    <table class="table table-dashed text-light" style="font-size:25px;">
                        <thead>
                            <tr>
                                <th style="width: 50%">日期時間</th>
                                <th style="width: 10%">溫度</th>
                                <th style="width: 40%">照片</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <input type="button" value="" id="disbutton" style="display: none;">
    </div>
    <script>
        let play = true;
        let audio;
        let opening = false;
        function init(){
            audio = document.getElementById("audioi");
            audio.addEventListener('ended', loopAudio, false);
        }
        function loopAudio() {
            audio.loop = true;
            audio.load();
            audio.play();
            audio.pause();
        }
        document.addEventListener('touchstart', function () {
            document.getElementsByTagName('audio')[0].play();
            document.getElementsByTagName('audio')[0].pause();
        });
        $(function(){
            $("#123").modal();
            setInterval(() => {
                if(opening)
                {
                    $.get("query.php", 
                    function(data) {
                        $("tbody").html(data);
                    })
                    $.get("send.php", 
                    function(data) {
                        if(play && data == "1")
                        {
                            play = false;
                            $("#disbutton").trigger("click");
                            audio.play();
                            $("#modal2").modal();
                        }
                    })
                }
            }, 1000);
            $("#max_change").click(function(){
                $.get("change1.php", {value: $("#max_temperature").val()});
            })
            $("#gain_change").click(function(){
                $.get("change2.php", {value: $("#temperature_gain").val()});
            })
            $("#disbutton").click(function () {
                audio.play();
            })
            $('#modal2').on('hidden.bs.modal', function (e) {
                play = true;
                audio.pause();
            })
            $("#sendbutton").click(function () {
                $.get("login.php", {password:$("#sendtext").val()}, function(data) {
                    if(data == "1234")
                    {
                        $("#sendbutton").hide();
                        $("#sendtext").hide();
                    }
                });
            })
        })
    </script>
</body>
</html>