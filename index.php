<?php session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Captcha</title>
    </head>
    <body>
        <h1>Captcha</h1>

        <?php 
            if(isset($_SESSION['msg'])) {
                print($_SESSION['msg']);
                unset($_SESSION['msg']);
            }
        ?>

        <form method="post" action="process.php">
            <img src="captcha.php" id="captcha" alt="código captcha">
            <img src="images/refresh.png" id="reload" alt="código captcha" style="cursor: pointer;"> <br><br>
            
            <label>Código</label>
            <input type="text" name="captcha"><br><br>

            <button type="submit">Submit</button>
        </form>

        <script type="text/javascript" src="js/src.js"></script>
    </body>
</html>