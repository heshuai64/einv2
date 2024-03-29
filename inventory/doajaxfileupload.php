<?php
	session_start();
	if(!empty($_POST['categoryId']) || !empty($_POST['inventoryCode'])){
		$_SESSION['categoryId'] = $_POST['categoryId'];
		$_SESSION['inventoryCode'] = $_POST['inventoryCode'];
		print_r($_SESSION);
		exit;
	}
	
	$conf = parse_ini_file('../config.ini', true);
	//$imagePath = "C:\\xampp\\htdocs\\inventory\\inventoy_images\\";
	//$imagePath = "/export/inventory/inventory_images/";
	$imagePath = $conf['path']['images'];
	$ex = '';
	if(!empty($_FILES['fileToUpload'])){
		$fileElementName = 'fileToUpload';
	}elseif(!empty($_FILES['fileToUpload_1'])){
		$fileElementName = 'fileToUpload_1';
		$ex = '_1';
	}elseif(!empty($_FILES['fileToUpload_2'])){
		$fileElementName = 'fileToUpload_2';
		$ex = '_2';
	}
	$error = "";
	$msg = "";
	
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
	}elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
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
			$extension = explode(".", $_FILES[$fileElementName]['name']);
			$extension = $extension[1];
			//echo $_FILES['fileToUpload']['tmp_name'];
			//if(!file_exists($imagePath.$_GET['categoryId']."\\".$_GET['inventoryCode'])){
			//	mkdir($imagePath.$_GET['categoryId']."\\".$_GET['inventoryCode']);
			//}
			
			$type = substr($_GET['inventoryCode'], 0, 2);
			if(!file_exists($imagePath.$type)){
				mkdir($imagePath.$type, 0777);
			}
			//var_dump($_SESSION);
			//$categoryId = ($_GET['categoryId'] !="")?$_GET['categoryId']:$_SESSION['categoryId'];
			$inventoryCode = ($_GET['inventoryCode'] !="")?$_GET['inventoryCode']:$_SESSION['inventoryCode'];
			$inventoryCode = $inventoryCode.$ex;
			//move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imagePath.$categoryId."\\".$inventoryCode.".".$extension);
			move_uploaded_file($_FILES[$fileElementName]['tmp_name'], $imagePath.$type.DIRECTORY_SEPARATOR.$inventoryCode.".".$extension);
			echo "{success: true,imagePath: '../inventory_images/".$type."/".$inventoryCode.".".$extension."'}";
	}
	/*
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
	*/
?>