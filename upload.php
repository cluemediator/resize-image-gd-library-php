<?php

if(isset($_FILES["image"])) {	
	
	$image = $_FILES['image']['tmp_name']; 
	$imgProperties = getimagesize($image);
	$imageName = $_FILES['image']['name'];
	$pathToImages = "./uploads/";
	$pathToThumbs = "./uploads/thumbs/";
	$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);	
	$img_type = $imgProperties[2];
	
	if( $img_type == IMAGETYPE_JPEG ) {		
		$source = imagecreatefromjpeg($image);		
		$resizeImg = image_resize($source,$imgProperties[0],$imgProperties[1]);
		imagejpeg($resizeImg,$pathToThumbs.$imageName);		
	} 
	elseif ($img_type == IMAGETYPE_PNG ) {
		$source = imagecreatefrompng($image); 
		
		$resizeImg = image_resize($source,$imgProperties[0],$imgProperties[1]);
		imagepng($resizeImg,$pathToThumbs.$imageName);
	} 
	elseif ($img_type == IMAGETYPE_GIF ) {
		$source = imagecreatefromgif($image); 
		$resizeImg = image_resize($source,$imgProperties[0],$imgProperties[1]);
		imagegif($resizeImg,$pathToThumbs.$imageName);
	}	

	move_uploaded_file($image, $pathToImages.$imageName);
	echo "Image resize successfully.";
}

function image_resize($source,$width,$height) {	
	$new_width =150;
	$new_height =150;
	$thumbImg=imagecreatetruecolor($new_width,$new_height);
	imagecopyresampled($thumbImg,$source,0,0,0,0,$new_width,$new_height,$width,$height);
	return $thumbImg;
}

?>
