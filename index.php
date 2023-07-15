<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// database connection
include('config.php');

$added = false;


//Add  new student code 

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

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="images/favicon.png" />
	<title> Бош саҳифа | RubyMaine  </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="container-fluid">
        <hr><a href="https://lexacademy.in" target="_blank"><img src="images/RubyMaine.png" style="width: 99%;" alt="Card image cap" /></a><br><hr>

        <!-- adding alert notification  -->
        <?php
            if($added){
                echo "
                    <div class='btn-success' style='padding: 15px; text-align:center;'>
                        Талабанинг маълумотлари муваффақиятли рўйҳатга қўшилди.
                    </div><br>
                ";
            }

        ?>

        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Янги талаба қўшиш </button>
        <a href="logout.php" class="btn btn-danger pull-right"> Профильдан чиқиш <i class="fa fa-sign-out"></i></a>
        <form class="pull-right" method="post" action="export.php">
            <button class="btn btn-success " type="submit" name="export"><b><i class="fa fa-file-excel-o"></i> Excel</b> форматида юклаб олиш </button>&nbsp;
        </form>
        <hr>
		<table class="table table-bordered table-striped table-hover" id="myTable">
		<thead>
			<tr>
			   <th class="text-center" scope="col"> #№ </th>
				<th class="text-center" scope="col"> Ф.И.О: </th>
				<th class="text-center" scope="col"> #ID Талабанинг: </th>
				<th class="text-center" scope="col"> Телефон рақами: </th>
				<th class="text-center" scope="col"> Идентификатор: </th>
				<th class="text-center" scope="col"> Профильни кўриш: </th>
				<th class="text-center" scope="col"> Профильни таҳрирлаш: </th>
				<th class="text-center" scope="col"> Профильни ўчириш: </th>
			</tr>
		</thead>
			<?php
        	$get_data = "SELECT * FROM student_data order by 1 desc";
        	$run_data = mysqli_query($con,$get_data);
			$i = 0;
        	while($row = mysqli_fetch_array($run_data))
        	{
				$sl = ++$i;
				$id = $row['id'];
				$u_card = $row['u_card'];
				$u_f_name = $row['u_f_name'];
				$u_l_name = $row['u_l_name'];
				$u_phone = $row['u_phone'];
				$u_family = $row['u_family'];
				$u_staff_id = $row['staff_id'];
        		$image = $row['image'];
        		echo "

				<tr>
				<td class='text-center'>$sl</td>
				<td class='text-left'>$u_f_name   $u_l_name</td>
				<td class='text-left'>$u_card</td>
				<td class='text-left'>$u_phone</td>
				<td class='text-center'>$u_staff_id</td>
			
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-success mr-3 profile' data-toggle='modal' data-target='#view$id' title='Prfile'><i class='fa fa-address-card-o' aria-hidden='true'></i></a>
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					<a href='#' class='btn btn-warning mr-3 edituser' data-toggle='modal' data-target='#edit$id' title='Edit'><i class='fa fa-pencil-square-o fa-lg'></i></a>

					     
					    
					</span>
					
				</td>
				<td class='text-center'>
					<span>
					
						<a href='#' class='btn btn-danger deleteuser' title='Delete'>
						     <i class='fa fa-trash-o fa-lg' data-toggle='modal' data-target='#$id' style='' aria-hidden='true'></i>
						</a>
					</span>
					
				</td>
			</tr>

        		";
        	}

        	?>
		</table>
	</div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <center><img src="images/RubyMaine.png" style="width: 99%;" alt="Card image cap" /></center>
          </div>
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">


                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label><i class="fa fa-picture-o"></i> Талабанинг (3х4) расмидан 1 дона киритинг: </label>
                        <input type="file" name="image" class="form-control" >
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4"><i class="fa fa-id-badge"></i> Талабанинг #ID рақами: </label>
                        <input type="text" class="form-control" name="card_no" placeholder="Талабанинг #ID рақамини киритинг ..." maxlength="12" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4"><i class="fa fa-mobile"></i> Талабанинг телефон рақами: </label>
                        <input type="phone" class="form-control" name="user_phone" placeholder="Талабанинг телефон рақамини киритинг ..." maxlength="10" required>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstname"><i class="fa fa-id-card-o"></i> Талабанинг Исми: </label>
                        <input type="text" class="form-control" name="user_first_name" placeholder="Талабанинг Исмини киритинг ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastname"><i class="fa fa-id-card-o"></i> Талабанинг Фамилияси: </label>
                        <input type="text" class="form-control" name="user_last_name" placeholder="Талабанинг Фамилиясини киритинг ...">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fathername"><i class="fa fa-address-card"></i> Талабанинг Отасининг исми: </label>
                        <input type="text" class="form-control" name="user_father" placeholder="Талабанинг Отасининг исмини киритинг ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mothername"><i class="fa fa-address-card-o"></i> Талабанинг Онасининг исми: </label>
                        <input type="text" class="form-control" name="user_mother" placeholder="Талабанинг Онасининг исмини киритинг ...">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email"><i class="fa fa-envelope"></i> Талабанинг Email - Почтаси: </label>
                        <input type="email" class="form-control" name="user_email" placeholder="Талабанинг Email - Почтасини киритинг ...">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="aadharno"><i class="fa fa-phone-square"></i> Талабанинг Уй телефон рақами: </label>
                        <input type="text" class="form-control" name="user_aadhar" maxlength="12" placeholder="Талабанинг Уй телефон рақамини киритинг ...">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputState"><i class="fa fa-grav"></i> Жинси: </label>
                        <select id="inputState" name="user_gender" class="form-control">
                            <option selected> Танланг ...</option>
                            <option> Эркак </option>
                            <option> Аёл </option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4"><i class="fa fa-calendar-check-o"></i> Туғилган куни: </label>
                        <input type="date" class="form-control" name="user_dob" placeholder="Date of Birth">
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="inputAddress"><i class="fa fa-home"></i> Талабанинг турар жой манзили: </label>
                        <input type="text" class="form-control" name="village" placeholder="Талабанинг турар жой манзилини киритинг ...">
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity"><i class="fa fa-podcast"></i> Талаба қайси вилоятдан: </label>
                        <input type="text" class="form-control" name="dist" placeholder="Талаба қайси вилоятдан ёзинг ...">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState"><i class="fa fa-sitemap"></i> Қайси йўналишда: </label>
                        <select name="state" class="form-control">
                            <option selected> Танланг ...</option>
                            <option value="Андижон вилояти"> Андижон вилояти </option>
                            <option value="Бухоро вилояти"> Бухоро вилояти </option>
                            <option value="Фарғона вилояти"> Фарғона вилояти </option>
                            <option value="Жиззах вилояти"> Жиззах вилояти </option>
                            <option value="Хоразм вилояти"> Хоразм вилояти </option>
                            <option value="Наманган вилояти"> Наманган вилояти </option>
                            <option value="Навоий вилояти"> Навоий вилояти </option>
                            <option value="Қашқадарё вилояти"> Қашқадарё вилояти </option>
                            <option value="Қорақалпоғистон Республикаси"> Қорақалпоғистон Республикаси </option>
                            <option value="Самарқанд вилояти"> Самарқанд вилояти </option>
                            <option value="Сирдарё вилояти"> Сирдарё вилояти </option>
                            <option value="Сурхондарё вилояти"> Сурхондарё вилояти </option>
                            <option value="Тошкент вилояти"> Тошкент вилояти </option>
                            </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip"><i class="fa fa-line-chart"></i> Балл: </label>
                        <input type="text" class="form-control" name="pincode" placeholder="Балл">
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="inputAddress2"><i class="fa fa-cc"></i> Олий таълим: Факултет коди: </label>
                        <input type="text" class="form-control" name="police_station" placeholder="Олий таълим: Факултет кодини киритинг ...">
                    </div>
                </div>


                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="inputAddress"><i class="fa fa-cc"></i> Олий таълим: Йўналиш коди: </label>
                        <input type="text" class="form-control" name="staff_id" maxlength="12" placeholder="Олий таълим: Йўналиш кодини киритинг ...">
                    </div>
                </div>
			

                <div class="form-group">
                    <div class="form-group col-md-12">
                        <label for="family"><i class="fa fa-pencil-square-o"></i> Изоҳ қолдиринг: </label>
                        <textarea class="form-control" name="family" rows="3"></textarea>
                    </div>
                </div>

              <div class="modal-footer" style="border-top: 1px solid #ffffff;">
                  <div class="form-group col-md-12">
                    <input type="submit" name="submit" class="btn btn-success" value="Талабани рўйхатга қўшиш!">
                  </div>
              </div>

        	</form>
          </div>

        </div>
      </div>
    </div>

