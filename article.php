<?php
require('function.php');
if(!empty($_REQUEST['id'])){
	$article = select_exist_row($_REQUEST['id']);
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>Статті</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css" rel="stylesheet">
</head>
          
<body>
	<div class="container">
		<div class="table-responsive">
		<h1>Статті</h1>
		<form name="article" method="post" enctype="multipart/form-data" action="function.php">
		  <table class="table">
			<tr>
			  <td width="50%">Назва статті</td>
			  <td><input name="title" type="text" id="title" value="<?php echo $article['title']; ?>" /></td>
			</tr>
			<tr>
			  <td>Зображення</td>
			  <td>
				  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
				  <input name="image" type="file" id="image" value="<?php echo $article['image']; ?>" />
				</td>
			</tr>
			<tr>
			  <td>Автор</td>
			  <td><input name="author" type="text" id="author" value="<?php echo $article['author']; ?>" /></td>
			</tr>
			<tr>
			  <td>Текст</td>
			  <td><textarea name="body" id="body"><?php echo $article['body']; ?></textarea></td>
			</tr>
			<tr>
				<td></td>
			  <td>
				  <input name="hiddenField" type="hidden" value="<?php echo $_REQUEST['id'];?>">
				  <input name="add" type="submit" id="add" value="Зберегти">
				</td>
			</tr>
		  </table>
		  </form> 
			
		</div>
		<a href="edit_list.php">Перейти до списку редагування</a>
		<a href="index.php">Повернутися до перегляду</a>
	</div>
		 <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>	  
			
	 </body>
</html>