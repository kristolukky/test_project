<!DOCTYPE html>
<html>
<head>
 <title>Статті</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css" rel="stylesheet">
</head>
          
<body>
	
<?php
require 'function.php'; 
if(!empty($_REQUEST['delete'])){
	delete_article($_REQUEST['delete']);
}
$articles = all_articles_select();

?>
	
	<div class="container">
		<div class="table-responsive">
		<h1>Статті</h1>
		
		  <table class="table">
			<tr>
				<th>Назва статті</th>
				<th>Зображення</th>
				<th>Автор</th>
				<th>Дата</th>
				<th>Текст</th>
				<th>Дії</th>
			</tr>
			  <?php
			  foreach($articles as $key=>$article){?>
			<tr>
			  <td>
				 <?php echo $article['title']; ?>
				</td>
			 	 <td>
					<img src="<?php echo $article['image']; ?>" width="50px" height="50px" />
				 </td>
			  <td>
					 <?php echo $article['author']; ?>
				</td>
			  <td>
				 <?php echo $article['date']; ?>
				</td>
			  <td>
				 <?php echo $article['body']; ?>
				</td>
			  <td>
				<a href="article.php?id=<?php echo $article['id']; ?>">Змінити статтю</a>
				<a href="edit_list.php?delete=<?php echo $article['id']; ?>">Видалити статтю</a>
				</td>
			</tr>
			<?php }?>
			
		  </table>
		 
		<a class="btn-primary" href="article.php">Додати статтю</a>
		<a class="btn-primary" href="index.php">Повернутися до перегляду</a>
		</div>
	</div>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>	
			
	 </body>
</html>