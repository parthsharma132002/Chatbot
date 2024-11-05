<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Chatbot in PHP | CampCodes</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
    <div class="wrapper">
        <div class="title">Simple Online Chatbot</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fa fa-user"></i>
                    <!-- <i class="material-icons md-36">person</i> -->
                </div>
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>

    <!-- <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script> -->

    <!-- <script>
    $(document).ready(function(){
        $("#send-btn").on("click", sendMessage);

        $("#data").keypress(function(event) {
            if (event.keyCode === 13) {
                sendMessage();
            }
        });

        function sendMessage() {
            $value = $("#data").val();
            $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ $value +'</p></div>&nbsp;&nbsp;<div class="icon"><i class="fas fa-user"></i></div></div>';
            $(".form").append($msg);
            $("#data").val('');
            
            // start ajax code
            $.ajax({
                url: 'message.php',
                type: 'POST',
                data: 'text='+$value,
                success: function(result){
                    $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                    $(".form").append($replay);
                    // when chat goes down the scroll bar automatically comes to the bottom
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                }
            });
        }
    });
</script> -->

<script>
$(document).ready(function(){
    $("#send-btn").on("click", sendMessage);

    $("#data").keypress(function(event) {
        if (event.keyCode === 13) {
            sendMessage();
        }
    });

    function sendMessage() {
        $value = $("#data").val();
        $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>'+ linkify($value) +'</p></div>&nbsp;&nbsp;<div class="icon"><i class="fas fa-user"></i></div></div>';
        $(".form").append($msg);
        $("#data").val('');
        
        // start ajax code
        $.ajax({
            url: 'message.php',
            type: 'POST',
            data: 'text='+$value,
            success: function(result){
                $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>'+ linkify(result) +'</p></div></div>';
                $(".form").append($replay);
                // when chat goes down the scroll bar automatically comes to the bottom
                $(".form").scrollTop($(".form")[0].scrollHeight);
            }
        });
    }

    // Function to convert URLs to clickable links
    function linkify(inputText) {
        var replacedText, replacePattern1, replacePattern2, replacePattern3;

        // URLs starting with http://, https://, or ftp://
        replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
        replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

        // URLs starting with "www." (without // before it, or it'd re-link the ones done above)
        replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gi;
        replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

        // Change email addresses to mailto:: links
        replacePattern3 = /(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})/gi;
        replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

        return replacedText;
    }
});
</script>

    
</body>
</html>