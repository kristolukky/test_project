<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

function db_connect(){
	$con = mysqli_connect("localhost","phpmyadmin","some_pass","php_test");
	if (!$con)
	  {
		die('Неможливо підключитися до MySQL: ' . mysql_error());
	  }
	
	mysqli_set_charset($con,"utf8");
	return $con;
}


function select_exist_row($id){
	$article = array();
	$con = db_connect();
	$query = 'SELECT * FROM articles WHERE id ="'.$id.'"';
	if($con){
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);
		  
	}
	mysqli_close ($con);
	return $row;
}

function all_articles_select(){
	$articles = array();
	$con = db_connect();
	$query = 'SELECT * FROM articles';
	if($con){
		$result = mysqli_query($con, $query);
		
		while($row = mysqli_fetch_array($result)){
			$article[] = $row;
		}
	}
	mysqli_close ($con);
	
	return $article;
}

function delete_article($id){
	$con = db_connect();
	$query = 'DELETE FROM articles WHERE id ="'.$id.'"';
	mysqli_query($con, $query);
	mysqli_close ($con);
}

function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value, '<br><p><a><b><div><span><em><img><ul><ol><li><table><tr><td>');
    $value = htmlspecialchars($value);
    
    return $value;
}

function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}

function add_update_article($data, $file, $id=''){

if($data)
{
	$title = clean($data['title']);
 	$author = clean($data['author']);
  	$body = clean($data['body']);
	
	if(!empty($title) && !empty($author) && !empty($body)) {
		//$email_validate = filter_var($email, FILTER_VALIDATE_EMAIL); 
		if(check_length($title, 4, 50) && check_length($author, 4, 50) && check_length($body, 4, 2500)) {
			if($file){
				$uploaddir = 'images/';
				$uploadfile = $uploaddir . basename($file['image']['name']);
				$types = array('image/gif', 'image/png', 'image/jpeg');
				$size = 30000;
				if (!in_array($file['image']['type'], $types))
					die('Сайт не підтримує такий тип файлів');
				if ($file['image']['size'] > $size)
					die('Занадто великий розмір файлу');
				if (!move_uploaded_file($file['image']['tmp_name'], $uploadfile)) {
					echo "Помилка завантаження зображення!\n";
				}else{
				
				if($id){
					$query = 'UPDATE articles SET title ="'.$title.'", image = "'.$uploadfile.'", author= "'.$author.'", body= "'.$body.'" 
								WHERE id = "'.$id.'"';
				}else{
					$query = 'INSERT INTO `articles` (`id`,`title`, `image`, `author`, `date`, `body`) VALUES (NULL, "'.$title.'",
					"'.$uploadfile.'", "'.$author.'", CURRENT_TIMESTAMP, "'.$body.'")';
					
				}
				$con = db_connect();
				if($con){
					$result = mysqli_query($con, $query);
				}

				if ($result) {
					if($id){
						echo '<h2>Стаття успішно оновлена.</h2><br><a href="index.php">Повернутися до перегляду</a>';
					}else{
				 		 echo '<h2>Стаття успішно додана в базу даних.</h2><br><a href="index.php">Повернутися до перегляду</a>';
					}
				}

				mysqli_close($con);
			}
			
			}else{
				echo "Завантажте зображення";
			}
			
		} else { 
			echo "Введено не коректні дані";
   		}
	} else {
		echo "Заповніть порожні поля";
	}
	

}
}


if($_POST){
	if(isset($_POST['hiddenField']) && !is_numeric($_POST['hiddenField']) ) {
		die('invalid article id');
	}elseif(!empty($_POST['hiddenField'])){
		add_update_article($_POST, $_FILES, $_POST['hiddenField']);
	}else{
		add_update_article($_POST, $_FILES);
	}
}
?>