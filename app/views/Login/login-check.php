<?php
ob_start();
require_once "config/database.php";
require_once  "../../Classes/PHPExcel.php"; 
$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = sha1(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

if (!ctype_alnum($username) OR !ctype_alnum($password)) {
	header("Location: index.php?alert=1");
}
else {

	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		session_start();

		<script type="text/javascript">
			$(document).ready(function() {
				$('#loginform').submit(function(e) {
					e.preventDefault();
					$.ajax({
						type: "POST",
						url: 'login-check.php',
						data: $(this).serialize(),
						success: function(response)
						{
							var jsonData = JSON.parse(response);
			
							// user is logged in successfully in the back-end
							// let's redirect
							if (jsonData.success == "1")
							{
								location.href = 'main.php';
							}
							else
							{
								alert('Invalid Credentials!');
							}
					}
				});
				});
			});
</script>

		$referenciaPagina = 'main.php?module=start';
		header("Location:$referenciaPagina");
	}


	else {
		header("Location: index.php?alert=1");
	}
}
?>