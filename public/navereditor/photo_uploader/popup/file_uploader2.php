<?

	$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
	//$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);
	$GLOBAL_DATE = date("Y").date("m");
	$destination_folder = "/home/urban114/public_html/bbs2/upload/".$GLOBAL_DATE."/";
	$watermark_png_file = "/home/urban114/public_html/watermark2.png";
	$max_size = 630; //max image size in Pixels

	$name = $_FILES['Filedata']['name']; //file name
	$image_size = $_FILES['Filedata']['size']; //file size
	$tmp_name = $_FILES['Filedata']['tmp_name']; //file temp
	$image_type = $_FILES['Filedata']['type']; //file type

	switch(strtolower($image_type)){ //determine uploaded image type 
		//Create new image from file
		case 'image/png': $image_resource =  imagecreatefrompng($tmp_name);	break;
		case 'image/gif': $image_resource =  imagecreatefromgif($tmp_name);	break;          
		case 'image/jpeg': case 'image/pjpeg':
			$image_resource = imagecreatefromjpeg($tmp_name);	break;
		default:	$image_resource = false;
	}

	if($image_resource){
		//Copy and resize part of an image with resampling
		list($img_width, $img_height) = getimagesize($tmp_name);
		
	    //Construct a proportional size of new image
		$image_scale        = min($max_size / $img_width, $max_size / $img_height); 
		$new_image_width    = ceil($image_scale * $img_width);
		$new_image_height   = ceil($image_scale * $img_height);
		/*
		if ( $img_width < 630 ) {
			$new_image_width    = $img_width;
			$new_image_height   = $img_height;
		}else{
			$new_image_width    = ceil($image_scale * $img_width);
			$new_image_height   = ceil($image_scale * $img_height);
		}
		*/
		$new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);
		//$new_canvas = $image_resource;
		
		if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height)){
			if(!is_dir($destination_folder)){ 
				mkdir($destination_folder, 0777);
			}
				
			//center watermark
			$watermark_left = $new_image_width-250; //watermark left
			$watermark_bottom = $new_image_height-70; //watermark bottom

			$watermark = imagecreatefrompng($watermark_png_file); //watermark image
			imagecopy($new_canvas, $watermark, $watermark_left, $watermark_bottom, 0, 0, 240, 60); //merge image
			
			$_new_name	= md5(microtime());	
			//Or Save image to the folder		
			if ( strtolower($image_type) == 'image/png' ){
				imagepng($new_canvas, $destination_folder.'/'.$_new_name , 9);
			}else if ( strtolower($image_type) == 'image/gif' ){
				imagegif($new_canvas, $destination_folder.'/'.$_new_name );
			}else if ( strtolower($image_type) == 'image/jpeg' || strtolower($image_type) == 'image/pjpeg' ){
				imagejpeg($new_canvas, $destination_folder.'/'.$_new_name , 100);
			}else{
				$image_resource = false;
			}
				
			//free up memory
			imagedestroy($new_canvas); 
			imagedestroy($image_resource);		

			$newPath = $destination_folder.$_new_name;
			move_uploaded_file($new_canvas, $newPath);
			
			$url .= "&bNewLine=true";
			$url .= "&sFileName=".$_new_name;
			$url .= "&sFileURL=http://www.urban114.com/bbs2/upload/".$GLOBAL_DATE."/".$_new_name;
		}
			
	}else{
		$url .= '&errstr=error';
	}
	
header('Location: '. $url);
?>

