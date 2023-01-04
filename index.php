<!-- Database connection code -->
<?php 

	ob_start();

	$db = mysqli_connect('localhost', 'root', '', 'usermangement');
	if($db){
		
	}else{
		echo 'database connection error!';
	}
?>


<!-- Insert Code -->
<?php
     
	 if(isset($_POST['save info'])){
		$name 		= $_POST['name'];
		$email 		= $_POST['email'];
		$phone		= $_POST['Phone'];
		$pass 		= $_POST['pass'];

		$upass = sha1($pass);

		$sql2= " INSERT INTO users(name,email,phone,pass) VAlUES ('$name', '$email', '$upass')"; 
		$res2= mysqli_query($db,$sql2);

		if($res2){
			header('Location: index.php');
		}
		else{
			echo 'value insert error!';
		}
	 }

?>	 








<html>
    <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Management</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    </head>
    <body>
        <div class="users m-4">
            <div class="row g-0">
                <div class="col-md-4">
                    <h4>Add a new user</h4>
                    <form method="post" class="my-5">
                        <div class="mb-3">
                            <label for="username" class="form-label">Enter your name</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Fullname">
                        </div>
                        <div class="mb-3">
					  <label for="email" class="form-label">Email address</label>
					  <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
					</div>
					<div class="mb-3">
                            <label for="phone" class="form-label">Phone No</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="+8801XXXXXXXXX ">
                        </div>
					<div class="mb-3">
					  <label for="password" class="form-label">Password</label>
					  <input type="password" name="password" class="form-control" id="password" placeholder="Password">
					  <small class="text-danger">Password should be minimum 8 char long</small>
					</div>
					<input type="submit" name="saveinfo" class="btn btn-md btn-info" value="Add new user">
				</form>


                <h3>Update User</h3>	
					<form class="my-5" method="POST">
						<div class="mb-3">
						<label for="username" class="form-label">Enter your name</label>
						<input type="text" name="username" value="" class="form-control" id="usernameu" placeholder="Fullname">
						
						</div>
						<div class="mb-3">
						<label for="email" class="form-label">Email address</label>
						<input type="email" name="email" value="" class="form-control" id="emailu" placeholder="name@example.com">
						</div>
						<div class="mb-3">
                            <label for="phone" class="form-label"> Phone No</label>
                            <input type="text" name="phone" class="form-control" id="phoneu" placeholder="+8801XXXXXXXXX ">
                        </div>
						<div class="mb-3">
						<label for="password" class="form-label">Set New Password</label>
						<input type="password" name="password" class="form-control mb-3" id="passwordu" placeholder="Password">
						
						<label>Set your role</label>
						<select class="form-control" name="role">
							<!--  -->
						</select>

						<label>Set user status</label>
						<select class="form-control" name="status">
							<option value="1">Active</option>
							<option value="0" >Inactive</option>
						</select>

						<input type="hidden" value="" name="editid">

						</div>
						<input type="submit" name="updateinfo" class="btn btn-md btn-info" value="Add new user" >
					</form>

                        
                   
                </div>

                <div class="col-md-8">
				<h3 class="ms-5">All users information</h3>
				<table class="table m-5 table-striped">
				  <thead>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">Email</th>
					  <th scope="col">Phone</th>
				      <th scope="col">UserRole</th>
				      <th scope="col">Action</th>
				    </tr>
				  </thead>
				  <!-- Read code -->
				  
				  <?php 
				    
					   $sql= "select * from users";
					   $res = mysqli_query($db,$sql);

					   $serial = 0;


					   while($row = mysqli_fetch_assoc($res)){
						$id = $row['id'];
						$name =$row['name'];
						$email =$row['email'];
						$pass = $row['pass'];
						$role= $row['role'];
						$serial++;
						?>

					<tr>
						<th scope="row"><?php echo $serial;?></th>
						<td><?php echo $name;?></td>
						<td><?php echo $email;?></td>
						<td><?php echo $phone;?></td>
						<td><?php
						if($role==0){
							echo '<span class="badge bg-info">Subscriber </span>';
						} 
						if($role==1){
							echo '<span class="badge bg-success">Editor </span>';
						}
						if($role==2){
							echo '<span class="badge bg-danger">Admin </span>';
						}
						?></td>
						<td>
							<a href="index.php?edit_id=<?php echo $id;?>" class="badge bg-success">Edit</a>
							<a href="index.php?id=<?php echo $id;?>" class="badge bg-danger">Delete</a>
						</td>
                  	</tr>
					<?php
					   } 
					//    need to understand why we dont close php code after all code complete

                  ?>

                </table>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

	<?php ob_end_flush();?>
    </body>
 </html>