<!------DELETE modal---->

<!-- Modal -->
<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	echo "

<div id='$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h3 class='modal-title text-center'>Ишончингиз ҳосилми? Ўчирмоқчимисиз???</h3>
      </div>
      <div class='modal-body'>
        <a href='delete.php?id=$id' class='btn btn-danger' style='margin-left:200px'>ЎЧИРИШ ЮБОРИШ</a>
      </div>

    </div>
  </div>
</div>

	";
}
?>

<!-- View modal  -->
<?php 

// <!-- profile modal start -->
$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$aadhar = $row['u_aadhar'];
	$Bday = $row['u_birthday'];
	$family = $row['u_family'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$village = $row['u_village'];
	$police = $row['u_police'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$time = $row['uploaded'];
	
	$image = $row['image'];
	echo "

		<div class='modal fade' id='view$id' tabindex='-1' role='dialog' aria-labelledby='userViewModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
			<div class='modal-header'>
				<h2 class='modal-title' id='exampleModalLabel'><i class='fa fa-id-card' aria-hidden='true'></i> Талабанинг профилини кўриш! </h2>
				<button type='button' class='close' data-dismiss='modal' aria-label='Бекор қилиш'>
				<span aria-hidden='true'>&times;</span>
				</button>
			</div>
			<div class='modal-body'>
			<div class='container' id='profile'> 
				<div class='row'>
					<div class='col-sm-4 col-md-2'>
						<img src='upload_images/$image' alt='' style='width: 150px; height: 150px;' ><br>
						<strong><i class='fa fa-id-card' aria-hidden='true'></i> Талабанинг #ID: </strong> $card <br>
						<strong><i class='fa fa-phone' aria-hidden='true'></i> Tелефон рақами: </strong> $phone  <br><br>
						<strong><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Рўйхатдан ўтган: </strong> $time
					</div>
					<div class='col-sm-3 col-md-6'>
						<h3 class='text-primary'><i class='fa fa-id-badge' aria-hidden='true'></i> $name $name2 </h3>
						<p class='text-secondary'>
						<strong><i class='fa fa-male' aria-hidden='true'></i> Отасининг исми: </strong> $father <br>
						<strong><i class='fa fa-female' aria-hidden='true'></i> Онасининг исми: </strong> $mother <br>
						<strong><i class='fa fa-phone-square'></i> Уй телефон рақами: </strong> $aadhar <br>
						<strong><i class='fa fa-grav' aria-hidden='true'></i> Жинси: </strong> $gender <br />
						<strong><i class='fa fa-envelope' aria-hidden='true'></i> Email - Почтаси: </strong> $email <br />
						<div class='card' style='width: 18rem;'>
						<i class='fa fa-users' aria-hidden='true'></i><strong> Қолдирилган изоҳлар : </strong>
								<div class='card-body'>
								    <p> $family </p>
								</div>
						</div>
						<strong><i class='fa fa-home' aria-hidden='true'></i>  Талабанинг турар жой манзили: </strong><br /> $village, $police, <br> $dist, $state - $pincode
						<br />
						</p>
						<!-- Split button -->
					</div>
				</div>

			</div>   
			</div>
			<div class='modal-footer'>
				<button type='button' class='btn btn-secondary' data-dismiss='modal'>Бекор қилиш</button>
			</div>
			</form>
			</div>
		</div>
		</div> 


    ";
}


// <!-- profile modal end -->


?>





<!----edit Data--->

<?php

$get_data = "SELECT * FROM student_data";
$run_data = mysqli_query($con,$get_data);

while($row = mysqli_fetch_array($run_data))
{
	$id = $row['id'];
	$card = $row['u_card'];
	$name = $row['u_f_name'];
	$name2 = $row['u_l_name'];
	$father = $row['u_father'];
	$mother = $row['u_mother'];
	$gender = $row['u_gender'];
	$email = $row['u_email'];
	$aadhar = $row['u_aadhar'];
	$Bday = $row['u_birthday'];
	$family = $row['u_family'];
	$phone = $row['u_phone'];
	$address = $row['u_state'];
	$village = $row['u_village'];
	$police = $row['u_police'];
	$dist = $row['u_dist'];
	$pincode = $row['u_pincode'];
	$state = $row['u_state'];
	$staffCard = $row['staff_id'];
	$time = $row['uploaded'];
	$image = $row['image'];
	echo "

<div id='edit$id' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal content-->
    <div class='modal-content'>
      <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h3 class='modal-title text-center'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Талабанинг маълумотларини ўзгартириш </h3> 
      </div>

      <div class='modal-body'>
        <form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>


        <div class='form-group'>
            <div class='form-group col-md-12'>
                <label><i class='fa fa-picture-o'></i> Талабанинг (3х4) расмидан 1 дона киритилган: </label>
                <input type='file' name='image' class='form-control'>
                <img src = 'upload_images/$image' style='width:50px; height:50px'>
            </div>
        </div>


        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='inputEmail4'><i class='fa fa-id-badge'></i> Талабанинг #ID рақами: </label>
                <input type='text' class='form-control' name='card_no' placeholder='Талабанинг #ID рақамини киритинг ...' maxlength='12' value='$card' required>
            </div>
            <div class='form-group col-md-6'>
                <label for='inputPassword4'><i class='fa fa-mobile'></i> Талабанинг телефон рақами: </label>
                <input type='phone' class='form-control' name='user_phone' placeholder='Талабанинг телефон рақамини киритинг ...' maxlength='10' value='$phone' required>
            </div>
        </div>


        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='firstname'><i class='fa fa-id-card-o'></i> Талабанинг Исми: </label>
                <input type='text' class='form-control' name='user_first_name' placeholder='Талабанинг Исмини киритинг ...' value='$name'>
            </div>
            <div class='form-group col-md-6'>
                <label for='lastname'><i class='fa fa-id-card-o'></i> Талабанинг Фамилияси: </label>
                <input type='text' class='form-control' name='user_last_name' placeholder='Талабанинг Фамилиясини киритинг ...' value='$name2'>
            </div>
        </div>


        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='fathername'><i class='fa fa-address-card'></i> Талабанинг Отасининг исми: </label>
                <input type='text' class='form-control' name='user_father' placeholder='Талабанинг Отасининг исмини киритинг ...' value='$father'>
            </div>
            <div class='form-group col-md-6'>
                <label for='mothername'><i class='fa fa-address-card-o'></i> Талабанинг Онасининг исми: </label>
                <input type='text' class='form-control' name='user_mother' placeholder='Талабанинг Онасининг исмини киритинг ...' value='$mother'>
            </div>
        </div>


        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='email'><i class='fa fa-envelope'></i> Талабанинг Email - Почтаси: </label>
                <input type='email' class='form-control' name='user_email' placeholder='Талабанинг Email - Почтасини киритинг ...' value='$email'>
            </div>
            <div class='form-group col-md-6'>
                <label for='aadharno'><i class='fa fa-phone-square'></i> Талабанинг Уй телефон рақами: </label>
                <input type='text' class='form-control' name='user_aadhar' maxlength='12' placeholder='Талабанинг Уй телефон рақамини киритинг ...' value='$aadhar'>
            </div>
        </div>


        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='inputState'><i class='fa fa-grav'></i> Жинси: </label>
                <select id='inputState' name='user_gender' class='form-control' value='$gender'>
                    <option selected> $gender </option>
                    <option> Эркак </option>
                    <option> Аёл </option>
                </select>
            </div>
            <div class='form-group col-md-6'>
                <label for='inputPassword4'><i class='fa fa-calendar-check-o'></i> Туғилган куни: </label>
                <input type='date' class='form-control' name='user_dob' placeholder='Date of Birth' value='$Bday'>
            </div>
        </div>


        <div class='form-group'>
            <div class='form-group col-md-12'>
                <label for='inputAddress'><i class='fa fa-home'></i> Талабанинг турар жой манзили: </label>
                <input type='text' class='form-control' name='village' placeholder='Талабанинг турар жой манзилини киритинг ...' value='$village'>
            </div>
        </div>


        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='inputCity'><i class='fa fa-podcast'></i> Талаба қайси вилоятдан: </label>
                <input type='text' class='form-control' name='dist' placeholder='Талаба қайси вилоятдан ёзинг ...' value='$dist'>
            </div>
            <div class='form-group col-md-4'>
                <label for='inputState'><i class='fa fa-sitemap'></i> Қайси йўналишда: </label>
                <select name='state' class='form-control'>
                    <option> $state </option>
                    <option selected> Танланг ...</option>
                    <option value='Андижон вилояти'> Андижон вилояти </option>
                    <option value='Бухоро вилояти'> Бухоро вилояти </option>
                    <option value='Фарғона вилояти'> Фарғона вилояти </option>
                    <option value='Жиззах вилояти'> Жиззах вилояти </option>
                    <option value='Хоразм вилояти'> Хоразм вилояти </option>
                    <option value='Наманган вилояти'> Наманган вилояти </option>
                    <option value='Навоий вилояти'> Навоий вилояти </option>
                    <option value='Қашқадарё вилояти'> Қашқадарё вилояти </option>
                    <option value='Қорақалпоғистон Республикаси'> Қорақалпоғистон Республикаси </option>
                    <option value='Самарқанд вилояти'> Самарқанд вилояти </option>
                    <option value='Сирдарё вилояти'> Сирдарё вилояти </option>
                    <option value='Сурхондарё вилояти'> Сурхондарё вилояти </option>
                    <option value='Тошкент вилояти'> Тошкент вилояти </option>
                    </select>
            </div>
            <div class='form-group col-md-2'>
                <label for='inputZip'><i class='fa fa-line-chart'></i> Балл: </label>
                <input type='text' class='form-control' name='pincode' placeholder='Балл' value='$pincode'>
            </div>
        </div>


        <div class='form-group'>
            <div class='form-group col-md-12'>
                <label for='inputAddress2'><i class='fa fa-cc'></i> Олий таълим: Факултет коди: </label>
                <input type='text' class='form-control' name='police_station' placeholder='Олий таълим: Факултет кодини киритинг ...' value='$police'>
            </div>
        </div>


        <div class='form-group'>
            <div class='form-group col-md-12'>
                <label for='inputAddress'><i class='fa fa-cc'></i> Олий таълим: Йўналиш коди: </label>
                <input type='text' class='form-control' name='staff_id' maxlength='12' placeholder='Олий таълим: Йўналиш кодини киритинг ...' value='$staffCard'>
            </div>
        </div>


        <div class='form-group'>
            <div class='form-group col-md-12'>
                <label for='family'><i class='fa fa-pencil-square-o'></i> Изоҳ қолдиринг: </label>
                <textarea class='form-control' name='family' rows='3'>$family</textarea>
            </div>
        </div>


		<div class='modal-footer' style='border-top: 1px solid #ffffff;'>
            <input type='submit' name='submit' class='btn btn-success' value='Талабанинг маълумотларини сақлаш'>
			<button type='button' class='btn btn-danger' data-dismiss='modal'>Бекор қилиш</button>
		</div>

        </form>
      </div>

    </div>

  </div>
</div>


	";
}


?>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>

</body>
</html>
