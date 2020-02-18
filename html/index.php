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
    session_start();
//         if(isset($_COOKIE["validate"]))
//         {
//             unset($_COOKIE['validate']);
//             setcookie("validate", null, -1, "/newtaipei");
//         }
            setcookie("max_temperature", 38);
            setcookie("temperature_gain", 0);
            setcookie("temperature_row", 5);
            $_SESSION["validate"] = false;
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
.checki {
    display: none;
}

.dot {
    position: relative;

    transform: rotate(180deg);

    display: block;

    width: 60px;
    height: 30px;
    border-radius: 15px;

    overflow: hidden;

    background-color: #14a83b;
}

.checki:checked + .dot {
    background-color: white;
}

.dot:before {
    content: '';

    position: absolute;
    left: 20px;
    top: 50%;

    transform: translate(-50%, -50%);

    border-radius: 50%;

    animation: close-animation 2s forwards;
}

@keyframes close-animation {
    from {
        width: 0;
        height: 0;

        background-color: white;
    }

    to {
        width: 200px;
        height: 200px;

        background-color: white;
    }
}

.dot:after {
    content: '';

    position: absolute;
    left: calc(100% - 25px);
    top: 50%;

    transform: translateY(-50%) scale(0);

    width: 12px;
    height: 12px;
    border-radius: 50%;
    z-index: 1;

    background-color: #14a83b;

    transition-delay: .5s;

    animation: scale-animation .5s forwards;
    animation-delay: .5s;
}

@keyframes scale-animation {
    from {
        transform: translateY(-50%) scale(0);
    }

    to {
        transform: translateY(-50%) scale(1);
    }
}

.checki:checked + .dot:before {
    left: calc(100% - 20px);

    animation: open-animation 2s forwards;
}

@keyframes open-animation {
    from {
        width: 0;
        height: 0;

        background-color: #14a83b;
    }

    to {
        width: 200px;
        height: 200px;

        background-color: #14a83b;
    }
}

.checki:checked + .dot:after {
    left: 15px;

    background-color: white;

    animation: scale-2-animation .5s forwards;
    animation-delay: .5s;
}

@keyframes scale-2-animation {
    from {
        transform: translateY(-50%) scale(0);
    }

    to {
        transform: translateY(-50%) scale(1);
    }
}
    </style>
</head>
<body style="background-color:#3F3F3F!important;" onload="init()">
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
    <div class="modal fade-modal" id="imageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);width: 90%;" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="" alt="" id="modal_image" style="width:100%;height:auto;">
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
                            <input type="number" name="" value="<?='38'?>" id="max_temperature">
                            <div class="input-group-append">
                                <input type="button" value="修改" id="max_change">
                            </div>
                        </div>
                        <div class="input-group justify-content-center mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">溫度補償</span>
                            </div>
                            <input type="number" name="" value="<?='0'?>" id="temperature_gain">
                            <div class="input-group-append">
                                <input type="button" value="修改" id="gain_change">
                            </div>
                        </div>
                        <div class="input-group justify-content-center mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">顯示數量</span>
                            </div>
                            <input type="number" name="" value="<?='5'?>" id="temperature_row">
                            <div class="input-group-append">
                                <input type="button" value="修改" id="row_change">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group justify-content-center">
                            <input type="text" name="" class="p-2" placeholder="輸入密碼" id="sendtext">
                            <div class="input-group-append">
                                <input type="button" id="sendbutton" value="進階模式" class="btn btn-outline-light">
                            </div>
                            <div class="ml-3 mt-3 ">
                                <label style="margin-top: 5px;">
                                    <input class="btn-toggle checki" type="checkbox">
                                    <i class="dot"></i>
                                </label>
                                <span class="text-white">發燒紀錄</span>
                            </div>
                        </div>
                        
                    </div>
                    <div id="modal2">
                        <p style="font-size:24px;" class="text-white">有人體溫過高</p>
                        <button type="button" class="btn btn-primary mx-auto" id="closeModal">關閉音效</button>
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
        let audio;
        let opening = false;
        let passwordval = false;
        let lastHot = true;
        let warning = true;
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
            $("#modal2").hide();
            $("#123").modal();
            $('#123').on('hidden.bs.modal', function (e) {
                opening = true;
            })
            setInterval(() => {
                if(opening && warning)
                {
                    console.log($(".checki").prop("checked"));
                    $.ajax({
                        url:"query.php",
                        async:true,
                        data:{
                            status:(($(".checki").prop("checked")) ? $(".checki").prop("checked") : false)
                        },
                        success:function(data) {
                            $("tbody").html(data);
                            lastHot = $(".checki").prop("checked");
                        }
                    })
                }
            }, 1000);
            setInterval(()=>{
                $.get("send.php", 
                function(data) {
                    if(data == "1" && warning)
                    {
                        $("#modal2").show();
                        $("#disbutton").trigger("click");
                        audio.currentTime = 0;
                        warning = false;
                        if(audio.paused)
                            audio.play();
                    }
                })   
            }, 300);
            $("#max_change").click(function(){
                $.get("change1.php", {value: $("#max_temperature").val()});
            })
            $("#gain_change").click(function(){
                $.get("change2.php", {value: $("#temperature_gain").val()});
            })
            $("#row_change").click(function(){
                $.get("change3.php", {value: $("#temperature_row").val()});
            })
            $("#disbutton").click(function () {
                audio.play();
            })
            $('#closeModal').click(function (e) {
                $("#modal2").hide();
                warning = false;
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