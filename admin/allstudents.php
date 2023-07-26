<?php 
    session_start();
    require '../connection.php';
    if(isset($_SESSION['username'])):
      $sql = "SELECT * FROM `user`";
    $allstudents = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{
  font-family: sans-serif;
}

h2, p{
  color: rgb(102, 102, 153);;
}

a{
  text-decoration: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  
}

th, td {
  text-align: left;
  padding: 8px;
}

th{
  color: #fff;
}

tr:nth-child(even){background-color: #f2f2f2}
tr:nth-child(odd){background-color: grey}
</style>
</head>
<body>

<h2>All Students Registered</h2>
<p>This is the list of all the users that registered on the ID Card portal</p>

<div style="overflow-x:auto;">
<table>
    <tr>
      <th>Fullname</th>
      <th>Matric</th>
      <th>Gender</th>
      <th>Level</th>
      <th>Passport</th>
     
    </tr>
<?php
while($row = mysqli_fetch_array($allstudents)):
    $fullname = $row['fullname'];
    $matric = $row['matric_number'];
    $gender = $row['gender'];
    $level = $row['level'];
    $passport = $row['passport'];
   
?>
  
    <tr>
      <td><?php echo $fullname ?></td>
      <td><?php echo $matric ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $level ?></td>
      <td><img src="<?php echo $passport ?>" width="" height=""></td>
    </tr>
    <?php 
  endwhile;
  ?>
  </table>
  <p style="font-size: 1.5em">Total Students: <?php echo mysqli_num_rows($allstudents); ?></p>
</div>

<?php
else:
  echo "Please Login";
endif;
?>
</body>
</html>
