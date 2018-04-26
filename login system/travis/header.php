<?php
include('connection.php');
session_start();
  if ( isset($_POST['submit']) ) {

   $username = $_POST['uid']; // required
    $password = $_POST['pwd']; // required

      $sql = "SELECT username, email, password, student_admin FROM lms WHERE email = '" . $_POST['uid'] . "'";
$result = $conn->query($sql);
  $pass = trim($_POST['pwd']);
  $email = trim($_POST['uid']);
  $checkemail = "SELECT email FROM lms WHERE email = '$email'";
  $repEmail = $conn->query($checkemail);

  function valid_email($email) {
    return !!filter_var($email, FILTER_VALIDATE_EMAIL);
} 

$errors=0;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
          $userEmail = $row['email'];
          $userPass = $row['password'];
          $admin = $row['student_admin'];
      } }

$error_message = "";

    if( valid_email($email) ) {
    } else {
    $errors=1;
    $error_message .= 'Please Input Valid Email Address.\n';
    }

    if ($repEmail->num_rows < 1) {
    $errors=1;
    $error_message .= 'Email is not registered.\n';
    }  

 

  if($errors==0){
        $_SESSION['u_id'] = strtolower($username);
        header('location: account.php');
  }else{
   echo "<script type='text/javascript'>alert('$error_message');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel = "stylesheet" type = "text/css" href = "style.css">
</head>
<body>

<header>
    <nav class="nav-wrapper">
        <div >
            <ul style="float: left;">
                <li><a href="index.php">Home</a></li>
            </ul>
            <div style="float: right;" class = "nav-login">
                
                <?php if(isset($_SESSION['u_id'])){
                    echo '<form method="post" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'">';
                    echo '<input type="button" value="Account" onclick="window.location.href=\'account.php\'">';
                    echo '<input type="button" value="Logout" onclick="window.location.href=\'logout.php\'">';
                    echo '</form>';
                }else{
                    echo '<form method="post" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'">';
                    echo '<input type="button" value="Sign Up" onclick="window.location.href=\'signup.php\'">';
                    echo '</form>';
                   echo  '<form method="post" enctype="multipart/form-data" action="'.$_SERVER['PHP_SELF'].'">
                    <input type="text" name="uid" placeholder="Username/E-mail" required>
                    <input type="password" name="pwd" placeholder="Password" required>
                    <input type="submit" name="submit" value="Login">
                 </form>';
                 } ?>
            </div>
            <div style="clear: both;"></div>
        </div>
    </nav>
</header>