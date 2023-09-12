<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);
$name = $_FILES['Filedata']['name']; //file name
$image_size = $_FILES['Filedata']['size']; //file size
$tmp_name = $_FILES['Filedata']['tmp_name']; //file temp
$image_type = $_FILES['Filedata']['type']; //file type

$GLOBAL_DATE = date("Y").date("m");
$destination_folder = "/home/urban114/public_html/bbs2/upload/".$GLOBAL_DATE."/";

$image_resource = imagecreatefromstring(file_get_contents($_FILES['Filedata']['tmp_name']));
$exif = exif_read_data($_FILES['Filedata']['tmp_name']);
$is_rotated = false;
if(!empty($exif['Orientation'])) {
    switch($exif['Orientation']) {
        case 8:
            $image_resource = imagerotate($image_resource,90,0);
            $is_rotated = true;
            break;
        case 3:
            $image_resource = imagerotate($image_resource,180,0);
            break;
        case 6:
            $image_resource = imagerotate($image_resource,-90,0);
            $is_rotated = true;
            break;
    }
}


if($image_resource){
    //Copy and resize part of an image with resampling
    list($img_width, $img_height) = getimagesize($tmp_name);

    if($is_rotated) {
    	$tmp = $img_width;
    	$img_width = $img_height;
    	$img_height = $tmp;
	}

    $new_canvas         = imagecreatetruecolor($img_width , $img_height);
    //$new_canvas = $image_resource;

    if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $img_width, $img_height, $img_width, $img_height)){
        if(!is_dir($destination_folder)){
            mkdir($destination_folder, 0777);
        }

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

