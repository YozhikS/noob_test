<?php

$title = 'Заглушка не успеваю доделать задание';
define('DOCROOT', __DIR__ . '/./');
$uploadResult = '';
$imgDir = 'img/';

function getFiles($path)
{
	clearstatcache();
	$files = scandir(DOCROOT . $path);
	for ($i = 0; $i < count($files); $i++)
	{
		if ( is_dir($path.$files[$i]) )
		{
			unset($files[$i]);
		}
	}
	return $files;
}

if (array_key_exists('uploadFile', $_POST)) { 
    $uploadResult = uploadFile(); 
}

function uploadFile() {
	if(isset($_FILES['file'])) {
      	$check = uploadValid($_FILES['file']);
    
      	if($check === true){
	        uploadMake($_FILES['file']);
	        return "<strong>Файл успешно загружен!</strong>";
      	}
	    else{
	        return "<strong>$check</strong>";  
	    }
    }
}

function uploadValid($file){
	if($file['name'] == '')
		return 'Выберите файл.';

	if($file['size'] > 512000 || $file['size'] == 0)
		return 'Размер файла больше 500кб.';

	$mime = strtolower(end(explode('.', $file['name'])));
	$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
	if(!in_array($mime, $types))
		return 'Не вертый тип файла.';

	return true;
}

function uploadMake($file){	
	$name = mt_rand(0, 10000) . $file['name'];
	copy($file['tmp_name'], 'img/' . $name);
}
?>

<!DOCTYPE HTML>
<html lang="ru">
  <head>
   
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">    
  <title></title>    
  <style type="text/css">
  .small, #full_img{margin:2px; border: solid 1px silver; padding: 5px}
  </style>
   
  </head>
   
  <body>
  	<div>
	    <form method="post" enctype="multipart/form-data">
	      	<input type="file" name="file">
	      	<input type="submit" value="Загрузить файл!" name="uploadFile">
	    </form>
	    <?php
	    echo "$uploadResult";
	    ?>
  	</div>
    <div >
      <?php
        foreach( getFiles($imgDir) as $file )
        {
          echo '<a href="'.$imgDir.$file.'" target="_blank"><img class="small" src="'.$imgDir.$file.'" width="150px" height="150px" /></a>';
        }
      ?>
    </div>      
  </body>
   
</html>