<?php 
	if(isset($_SESSION["session_username"])) {
    header("Location: /login");
		exit;
	} else {
	$title = "Вход";
	include("header.php");
	
	if(isset($_POST["login"]))
{

	if (!empty($_POST['username']) && !empty($_POST['password'])) {
	$username=htmlspecialchars($_POST['username']);
	$password = htmlspecialchars($_POST['password']);

	$fullname = mysqli_query($link, "SELECT `login` FROM `client` WHERE `login` LIKE '$username'");
	$fullnameresult =  mysqli_fetch_assoc($fullname);
	$fullnameresult = $fullnameresult['login'];
	
	$fullnamename = mysqli_query($link, "SELECT `fio` FROM `client` WHERE `login` LIKE '$username'");
	$fullnamenameresult =  mysqli_fetch_assoc($fullnamename);
	$fullnamenameresult = $fullnamenameresult['fio'];
	
	$query= mysqli_query($link, "SELECT * FROM `client` WHERE `login` LIKE '$username'");
	$numrows=mysqli_num_rows($query);
	   
		if($numrows!=0)
		{
				while($row=mysqli_fetch_assoc($query))
				{
					$dbusername=$row['login'];
				}
				$hashbd = mysqli_query($link, "SELECT `password` FROM `client` WHERE `login` LIKE '$username'");
				$hashbdresult =  mysqli_fetch_assoc($hashbd);
				$hashbdresult = $hashbdresult['password'];

			if (password_verify($password, $hashbdresult)) {
                    $_SESSION['session_username'] = $fullnameresult;
                    $_SESSION['session_fullname'] = $fullnamenameresult;
                    header("Location: /");
                    exit;
                }
			else
			{
				$message = "Ошибка имени пользователя!";
			}
		}
		else
		{
			$message = "Ошибка имени пользователя!";
		}
	}
}	
		mysqli_close($link);
?>
	<?php if (!empty($message)) {echo "<div class='alert alert-danger alert-dismissible fixed-bottom'>
    <button type='button' class='close' data-dismiss='alert'>×</button>
    <strong>Danger!</strong> " , $message , "</div>";}  ?>

  
  <div class="container block" style="height: 345px;">
  <h1>Вход для клиентов</h1>
  <form action="" id="loginform" method="post" name="loginform">
    <div class="form-group">
      <label for="user_login">Логин:</label>
      <input type="username" required class="form-control" id="username" name="username">
    </div>
    <div class="form-group">
      <label for="password">Пароль:</label>
      <input type="password" required class="form-control" id="password" name="password">
    </div>
    <button type="submit" name="login" class="btn btn-purple float-right">Войти</button>
  </form>
</div>

<?php
include("footer.php"); 
	}
	?>