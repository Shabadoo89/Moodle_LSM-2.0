/* 
The following code inserts the information typed into the fields of the signup page into the database of users and stores it there.
*/

<?php
 include_once 'header.php';
  if ( isset($_POST['signup']) ) {

  	$name = $_POST['name'];
   $username = $_POST['email']; // required
    $password = $_POST['pass']; // required
    $studentid = $_POST['sid'];
    $repassword = $_POST['repass'];

      $sql = "SELECT username, email, password, student_admin, student_name FROM lms WHERE email = '" . $_POST['email'] . "'";
$result = $conn->query($sql);
  $pass = trim($_POST['pass']);
  $email = trim($_POST['email']);
  $sid = trim($_POST['sid']);
  $checkemail = "SELECT email FROM lms WHERE email = '$email'";
  $result = $conn->query($checkemail);


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

    if ($repEmail->num_rows > 0) {
    $errors=1;
    $error_message .= 'Email is registered.\n';
    }  

    if($password != $repassword){
    	$errors=1;
    	$error_message .= 'Passwords do not match\n';
    }

    if($name == ''){
    	$errors=1;
    	$error_message .= 'name cannot be blank\n';
    }

     if($username == ''){
    	$errors=1;
    	$error_message .= 'email cannot be blank\n';
    }

     if($password == ''){
    	$errors=1;
    	$error_message .= 'password cannot be blank\n';
    }

    if($studentid == ''){
      $errors=1;
      $error_message .= 'student id cannot be blank\n';
    }
 

  if($errors==0){
         $query = "INSERT INTO lms (username, email, password, student_name, student_id) VALUES('$name', '$username', '$password', '$name', '$studentid')";
      mysqli_query($conn, $query);
        header('location: index.php');
  }else{
   echo "<script type='text/javascript'>alert('$error_message');</script>";
    }
}
?>
<style type="text/css">
	input{
		padding: 20px;
	}
</style>
<section class = "main-container">
    <div class = "main-wrapper">
        <h2>Sign Up</h2>
        
         <form method="post" style="margin: 0 auto; width: 1000px;" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF'];?>">
                            <input type="email" name="email" placeholder="Email *" required>
                            <input type="text" name="name" placeholder="Name *" required>
                             <input type="text" name="sid" placeholder="Student ID *" required>
                            <input type="password" name="pass" placeholder="Password *" required>
                            <input type="password" name="repass" placeholder="Repeat Password *" required>
                            <input type="submit" name="signup" value="Register">
                        </form>

    </div>
</section>

<?php
    include_once 'footer.php';
?>