<?php 
    session_start();
    require '../connection.php';
    if(isset($_SESSION['username'])):
      $sql = "SELECT * FROM `user` WHERE `request` = '1'";
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

<h2>All ID Card request</h2>
<p>This is the list of all users that have requested for ID Card only, crosscheck the details for each user for further action, please.</p>

<div style="overflow-x:auto;">
<table>
    <tr>
      <th>Fullname</th>
      <th>Matric</th>
      <th>Gender</th>
      <th>Level</th>
      <th>Passport</th>
      <th>Request</th>
      <th>Status</th>
    </tr>
<?php
while($row = mysqli_fetch_array($allstudents)):
    $fullname = $row['fullname'];
    $matric = $row['matric_number'];
    $gender = $row['gender'];
    $level = $row['level'];
    $passport = $row['passport'];
    $request = $row['request'];
    $status = $row['status'];
?>
  
    <tr>
      <td><?php echo $fullname ?></td>
      <td><?php echo strtoupper($matric) ?></td>
      <td><?php echo $gender ?></td>
      <td><?php echo $level ?></td>
      <td><img src="<?php echo $passport ?>" width='25' height='25'></td>
      <td><?php echo $request ?></td>
      <td><?php 
        if($status == 'Approved'){
            echo "<a href='script/approve.php?usermatric=$matric&userstatus=$status&userrequest=$request'>Disapproved</a>";
        }else{
            echo "<a href='script/approve.php?usermatric=$matric&userstatus=$status&userrequest=$request'>Approved</a>";
        }
      ?></td>
    </tr>
    <?php 
  endwhile;
  ?>
  </table>
  <p style="font-size: 1.5em">Total Request: <?php echo mysqli_num_rows($allstudents); ?></p>
</div>

<?php
else:
  header('location: index.php');
endif;
?>
</body>
</html>
