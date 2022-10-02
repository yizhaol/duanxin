<?php
header("Content-type:image/png");
$res = imagecreatetruecolor(70,30);
$red = imagecolorallocate($res,255,0,0);
$red = imagecolorallocate($res,0,0,255);
imagefill($res,0,0,$red);
for($i=0;$i<50;$i++){
imageline($res,0,0,mt_rand(0,50),mt_rand(0,50),$blue);
}
imagepng($res);
