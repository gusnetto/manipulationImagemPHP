<?php
 
 // conf memory limit 

//APPLICATION_PATH . '/config/app.ini';

// Constante
define('DIR_IMAGE', 'images/');
 
// Import classes
require_once('library/image.php');
require_once('library/convert.php');
 
$args = $_GET;
 
$altura = isset($_GET['width']) ? $_GET['width'] : null;
$largura = isset($_GET['height']) ? $_GET['height'] : null;
 
$imagem = new Convert($_GET['images'], $altura, $largura);
//print_r($imagem);
$img = $imagem->resize();
?>
 
<img src="<?php echo $img;?>" />