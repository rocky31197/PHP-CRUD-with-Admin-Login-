
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php

include ('conn.php');
    session_start();
    $message="";
    if(count($_POST)>0) {
        $result = mysqli_query($conn,"SELECT * FROM admin_user WHERE username='" . $_POST["user_name"] . "' and password = '". $_POST["password"]."'");
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
        $_SESSION["id"] = $row['id'];
        $_SESSION["name"] = $row['name'];
        } else {
         $message = "Invalid Username or Password!";
        }
    }
    if(isset($_SESSION["id"])) {
    header("Location:index.php");
    }
        
?>
<html>
<head>
<title>Admin Login</title>
</head>
<body class="">
<br>
<div class="container" align="center">
	
    <h2>Admin Login</h2>
    <form class="card-form col-md-4" name="frmUser" method="post" action="">
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
        <div class="form-group">
                    <label for="name" class="mt-2">Username</label>
                    <input type="name" class="form-control" name = "user_name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="name" class="mt-2">Password</label>
                    <input type="password" class="form-control" name = "password" id="password" required>
                </div>
        <div class="form-group">
        <input type="submit" class="btn-primary" name="submit" value="Submit">
        <input type="reset" class="btn-primary">
        </div>
    </form>
	<br>
	</div>
</div>
</body>
</html>
