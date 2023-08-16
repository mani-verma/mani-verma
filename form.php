<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'formdata';

$conn = mysqli_connect($host, $user, $password, $dbname) or die();

if (empty($_POST['userid'])) {
  $userid = 'Null';
 } else {
   $userid = $_POST['userid'];
 }
 if (empty($_POST['name'])) {
 $name = 'Null';
} else {
  $name = $_POST['name'];
}
if (empty($_POST['email'])) {
  $email = 'Null';
} else {
  $email = $_POST['email'];
}
if (empty($_POST['age'])) {
  $age = 'Null';
} else {
  $age = $_POST['age'];
}
if (empty($_POST['gender'])) {
  $gender = 'Null';
} else {
  $gender = $_POST['gender'];
}

//when Submit button is pressed
if(isset($_POST['submit'])){
  $sql = "INSERT INTO `userdata` ( `name`, `email`, `age`, `gender`) VALUES ( '$name', '$email', '$age', '$gender')";
  $result = mysqli_query($conn, $sql);
  
  $outSql = "SELECT `userid`,  `name`, `email`, `age`, `gender` FROM `userdata`";

$data = mysqli_query($conn, $outSql);
  while ($row = mysqli_fetch_assoc($data)) {    //printing rows after fetching data from qury result
    echo "<tr>";
    echo"<td>".$row['userid']."</td>";
echo"<td>".$row['name']."</td>";
echo"<td>".$row['email']."</td>";
echo"<td>".$row['age'] ."</td>";
echo"<td>".$row['gender'] ."</td>";
echo "<td><div class='btn-group'>
            <button class='btn btn-danger delBtn btn-sm' onclick='delUser(".$row["userid"].")'>Delete</button>
            <button class='btn btn-info delBtn btn-sm' onclick='update(".$row["userid"].")'>Update</button>
          </div>
      </td>";
}

}

// When DELETE button is pressed

   if(isset($_POST['delBtn'])){
    $delsql="DELETE FROM `userdata` WHERE `userid`='$userid'";

    $qry=mysqli_query($conn,$delsql);
    
    if($qry){
      $outSql = "SELECT `userid`,  `name`, `email`, `age`, `gender` FROM `userdata`";;

$data = mysqli_query($conn, $outSql);
  while ($row = mysqli_fetch_assoc($data)) {    //printing rows after fetching data from qury result
    echo "<tr>";
    echo"<td>".$row['userid']."</td>";
echo"<td>".$row['name']."</td>";
echo"<td>".$row['email']."</td>";
echo"<td>".$row['age'] ."</td>";
echo"<td>".$row['gender'] ."</td>";
echo  "<td><div class='btn-group'>
              <button class='btn btn-danger delBtn btn-sm' onclick='delUser(".$row["userid"].")'>Delete</button>
              <button class='btn btn-info delBtn btn-sm' onclick='update(".$row["userid"].")'>Update</button>
           </div>
       </td>";
      }
    }else{
      $outSql = "SELECT `userid`, `name`, `email`, `age`, `gender` FROM `userdata`;";

$data = mysqli_query($conn, $outSql);
  while ($row = mysqli_fetch_assoc($data)) {    //printing rows after fetching data from qury result
    echo "<tr>";
    echo"<td>".$row['userid']."</td>";
echo"<td>".$row['name']."</td>";
echo"<td>".$row['email']."</td>";
echo"<td>".$row['age'] ."</td>";
echo"<td>".$row['gender'] ."</td>";
echo  "<td><div class='btn-group'>
            <button class='btn btn-danger delBtn btn-sm' onclick='delUser(".$row["userid"].")'>Delete</button>
            <button class='btn btn-info delBtn btn-sm' onclick='update(".$row["userid"].")'>Update</button>
           </div>
       </td>";
      }
    } 
  }

  //when Update button is pressed
  
  if(isset($_POST['updateBtn'])){

    $load= "SELECT `userid`, `name`, `email`, `age`, `gender` FROM `userdata` WHERE `userid`='$userid';";
  $loadResult=mysqli_query($conn,$load);

  $user = mysqli_fetch_assoc($loadResult);

      if(!($_POST['name']=="")){
          $upName = $name;
      }else{
        $upName = $user['name'];    
       }
      if(!($_POST['email']=="")){
        $upEmail =$email;
      }else{
        $upEmail =$user['email'];
      }
      if(!($_POST['age']=="")){
        $upAge =$age;
      }else{
        $upAge =$user['age'];
      }
     if(!($_POST['gender']=="")){
        $upGender = $gender;
       }else{
        $upGender = $user['gender'];
       }

       $outSql="UPDATE `userdata` SET `name`='$upName',`email`='$upEmail' ,`age`='$upAge' ,`gender`='$upGender' WHERE `userid`='$userid';";

       mysqli_query($conn,$outSql);

       $upData="SELECT `userid`, `name`, `email`, `age`, `gender` FROM `userdata`;";
      $data=mysqli_query($conn,$upData);
  while ($row = mysqli_fetch_assoc($data)) {    //printing rows after fetching data from qury result
    echo "<tr>";
    echo"<td>".$row['userid']."</td>";
echo"<td>".$row['name']."</td>";
echo"<td>".$row['email']."</td>";
echo"<td>".$row['age'] ."</td>";
echo"<td>".$row['gender'] ."</td>";
echo  "<td><div class='btn-group'>
              <button class='btn btn-danger delBtn btn-sm' onclick='delUser(".$row["userid"].")'>Delete</button>
              <button class='btn btn-info delBtn btn-sm' onclick='update(".$row["userid"].")'>Update</button>
           </div>
       </td>";
      }

  }


?>