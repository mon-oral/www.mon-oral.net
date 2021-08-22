<?php
$file = "/home/www/monoraldotnet/storage/app/public/audio-capsules/sfokasnejd/bgafjajjio05.mp3";	

$file_size = filesize($file);
$file_duration = round((filesize($file) / 8000));
 
echo $file_size . "<br />"; 
echo $file_duration . "<br />"; 

?>
