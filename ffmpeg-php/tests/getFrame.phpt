--TEST--
ffmpeg getFrame test
--SKIPIF--
<?php 
extension_loaded('ffmpeg') or die("skip ffmpeg extension not loaded"); 
extension_loaded('gd') or die("skip gd extension not avaliable.");
function_exists("imagecreatetruecolor") or die("skip function imagecreatetruecolor unavailable");
?>
--FILE--
<?php
$frame = 73;
$mov = new ffmpeg_movie(dirname(__FILE__) . '/test_media/test.avi');
$img = sprintf("%s/test-%04d.png", dirname(__FILE__), $frame);

$gd_image = $mov->getFrame($frame, 96, 120);
imagepng($gd_image, $img);
imagedestroy($gd_image);

// generate md5 of file
printf("ffmpeg getFrame(): md5 = %s\n", md5(file_get_contents($img)));
//unlink($img);
?>
--EXPECT--
ffmpeg getFrame(): md5 = 5ac497e1a483220654136103ad7a4688
