<form action = "register_prepare.php" method = "POST">
<strong>Username</strong> <?php ?> <br />
<input type = "text" name = "rd_username" value = "<?php if(isset($_POST['rd_username'])) {echo $_POST['rd_username'];}?>"> <br />
<strong>Password:</strong> <br />
<input type = "password" name = "rd_password"> <br />
<strong>Repeat pasword:</strong> <br />
<input type = "password" name = "rd_repeatPassword"> <br />
<strong>First name:</strong> <br />
<input type = "text" name = "rd_firstName" value = "<?php if(isset($_POST['rd_firstName'])) {echo $_POST['rd_firstName'];}?>"> <br />
<strong>Last name:</strong> <br />
<input type = "text" name = "rd_lastName" value = "<?php if(isset($_POST['rd_lastName'])) {echo $_POST['rd_lastName'];}?>"> <br />
<strong>Property name:</strong> <br />
<input type = "text" name = "rd_propertyName" value = "<?php if(isset($_POST['rd_propertyName'])) {echo $_POST['rd_propertyName'];}?>"> <br />
<strong>Address:</strong> <br />
<input type = "text" name = "rd_address" value = "<?php if(isset($_POST['rd_address'])) {echo $_POST['rd_address'];}?>"> <br />
<strong>Price:</strong> <br />
<input type = "text" name = "rd_price" value = "<?php if(isset($_POST['rd_price'])) {echo $_POST['rd_price'];}?>"> <br /> <br />
<input type = "submit" value = "Submit"> <br />
</form>