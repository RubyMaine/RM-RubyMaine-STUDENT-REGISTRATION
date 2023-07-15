<?php

include('config.php');

if(isset($_POST['submit'])){
	$u_card = $_POST['card_no'];
	$u_f_name = $_POST['user_first_name'];
	$u_l_name = $_POST['user_last_name'];
	$u_father = $_POST['user_father'];
	$u_aadhar = $_POST['user_aadhar'];
	$u_birthday = $_POST['user_dob'];
	$u_gender = $_POST['user_gender'];
	$u_email = $_POST['user_email'];
	$u_phone = $_POST['user_phone'];
	$u_state = $_POST['state'];
	$u_dist = $_POST['dist'];
	$u_village = $_POST['village'];
	$u_police = $_POST['police_station'];
	$u_pincode = $_POST['pincode'];
	$u_mother = $_POST['user_mother'];
	$u_family = $_POST['family'];
	$u_staff_id = $_POST['staff_id'];
	


	//image upload

	$msg = "";
	$image = $_FILES['image']['name'];
	$target = "upload_images/".basename($image);

	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}

  	$insert_data = "INSERT INTO student_data(u_card, u_f_name, u_l_name, u_father, u_aadhar, u_birthday, u_gender, u_email, u_phone, u_state, u_dist, u_village, u_police, u_pincode, u_mother, u_family, staff_id,image,uploaded) VALUES ('$u_card','$u_f_name','$u_l_name','$u_father','$u_aadhar','$u_birthday','$u_gender','$u_email','$u_phone','$u_state','$u_dist','$u_village','$u_police','$u_pincode','$u_mother','$u_family','$u_staff_id','$image',NOW())";
  	$run_data = mysqli_query($con,$insert_data);

  	if($run_data){
		  $added = true;
  	}else{
  		echo "Data not insert";
  	}

}

?>


<!--Writing HTML Code here from bootstrap templates-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="icon" type="image/png" href="images/favicon.png" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
        <title> Кириш | RubyMaine </title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#" style="font-size: 30px;"><img src="images/RubyMaine.png" style="width: 30%;" alt="Card image cap" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="form-inline my-2 my-lg-0">
                    <a href="register.php" class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fa fa-address-card">&nbsp;</i> Талаба қўшиш </a>
                </form>
            </div>
        </nav>

        <div class="container" style="margin-top: 6%;">
            <div class="card mx-auto" style="width: 30rem;">
                <br />
                <img class="card-img-top mx-auto" src="images/logo.png" style="width: 60%;" alt="Card image cap" />
                <div class="card-body">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label><i class="fa fa-user-circle-o">&nbsp;</i> Фойдаланувчининг номини киритинг: </label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label><i class="fa fa-key">&nbsp;</i> Фойдаланувчининг паролини киритинг: </label>
                            <input type="password" name="password" class="form-control">
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>

                        <button type="submit" class="btn btn-success"><i class="fa fa-sign-in">&nbsp;&nbsp;</i> Кириш </button>
                        <button type="reset" class="btn btn-danger"><i class="fa fa-unlock-alt">&nbsp;</i> Пароль тиклаш </button>
                        <a href="register.php" class="btn btn-info my-2 my-sm-0" type="submit"><i class="fa fa-address-card">&nbsp;</i> Рўйҳатдан ўтиш </a>
                    </form>
                </div>
            </div>
        </div>

        <!--footer section-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>