<?php
set_time_limit(0); 

define( 'PATH_ROOT', dirname(__FILE__).'/' );

$dwebpCmd = PATH_ROOT . 'libwebp-0.4.3-rc1-windows-x86/bin/dwebp.exe';

if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //
} 
else {
    $dwebpCmd = PATH_ROOT . 'libwebp-0.4.3-rc1-mac-10.92/bin/dwebp';
}

$fileInput = PATH_ROOT . '../newweb/';
$fileOutput = PATH_ROOT . 'output-tiff/';
include 'file_tool.php';

$fileArr = listAllFiles($fileInput);
//echo count($fileArr);
mkdir($fileOutput, 0700);
for($i = 0; $i < count($fileArr); $i++){
	$oneFilePath = $fileArr[$i];
	if(strpos($oneFilePath, '.webp')){
		$oneFileName = getFileInfo($oneFilePath)['basename'];
		$oneFileName = substr($oneFileName, 0, -5);
		$oneFilePathXML = substr($oneFilePath, 0, -5) . '.xml';
		copy($oneFilePathXML, $fileOutput . $oneFileName . '.xml');
		
		$cmd = $dwebpCmd . ' ' .$oneFilePath . ' -tiff -o ' . $fileOutput . $oneFileName . '.tiff';
	//echo $cmd .'  ';

		system($cmd);
	}	
}
?>
