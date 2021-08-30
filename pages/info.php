<?php 

		if(!isset($_SESSION["session_username"])):
		header("location:login");
		else:

?>
<?php 
if(!isset($_SESSION["info"]))
{
					echo"<script>
						setTimeout(function() { location.replace('/') });
					</script>";
}
else{
$info1 = $_SESSION["info"];
$title = "Информация о заказе";
include("header.php"); 	
include("menu.php"); 

$sql11 = "SELECT * FROM `fullorder` WHERE `id` = '$info1'";
$result = $link->query($sql11);
$arr_users = [];
if ($result->num_rows > 0) {
    $arr_users = $result->fetch_all(MYSQLI_ASSOC);
}
?>
<div class="container mt-3" style="padding-top:70px;">
               <?php if(!empty($arr_users)) { ?>
                 <?php foreach($arr_users as $user) { ?>
					<h1 class="text-center">Просмотр заказа №<?php echo $user['number']; ?></h1>
						<div class="row" style="margin-right: 0px;">
						<div class="col-sm-4">
						
                          <div class="card" style="width: 95%;left: 10px; display: inline-block;top: 10px; margin-bottom: 20px;">
						      <div class="card-header bg-info text-white"><h4 class="card-title" style="margin-bottom: 0px;">Состояние заказа</h4></div>
							  <div class="card-body text-center" style="background-image: url(/img/ordback.png);">
								<?php echo $user['status']; ?>
							  </div> 
						   </div>
						<hr class="d-sm-none">
                          <div class="card" style="width: 95%;left: 10px;display: inline-block; margin-bottom: 20px;">
						      <div class="card-header bg-info text-white"><h4 class="card-title" style="margin-bottom: 0px;">Полная информация о заказе</h4></div>
							  <div class="card-body" style="background-image: url(/img/ordback.png);">
								<table>
								<tbody>
								<td>
								<kbd style="background-color: #c5c5c5;color: black;">Дата заказа:</kbd><br> <?php echo $user['date']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Тип:</kbd> <br><?php echo $user['type']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Материал:</kbd><br> <?php echo $user['type_material']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Размер м:</kbd><br> <?php echo $user['type_size']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Площадь кв/м2:</kbd><br> <?php echo $user['square']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Мансарда:</kbd><br> <?php echo $user['mansard']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Цоколь:</kbd><br> <?php echo $user['base']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Фундамент:</kbd><br> <?php echo $user['foundation']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Тип крыши:</kbd><br> <?php echo $user['type_roof']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Покрытие крыши:</kbd><br> <?php echo $user['coating_roof']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Внешняя отделка:</kbd><br> <?php echo $user['exterior_finish']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Утепление:</kbd><br><?php echo $user['warming']; ?><br>
								<kbd style="background-color: #c5c5c5;color: black;">Адрес:</kbd><br><?php echo $user['address']; ?>
								</td>
								</tbody>
								</table>
							  </div> 
							  </div> 

  </div>
  
    <div class="col-sm-8">
                          <div class="card" style="width: 95%;left: 10px; display: inline-block;top: 10px;">
						      <div class="card-header bg-info text-white"><h4 class="card-title" style="margin-bottom: 0px;">Фотографии</h4></div>
							  <div class="card-body" style="background-image: url(/img/ordback.png);">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#photo">Фото</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#video">Видео</a>
										</li>
									</ul>

							  <div class="tab-content">
							  <div id="photo" class="container tab-pane active"><br>
							  <div class="row">
								<?php 
									$sql11 = "SELECT * FROM `picture` WHERE `id_zakaz` = '$info1'";
									$result = $link->query($sql11);
									$arr_users = [];
									if ($result->num_rows > 0) {
										$arr_users = $result->fetch_all(MYSQLI_ASSOC);
									} ?>
									    <?php if(!empty($arr_users)) { ?>
										<?php foreach($arr_users as $user) { ?>
										
											<div class="col-md-4 col-6 thumb">
											<a data-fancybox="gallery" href="http://admin.домтут.рф/photo_gallery/<?php echo $info1; ?>/<?php echo $user['pic']; ?>"> 
												<img class="img-fluid" src="http://admin.домтут.рф/photo_gallery/<?php echo $info1; ?>/<?php echo $user['pic']; ?>" class="img-thumbnail">
												Дата загрузки: <?php echo $user['date']; ?>
											</a>
											 </div>
										
										<?php } ?>
										<?php } ?>
									</div>
							  </div>
							  
							      <div id="video" class="container tab-pane fade"><br>
							  <div class="row">
								<?php 
									$sql11 = "SELECT * FROM `video` WHERE `id_zakaz` = '$info1'";
									$result = $link->query($sql11);
									$arr_users = [];
									if ($result->num_rows > 0) {
										$arr_users = $result->fetch_all(MYSQLI_ASSOC);
									} ?>
									    <?php if(!empty($arr_users)) { ?>
										<?php foreach($arr_users as $user) { ?>
										<div class="col-lg-5 col-md-4 col-6 thumb">
											<video class="img-fluid" controls="controls">
													<source src="http://admin.домтут.рф/video_gallery/<?php echo $info1; ?>/<?php echo $user['video']; ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
													Тег video не поддерживается вашим браузером. 
											</video>
										</div>
										<?php } ?>
										<?php } ?>
									</div>
							</div>							  
						   </div>

    </div>
</div>
				<?php } ?>
                <?php } ?>

    </div>
<?php 
include("footer.php");
}
?>

<?php endif;?>