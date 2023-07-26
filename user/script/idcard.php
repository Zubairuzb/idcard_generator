<?php 
session_start();
require '../../connection.php';

if(!isset($_GET['matric'])){
    header('location: ../../index.php ');
}

$current_matric = $_GET['matric'];

$sql = "SELECT * FROM `user` WHERE `matric_number` = '$current_matric'";
$getStudent = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Id Card</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box; 
            background: #51e2f5;
            font-family: sans-serif;
        }
        main{
            flex-direction: row;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .id_card{
            color: #fff;
            width: 600px;
            height: 400px;
            border-radius: 5%;
            background-image: linear-gradient(to right, #be93c5, #7bc6cc);
        }

        .image{
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 5px solid #bdc3c7;
        }

        .header{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background: blueviolet;
            width: 80%;
            margin: auto;
            height: 12vh;
            margin-top: 20px;
            border: 3px solid #bdc3c7;
            border-radius: 20px;
            text-align: center;
        }
/* 
        .header h3{
            margin-right: 10px;
            color: #fff;
        } */

        .profile{
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .profile img{
            margin-right: 50px;
        }

        .fullname{
            font-size: 1.2em;
            color: #51e2f5;
        }

        .info{
            display: flex;
            justify-content: center;
            align-items: center; 
        }

        .info section{
            margin-right: 30px;
        }

        .title{
            color: #51e2f5;
            font-weight: 700;
        }

        .school_title{
            font-size: 1.5em;
            font-weight: 700;
        }

        .membership{
            display: flex;
            justify-content: center;
        }

        .membership h4{
            background: #3fada8;
            padding: 5px;
            border-radius: 10px;
        }
        
    </style>
</head>
<body>

<?php

while($row = mysqli_fetch_array($getStudent)):
    $passport = $row['passport'];
    $matric = $row['matric_number'];
    $fullname = $row['fullname'];
    $gender = $row['gender'];
    $level = $row['level'];
?>
    <main>
        <section class="id_card">
            <section class="header">
                <p><span class="school_title">KAD ICT HUB</span><br>
                No. 14 Kanta Road by Independece Way, Kaduna</p>
            </section>
            <section class="membership">
                <h4>MEMBERSHIP ID CARD</h4>
            </section>
            <section class="profile">
                <section>    
                    <img src="<?php echo $passport ?>" alt="profile pic" class="image" />
                </section>
                <section>
                    <h3><span class="fullname"><?php echo $fullname ?></span> <br><span style="font-size: 14px;">Software Engineer</span></h3>
                </section>
            </section>
            <section class="info">
                <section>
                    <br><span class="title">Level</span>
                    <br><?php echo $level ?></p>
                </section>
                <section>
                    
                    <br><span class="title">Matric No.</span>
                    <br><?php echo $matric ?></p>
                </section>
                <section>
                <p><span class="title">Gender</span>
                    <br><?php echo $gender ?><br>
                </section>
                
            </section>
        </section>
    </main>
    <?php 
    endwhile;
    ?>
</body>
</html>