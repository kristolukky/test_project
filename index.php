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

$articles = all_articles_select();

?>
	
	<div class="container">
		<h1>Статті</h1>
		 <?php
		foreach($articles as $key=>$article){?>
			<div class="row">
				<h2> <?php echo $article['title']; ?></h2>
				<span><?php echo $article['author']; ?></span>
				<span><?php echo $article['date']; ?></span>
				<div class="col-md-3">
					<img src="<?php echo $article['image']; ?>" />
				</div>
				<div class="col-md-9">
					 <?php echo $article['body']; ?>
				</div>
			</div>
		<?php }?>
			
		<a class="btn-primary" href="article.php">Додати статтю</a>
		<a class="btn-primary" href="edit_list.php">Змінити котрусь з них, а може й взагалі видалити</a>
	</div>
		<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
		 <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
			
	 </body>
</html>