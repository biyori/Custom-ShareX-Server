<?php
header('Expires: Thu, 01-Jan-70 00:00:01 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Content-Type: text/plain');
header('Pragma: no-cache');

$api_key = 'generate a key, any key! Just make sure it matches ShareX settings';
$target_dir = "/home/web/site/images";

if (isset($_POST['key'], $_FILES['share_file'])) {
	if ($_POST['key'] === $api_key) {
        save($_FILES['share_file']['tmp_name'], $target_dir . basename($_FILES["share_file"]["name"]));
	}
}
else
if (isset($_GET['key'], $_GET['file'])) {
	if ($_GET['key'] === $api_key) {
		delete($target_dir . $_GET['file']);
	}
}
else {
    header('Content-Type: text/html');
	include ("404.html");
	return 0;
}

function save($file, $destination)
{
	if (move_uploaded_file($file, $destination)) {
		header("Uploaded-File: " . rawurlencode(basename($destination)));
		echo "The file " . basename($destination) . " has been uploaded.";
	}
	else {
		echo "Error uploading " . basename($destination) . ".";
	}
}

function delete($file)
{
	if (unlink($file)) {
		echo "The file " . basename($file) . " has been erased.\r\n";
	}
	else {
		echo "Error deleting " . basename($file) . ".\r\n";
	}

	print_r(error_get_last());
}
