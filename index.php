<?php
require 'connection.php';
session_start()

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #51e2f5;
        }
        main{
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        form{
            background-color: #fff;
            padding: 30px;
            width: 25%;
            height: 60vh;
            text-align: center;
            border-radius: 15px;
        }

        .form_content{
            margin-top: 20px;
        }

        .input-box{
            margin-bottom: 30px;
        }

        input[type="submit"]{
            width: 100%;
            background-color: #51e2f5;
            padding: 10px;
            text-decoration: none;
            border: none;
            border-radius: 15px;
            color: #fff;
            font-size: 1em;
        }

        input[type="submit"]:hover{
            cursor: pointer;
        }

        input[type="text"]{
            width: 100%;
            padding: 10px;
            border-radius: 15px;
            border: 1px solid #f1f1f1;
        }
        
        input[type="text"]:focus{
           background: #f1f1f1;
           border: 4px solid #fff;
           outline: none;
           box-shadow: 0px 0px 5px #f1f1f1;
        }

        h2{
            color: rgb(102, 102, 153);
            font-family: sans-serif;
        }

        form p{
            font-family: sans-serif;
        }

        form a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <main>
    <form action="login_handler.php" method="post">
        <header>
        <?php
        if(isset($_SESSION['success'])){
            echo "<p style='color: green; margin-bottom: 15px'>".$_SESSION['success']." , Please Login</p>";
            }
        ?>
            <h2>ID Card Generator</h2>
           
        </header>
        
        <section class="form_content">

        <section class="input-box">
            <label for="matric" style="float: left; font-family: sans-serif; font-size: 0.9em; margin: 10px 10px;">Matric Number</label>
        <input type="text" placeholder="" name="matric" id="matric" required>
        </section>
        <section class="input-box">
        <label for="password" style="float: left; font-family: sans-serif; font-size: 0.9em; margin-bottom: 10px; margin-left: 10px;">Password</label>
        <input type="text" placeholder="" name="password" id="password" required>
        </section>
        </section>
        <input type="submit" name="login" id="submit" value="Login"><br><br>
        <p>Don't have an account? <a href="register.php">Register here</p>
        
    </form>
    </main>
</body>
</html>