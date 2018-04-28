/* 
Moodle_LSM-2.0
Jesus Daniel Reveles
Objective: The following code allows the website to create an account as well as verifiy that the account is verified. In short it authenticates and validates
as well as creates accounts to login for students and admins.
*/

<?php
include('header.php');
$username = $_SESSION['u_id'];
$sql = "SELECT username, email, password, student_name, student_id, student_courses, student_score1, student_score2, student_score3, student_admin FROM lms";
$result = $conn->query($sql);
$sql2 = "SELECT username, email, password, student_name, student_id, student_courses, student_score1, student_score2, student_score3, student_admin FROM lms WHERE email = '$username'";
$result2 = $conn->query($sql2);
$sql3 = "SELECT username, email, password, student_name, student_id, student_courses, student_score1, student_score2, student_score3, student_admin FROM lms WHERE email = '$username'";
$result3 = $conn->query($sql3);
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
        <h2 style="padding-bottom: 20px;">Account</h2>
        <h4 style="text-align: center; padding-bottom: 20px;">Student Info</h4>
            <table style="margin: 0 auto;">
	<tr>
    <th>Name</th>
    <th>ID</th>
    <th>Courses</th>
    <th>Scores</th>
    <th>GPA</th>
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
      	 

							$gpascore1 = 0;
							$gpascore2 = 0;
							$gpascore3 = 0;
							if($score1 >= '90'){
								$gpascore1 = 4.0;
							}else{
								if($score1 >= '80' && $score1 <= '89'){
									$gpascore1 = 3.0;
								}else{
									if($score1 >= '70' && $score1 <= '79'){
										$gpascore1 = 2.0;
									}else{
									if($score1 >= '60' && $score1 <= '69'){
										$gpascore1 = 1.0;
									}else{
									if($score1 >= '0' && $score1 <= '59'){
										$gpascore1 = 0.0;
									}
								}
								}
							}
						}
        if($score2 >= '90'){
        		$gpascore2 = 4.0;
        	}else{
        		if($score2 >= '80' && $score2 <= '89'){
        			$gpascore2 = 3.0;
        		}else{
        			if($score2 >= '70' && $score2 <= '79'){
        				$gpascore2 = 2.0;
        			 }else{
        			 if($score2 >= '60' && $score2 <= '69'){
        			 	$gpascore2 = 1.0;
        			 }else{
        			 if($score2 >= '0' && $score2 <= '59'){
        			 	$gpascore2 = 0.0;
        			 }
        		}
        		}
        	}
        }
        if($score3 >= '90'){
        		$gpascore3 = 4.0;
        	}else{
        		if($score3 >= '80' && $score3 <= '89'){
        			$gpascore3 = 3.0;
        		}else{
        			if($score3 >= '70' && $score3 <= '79'){
        				$gpascore3 = 2.0;
        			 }else{
        			 if($score3 >= '60' && $score3 <= '69'){
        			 	$gpascore3 = 1.0;
        		 	}else{
        		 	if($score3 >= '0' && $score3 <= '59'){
        				$gpascore3 = 0.0;
        			}
        		 }
        		}
        	}
        }
           echo "<tr>";
                echo "<td>".$name."</td>";
                echo "<td>".$id."</td>";
                echo "<td>".$courses."</td>";
                echo "<td>".$score1. "," .$score2. "," .$score3."</td>";
                echo "<td>". ($gpascore1 + $gpascore2 + $gpascore3) / 3 ."</td>";
                echo '<td><button onclick="window.location.href=\'edit.php?edituser='.$email.'\'">Edit</button></td>';
                echo "</tr>";

       
			}
		}
            if($admin == '0'){
            	while ($row3 = mysqli_fetch_array($result3)){
				$name3 = $row3['student_name'];
				$email3 = $row3['email'];
				$id3 = $row3['student_id'];
				$courses3 = $row3['student_courses'];
				$score13 = $row3['student_score1'];
				$score23 = $row3['student_score2'];
				$score33 = $row3['student_score3'];

				$gpascore13 = 0;
				$gpascore23 = 0;
				$gpascore33 = 0;
        	if($score13 >= '90'){
        		$gpascore13 = 4.0;
        	}else{
        		if($score13 >= '80' && $score13 <= '89'){
        			$gpascore13 = 3.0;
        		}else{
        			if($score13 >= '70' && $score13 <= '79'){
        				$gpascore13 = 2.0;
        			}else{
        			 if($score13 >= '60' && $score13 <= '69'){
        			 	$gpascore13 = 1.0;
        			 }else{
        		 	if($score13 >= '0' && $score13 <= '59'){
        		 		$gpascore13 = 0.0;
        		 	}
        		 }
        		}
        	}
        }
        if($score23 >= '90'){
        		$gpascore23 = 4.0;
        	}else{
        		if($score23 >= '80' && $score23 <= '89'){
        			$gpascore23 = 3.0;
        		}else{
        			if($score23 >= '70' && $score23 <= '79'){
        				$gpascore23 = 2.0;
        			 }else{
        			 if($score23 >= '60' && $score23 <= '69'){
        			 	$gpascore23 = 1.0;
        			 }else{
        			 if($score23 >= '0' && $score23 <= '59'){
        			 	$gpascore23 = 0.0;
        			 }
        		}
        	}
        }
    }
        if($score33 >= '90'){
        		$gpascore33 = 4.0;
        	}else{
        		if($score33 >= '80' && $score33 <= '89'){
        			$gpascore33 = 3.0;
        		}else{
        			if($score33 >= '70' && $score33 <= '79'){
        				$gpascore33 = 2.0;
        			 }else{
        			 if($score33 >= '60' && $score33 <= '69'){
        			 	$gpascore33 = 1.0;
        		 	}else{
        		 	if($score33 >= '0' && $score33 <= '59'){
        				$gpascore33 = 0.0;
        			}
        		}
        	}
        }
    }	
           		echo "<tr>";
                echo "<td>".$name3."</td>";
                echo "<td>".$id3."</td>";
                echo "<td>".$courses3."</td>";
                echo "<td>".$score13. "," .$score23. "," .$score33."</td>";
                echo "<td>". ($gpascore13 + $gpascore23 + $gpascore33) / 3 ."</td>";
                echo "</tr>";
		}
	}
}
    ?>
    </table>
    </div>
</section>

<?php
    include('footer.php');
?>