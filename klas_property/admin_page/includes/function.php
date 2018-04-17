<?php
function resizeImage($SrcImage, $DestImage, $MaxWidth, $MaxHeight, $Quality)
{
	list($iWidth, $iHeight, $type)= getimagesize($SrcImage);
	$ImageScale = min($MaxWidth/$iWidth,$MaxHeight/$iHeight);
	$NewWidth = ceil($ImageScale*$iWidth);
	$NewHeight = ceil($ImageScale*$iHeight);
	$NewCanves = imagecreatetruecolor($NewWidth,$NewHeight);
	
	switch(strtolower(image_type_to_mime_type($type)))
	{
		case 'image/jpeg':
			$NewImage= imagecreatefromjpeg($SrcImage);
			break;
		case 'image/png':
			$NewImage= imagecreatefrompng($SrcImage);
			break;
		case 'image/gif':
			$NewImage= imagecreatefromgif($SrcImage);
			break;
		default : return false;
	}

	//resize image
	if(imagecopyresampled($NewCanves, $NewImage,0,0,0,0, $NewWidth, $NewHeight, $iWidth, $iHeight))
	{
		//copy file
		if(imagejpeg($NewCanves, $DestImage, $Quality))
		{
			imagedestroy($NewCanves);
		}
	}
}