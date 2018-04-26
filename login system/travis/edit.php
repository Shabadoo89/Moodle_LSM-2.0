<?php
include('header.php');
$username = $_SESSION['u_id'];
$userEmail = $_GET['edituser'];
$sql = "SELECT username, email, password, student_name, student_id, student_courses, student_score1, student_score2, student_score3, student_admin FROM lms WHERE email = '$userEmail'";
$result = $conn->query($sql);
$sql2 = "SELECT username, email, password, student_name, student_id, student_courses, student_score1, student_score2, student_score3, student_admin FROM lms WHERE email = '$username'";
$result2 = $conn->query($sql2);

if ( isset($_POST['update']) ) {
  
  $u_email = $_POST['email'];
  $u_name = $_POST['name'];
  $u_id = $_POST['id'];
  $u_courses = $_POST['courses'];
  $u_score1 = $_POST['score1'];
  $u_score2 = $_POST['score2'];
  $u_score3 = $_POST['score3'];
  
  $errors=0;

    if($u_name == ''){
      $errors=1;
      $error_message .= 'name cannot be blank\n';
    }

     if($u_email == ''){
      $errors=1;
      $error_message .= 'email cannot be blank\n';
    }

     if($u_id == ''){
      $errors=1;
      $error_message .= 'ID cannot be blank\n';
    }

  if($errors==0){
   
    $query = "UPDATE lms SET username = '$u_name', email = '$u_email', student_name = '$u_name', student_id = '$u_id', student_courses = '$u_courses', student_score1 = '$u_score1', student_score2 = '$u_score2', student_score3 = '$u_score3' WHERE email = '$u_email'";
    header("Location: edit.php?edituser=$u_email");
      mysqli_query($conn, $query);
 }else{
  echo "<script type='text/javascript'>alert('failed to update');</script>";
    }
 }

?>

<style type="text/css">
tr:first-child{
  
  background-color: #0099ff;
}

tr{
  padding: 5px;
  margin-top: 5px;
  background-color: #ccebff;
}

  td{
    padding: 20px;
  }
</style>
<section class = "main-container">
    <div class = "main-wrapper">
        <h2 style="padding-bottom: 20px;">Admin Panel</h2>
        <h4 style="text-align: center; padding-bottom: 20px;">Edit Info</h4>
                  <table style="margin: 0 auto;">
  <tr>
    <th>Email</th>
    <th>Name</th>
    <th>ID</th>
    <th>Courses</th>
    <th>Score 1</th>
    <th>Score 2</th>
    <th>Score 3</th>
  </tr>
        <?php
    // output data of each row
             while ($row2 = mysqli_fetch_array($result2)){
              $admin = $row2['student_admin'];
         if($admin == '1'){
     while ($row = mysqli_fetch_array($result)){
             $name = $row['student_name'];
             $email = $row['email'];
          $id = $row['student_id'];
          $courses = $row['student_courses'];
          $score1 = $row['student_score1'];
          $score2 = $row['student_score2'];
          $score3 = $row['student_score3'];
         
      
           echo '<tr>'; 
           echo '<form method="post" style="margin: 0 auto; width: 1000px;" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'?edituser='.$userEmail.'">';
                echo '<td><input type="email" name="email" placeholder="Email" value="'.$email.'" required></td>';
                echo '<td><input type="text" name="name" placeholder="Name" value="'.$name.'" required></td>';
                echo '<td><input type="text" name="id" placeholder="ID" value="'.$id.'" required></td>';
                echo '<td><input type="text" name="courses" placeholder="Courses" value="'.$courses.'"></td>';
                echo '<td><input type="text" name="score1" placeholder="score1" value="'.$score1.'"></td>';
                echo '<td><input type="text" name="score2" placeholder="score2" value="'.$score2.'"></td>';
                echo '<td><input type="text" name="score3" placeholder="score3" value="'.$score3.'"></td>';
                echo '<td><input type="submit" name="update" value="Update"></td>';
                echo "</form></tr>";

       
            }}



            if($admin == '0'){
            echo "<script type='text/javascript'>alert('Access Restricted, Admin Only');</script>";
            header('account.php');
          }}
  
  
        ?>
    </table>
    </div>
</section>

<?php
    include('footer.php');
?>