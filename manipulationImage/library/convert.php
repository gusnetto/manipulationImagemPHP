<?php
 
class Convert{
 
private $filename;
private $ratio;
private $width;
private $height;
 
 
public function __construct($filename, $width = null, $height = null){
 
	$info = getimagesize(DIR_IMAGE . $filename);
	$this->setRatio($info[0], $info[1]);
 
	if(!isset($width) && isset($height)){
		$this->width = $height / $this->ratio;
		$this->height = $height;

	}elseif(isset($width) && !isset($height)){
		$this->height = $width / $this->ratio;
		$this->width = $width;
	
	}elseif(!isset($width) && !isset($height)){
		exit('Defina altura/largura.');
	}else{
		$this->width = $width;
		$this->height = $height;
}
 
	$this->filename = $filename;
 
}
 
public function setRatio($width, $height){
	$this->ratio = $width / $height;
}

 
public function resize() {
	if (!file_exists(DIR_IMAGE . $this->filename) || !is_file(DIR_IMAGE . $this->filename)) {
		return;
	}
 
	$info = pathinfo($this->filename);
 
	$extension = $info['extension'];
 
	$old_image = $this->filename;
	$new_image = 'cache/' . substr($this->filename, 0, strrpos($this->filename, '.')) . '-' . $this->width . 'x' . $this->height . '.' . $extension;
 
	if (!file_exists(DIR_IMAGE . $new_image) || (filemtime(DIR_IMAGE . $old_image) > filemtime(DIR_IMAGE . $new_image))) {
		
		$path = '';
 
		$directories = explode('/', dirname(str_replace('../', '', $new_image)));
 
		foreach ($directories as $directory) {
			$path = $path . '/' . $directory;
 
		if (!file_exists(DIR_IMAGE . $path)) {
			@mkdir(DIR_IMAGE . $path, 0777);
		}	
	}
 
	$image = new Image(DIR_IMAGE . $old_image);
	$image->resize($this->width, $this->height);
	$image->save(DIR_IMAGE . $new_image);

}
 
return DIR_IMAGE . $new_image;
}
}
 
?>