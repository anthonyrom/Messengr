<html>

<head>
    <title>Messengr</title>
    <style type="text/css">
        html {
            height: 100%;
        }
        
        body {
            margin: 0px;
            padding: 0px;
            height: 100%;
            font-family: Helvetica, Arial, Sans-serif;
            font-size: 14px;
        }
        
        .msg-container {
            width: 100%;
            height: 100%;
        }
        
        .header {
            width: 100%;
            height: 30px;
            border-bottom: 1px solid #CCC;
            text-align: center;
            padding: 15px 0px 5px;
            font-size: 20px;
            font-weight: normal;
        }
        
        .msgArea {
            height: calc(100% - 102px);
            width: 100%;
            background-color: #FFF;
            overflow-y: scroll;
        }
        
        .msgInput {
            padding: 5px;
            margin: 10px;
            font-size: 14px;
            width: calc(100% - 20px);
            outline: none;
        }
        
        .bottom {
            width: 100%;
            height: 50px;
            position: fixed;
            bottom: 0px;
            border-top: 1px solid #CCC;
            background-color: #EBEBEB;
        }
        
        #whitebg {
            width: 100%;
            height: 100%;
            background-color: #FFF;
            overflow-y: scroll;
            opacity: 0.6;
            display: none;
            position: absolute;
            top: 0px;
            z-index: 1000;
        }
        
        #loginBox {
            width: 600px;
            height: 350px;
            border: 1px solid #CCC;
            background-color: #FFF;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1001;
            display: none;
        }
        
        h1 {
            padding: 0px;
            margin: 20px 0px 0px 0px;
            text-align: center;
            font-weight: normal;
        }
        
        button {
            background-color: #43ACEC;
            border: none;
            color: #FFF;
            font-size: 16px;
            margin: 0px auto;
            width: 150px;
        }
        
        .buttonp {
            width: 150px;
            margin: 0px auto;
        }
        
        .msg {
            margin: 10px 10px;
            background-color: #f1f0f0;
            max-width: calc(45% - 20px);
            color: #000;
            padding: 10px;
            font-size: 14px;
        }
        
        .msgFrom {
            background-color: #0084ff;
            color: #FFF;
            margin: 10px 10px 10px 55%;
        }
        
        .msgArr {
            width: 0;
            height: 0;
            border-left: 8px solid transparent;
            border-right: 8px solid transparent;
            border-bottom: 8px solid #f1f0f0;
            transform: rotate(315deg);
            margin: -12px 0px 0px 45px;
        }
        
        .msgArrFrom {
            border-bottom: 8px solid #0084ff;
            float: right;
            margin-right: 45px;
        }
        
        .msgSentBy {
            color: #8C8C8C;
            font-size: 12px;
            margin: 4px 0px 0px 10px;
        }
        
        .msgSentbyFrom {
            float: right;
            margin-right: 12px;
        }
    </style>
</head>

<body onload="checkCookie(); update();">
    <div id="whitebg"></div>
    <div id="loginBox">
        <h1>Pick a username:</h1>
        <p>
            <input type="text" name="pickusername" id="cusername" placeholder="Pick a username" class="msgInput">
        </p>
        <p class="buttonp">
            <button onclick="chooseUsername()">Choose Username</button>
        </p>
    </div>
    <div class="msg-container">
        <div class="header">Messengr</div>
        <div class="msgArea" id="msgArea"></div>
        <div class="bottom">
            <input type="text" name="msgInput" class="msgInput" id="msgInput" onkeydown="if (event.keyCode == 13) sendMsg()" value="" placeholder="Enter your message here ... (Press enter to send message)">
        </div>
    </div>
    <script type="text/javascript">
        var msgInput = document.getElementById("msgInput");
        var msgArea = document.getElementById("msgArea");

        function showLogin() {
            document.getElementById("whitebg").style.display = "inline-block";
            document.getElementById("loginBox").style.display = "inline-block";
        }

        function hideLogin() {
            document.getElementById("whitebg").style.display = "none";
            document.getElementById("loginBox").style.display = "none";
        }

        function chooseUsername() {
            var user = document.getElementById("cusername").value;
            document.cookie = "messengrUname=" + user;
            checkCookie();
        }

        function checkCookie() {
            if (document.cookie.indexOf("messengrUname") == -1) {
                showLogin();
            } else {
                hideLogin();
            }
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function update() {
            /*
            var xmlhttp = new XMLHttpRequest();
            var username = getCookie("messengrUname");
            var output = "";

            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    var response = xmlhttp.responseText.split("\n");
                    var rl = response.length;
                    var item = "";

                    for (var i = 0; i < rl; i++) {
                        item = reponse[i].split("\\");
                        if (item[1] != undefined) {
                            if (item[0] == username) {
                                // Messages sent by user
                                output += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgFrom\">" + item[1] + "</div> <div class=\"msgArr msgArrFrom\"></div> <div class=\"msgSentBy msgSentByFrom\">Sent by " + item[0] + "</div> </div>";
                            } else {
                                // Messages sent by other person
                                output += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgFrom\">" + item[1] + "</div> <div class=\"msgArr msgArrFrom\"></div> <div class=\"msgSentBy msgSentByFrom\">Sent by " + item[0] + "</div> </div>";
                            }
                        }
                    }

                    msgArea.innerHTML = output;
                    msgArea.scrollTop = msgArea.scrollHeight;
                    
                }
            }

            xmlhttp.open("GET", "get-messages.php?username=" + username + "&message=" + message, true);
            xmlhttp.send();
            
            */
        }

        function sendMsg() {
            var message = msgInput.value;
            if (message != "") {

                var username = getCookie("messengrUname");

                var xmlhttp = new XMLHttpRequest();

                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        msgArea.innerHTML += "<div class=\"msgc\" style=\"margin-bottom: 30px;\"> <div class=\"msg msgFrom\">" + message + "</div> <div class=\"msgArr msgArrFrom\"></div> <div class=\"msgSentBy msgSentByFrom\">Sent by " + username + "</div> </div>";
                    }
                }

                xmlhttp.open("GET", "update-messages.php?username=" + username + "&message=" + message, true);
                xmlhttp.send();

            } else {

            }
        }
        
        // setInterval(function() { update(); }, 2500);
        
    </script>
</body>

</html>