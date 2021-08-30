						    <div class="card" style="width: 95%;left: 10px; display: inline-block;top: 10px; margin-bottom: 20px;background-color: rgba(0,0,0,.03);">
						      <div class="card-header bg-info text-white"><h4 class="card-title" style="margin-bottom: 0px;">Чат
							  <form action="" id="refreshchat" method="post" name="refreshchat" style="display: inline;"> 
							  <input class="btn btn-light float-right" id="refreshchat" name="refreshchat" type="submit" style="width: 150px;" value="Обновить">
							  </form></h4></div>
							  <div class="card-body text-center" id="chat1" style="overflow:auto; height: 400px;background:white;">
							  <style>
							  .arrow_box {
									position: relative;
									background: #d1ecf1;
									border: 2px solid #c2e1f5;
							}
							.arrow_box:after, .arrow_box:before {
									right: 100%;
	top: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.arrow_box:after {
	border-color: rgba(136, 183, 213, 0);
	border-right-color: #d1ecf1;
	border-width: 10px;
	margin-top: -10px;
}
.arrow_box:before {
	border-color: rgba(194, 225, 245, 0);
	border-right-color: #c2e1f5;
	border-width: 13px;
	margin-top: -13px;
}
							  </style>
							  
<?php
$chatsql = "SELECT * FROM `chat` WHERE `zakaz` = '$info1'";
$chatresult = $link->query($chatsql);
$arr_chat = [];
if ($chatresult->num_rows > 0) {
    $arr_chat = $chatresult->fetch_all(MYSQLI_ASSOC);
}
?>			
                <?php if(!empty($arr_chat)) { ?>
                    <?php foreach($arr_chat as $chat) { ?>
<div class="arrow_box" style="position: relative;padding: .75rem 1.25rem;margin-bottom: 1rem;border: 1px solid transparent;border-radius: .25rem;text-align: left;">
<?php echo $chat['text'];?>
	<hr>
	<p style="font-size: smaller;text-align: left;">От: <?php echo $chat['who'];?><br>В: <?php echo $chat['date'];?></p>
<script type="text/javascript">
  var block = document.getElementById("chat1");
  block.scrollTop = block.scrollHeight;
</script>
  </div>
                    <?php } ?>
                <?php } ?>
               
  
							  </div>
							  <form action="" id="sendchat" method="post" name="sendchat"> 
							  <div class="card-footer" style="background:none;"><label for="comment">Сообщение:</label>

							  <textarea required class="form-control" rows="2" id="text" name="text" maxlength="255"></textarea>
							  
								<div class="progress" id="barbox">
								<div id="bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"aria-valuenow="0" aria-valuemin="0" aria-valuemax="255">
								<span id="count" style="padding-left: 5px;padding-right: 5px;">Счётчик символов</span>
								</div>
								</div>
							  		<script>
									$(document).ready(function()
									{
										$("#text").keyup(function()
											{
												var box=$(this).val();
												var main = box.length *100;
												var value= (main / 255);
												var count= 255 - box.length;
												if(box.length <= 255)
												{
													$('#count').html(count);
													$('#bar').animate(
														{
															"width": value+'%',
														}, 1);
												}
											else
												{
													$('#bar').attr({ class: 'progress-bar progress-bar-danger progress-bar-striped' }); 
												}
											return false;
											});

									});
									</script>
							  <br>	
							  <input class="btn btn-success float-left" id="sendchat" name= "sendchat" type="submit" style="width: 150px;" value="Отправить">
							  </div>

								</form>
								<div class="card-footer" style="border-top: none;background:none;">

							  </div>
						  </div>
							<?php
						   if(isset($_POST["sendchat"]))
						   {
							   $text=htmlspecialchars($_POST['text']);
							   $who=htmlspecialchars($_SESSION['session_fullname']);
							$number=htmlspecialchars($user['number']);
							$chat="INSERT INTO `chat`(`zakaz`,`number`, `who`, `date`, `text`) VALUES ('$info1','$number','$who',NOW(),'$text')";
							$result=mysqli_query($link, $chat);
							if($result)
								{
									echo"
									<script>
										setTimeout(function() { location.replace('/info') }, 1600);
									</script>";
								}
							else 
								{
									echo"
									<div class='blockbackdrop'>
									<div class='alert alert-Danger text-center fixed-bottom shadow-lg p-4 mb-4'>
									<strong>Упс!</strong> Что-то пошло не так...</div></div>";
								}
						   }
						   if(isset($_POST["refreshchat"]))
						   {
					echo"
					<script>
						setTimeout(function() { location.replace('/info') }, 1600);
					</script>";
						   }
							?>