<?php
	session_start();
	if(!empty($_POST['categoryId']) || !empty($_POST['inventoryCode'])){
		$_SESSION['categoryId'] = $_POST['categoryId'];
		$_SESSION['inventoryCode'] = $_POST['inventoryCode'];
		print_r($_SESSION);
		exit;
	}
	$imagePath = "C:\\xampp\\htdocs\\tracmor\\inventoy_images\\";
	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			//$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
			//$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			//$msg .= " sku: ".$_GET['inventoryCode'];
			//$msg .= " category: ".$_GET['categoryId'];
			//for security reason, we force to remove all uploaded file
			//@unlink($_FILES['fileToUpload']);
			$extension = explode(".", $_FILES['fileToUpload']['name']);
			$extension = $extension[1];
			//echo $_FILES['fileToUpload']['tmp_name'];
			//if(!file_exists($imagePath.$_GET['categoryId']."\\".$_GET['inventoryCode'])){
			//	mkdir($imagePath.$_GET['categoryId']."\\".$_GET['inventoryCode']);
			//}
			//var_dump($_SESSION);
			$categoryId = ($_GET['categoryId'] !="")?$_GET['categoryId']:$_SESSION['categoryId'];
			$inventoryCode = ($_GET['inventoryCode'] !="")?$_GET['inventoryCode']:$_SESSION['inventoryCode'];
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imagePath.$categoryId."\\".$inventoryCode.".".$extension);
			echo "{success: true,imagePath: '../inventoy_images/".$categoryId."/".$inventoryCode.".".$extension."'}";
	}
	/*
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
	*/
?>