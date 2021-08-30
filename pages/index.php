<?php 
		
		if(!isset($_SESSION["session_username"])):
		header("location:login");
		else:
?>

<?php
	$title = "Список ваших заказов";
	include("header.php"); 
	$login = $_SESSION['session_username'];
	$id = mysqli_query($link, "SELECT `code_client` FROM `client` WHERE `login` LIKE '$login'");
	
	$idresult =  mysqli_fetch_assoc($id);
	$idresult = $idresult['code_client'];
	
	if ($idresult)
	{
		
		include("menu.php"); 
		
$list = 1;
$otbor = $_SESSION['session_fullname'];
$sql11 = "SELECT * FROM `fullorder` WHERE `code_client` LIKE '$otbor'";
$result = $link->query($sql11);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<div class="container mt-3" style="padding-top:70px;">
<h1 class="text-center">  Список ваших заказов</h1>
                <?php if(!empty($arr_users)) { ?>
                    <?php foreach($arr_users as $user) { ?>
                          <div class="card" style="width:100%; display: inline-block;top: 10px;margin-left: 10px;margin-top: 10px;">
						      <div class="card-header bg-info text-white"><h4 class="card-title" style="margin-bottom: 0px;"><div style="font-size: 1.9em;color: white; float:left; margin: -13px 10px 2px 0;">#<?php echo $list ?> </div> Краткая информация о вашем заказе <span class="badge badge-secondary">№<?php echo $user['number']; ?></span></h4></div>
							  <div class="card-body" style="background-image: url(/img/ordback.png);padding-bottom: 15px;padding-top: 15px;">
								<table>
								<tbody>
								<td style="width: 200px;border-right: 1px dotted maroon;">
								<kbd style="background-color: #c5c5c5;color: black;">Дата заказа:</kbd> <br>
								<kbd style="background-color: #c5c5c5;color: black;">Тип:</kbd> <br>
								<kbd style="background-color: #c5c5c5;color: black;">Материал:</kbd> <br>
								<kbd style="background-color: #c5c5c5;color: black;">Размер:</kbd> <br>
								<kbd style="background-color: #c5c5c5;color: black;">Статус:</kbd> <br>
								<kbd style="background-color: #c5c5c5;color: black;">Адрес:</kbd> 
								</td>
								<td style="padding-left: 10px;">
								<?php echo $user['date']; ?><br>
								<?php echo $user['type']; ?><br>
								<?php echo $user['type_material']; ?><br>
								<?php echo $user['type_size']; ?><br>
								<?php echo $user['status']; ?><br>
								<?php echo $user['address']; ?>
								</td>
								</tbody>
								</table>
							  </div> 
							  <div class="card-footer">
							  		<a href="?see=<?php echo $user['id'];?>" style="display: block;" data-toggle="tooltip">
										 <button type="button" class="btn btn-info">Подробнее</button>
									</a>
							  </div>
						   </div>
                    <?php $list++;}
                   ?>
                <?php } 

                 if(empty($arr_users)) {
                	echo " <div class='alert alert-danger'>
    <strong>У вас нет заказов!</strong> Обратитесь к администратору.
  </div>";
                } ?>
    </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>	
    <script>
        $(document).ready(function() {
            $('#usetTable').DataTable({
				"language": {
					"url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json"
				}			
			});
        } );
    </script>
<?php
			if (isset($_GET['see'])){
				
				$_SESSION['info'] = $_GET['see'];
				echo"<script>
						setTimeout(function() { location.replace('info') });
					</script>"; 
					
			}
	
	}
	else 
	{
		$title = "Ошибка доступа";

echo "<div class='alert alert-danger'>
    <strong>Внимание!</strong> Произошла ошибка при попоытке входа в аккаунт! Обратитесь к администратору! <a href='/logout.php' class='alert-link'>Выйти из аккаунта.</a>
  </div>";
		exit;
	}
	mysqli_close($link);
	 include("footer.php");
?>

<?php endif; ?>