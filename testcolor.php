<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf=8">
        <style type="text/css">
            #posts {
                width: 90%;
                height: 700px;
                margin: auto
            }
        </style>
    </head>
    <body onload="return ran_col()">
        <div id="posts">TEST
        </div>
        <script type="text/javascript">
            function ran_col() { //function name
                var color = '#'; // hexadecimal starting symbol
                var letters = ['24ff9c','209aa5','1ad9ff','9fff1a']; //Set your colors here
                color += letters[Math.floor(Math.random() * letters.length)];
                document.getElementById('posts').style.color = color; // Setting the random color on your div element.
            }
        </script>
    </body>
</html>