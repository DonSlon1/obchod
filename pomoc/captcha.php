<?php
session_start();

$captchaText = generateRandomText(6);

$_SESSION['captcha_text'] = $captchaText;

$image = imagecreatetruecolor(200, 80);
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
$textColor = imagecolorallocate($image, 0, 0, 0);


imagefill($image, 0, 0, $backgroundColor);

for ($i = 0; $i < 20; $i++) {
    $x1 = rand(0, 200);
    $y1 = rand(0, 80);
    $x2 = rand(0, 200);
    $y2 = rand(0, 80);
    $color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetthickness($image, 3); // Set line thickness to 3 pixels
    imageline($image, $x1, $y1, $x2, $y2, $color);
}

$textX = 20;
$textY = 40;
$font = '../fonts/captcha.ttf';
$fontSize = 30;
$rotationAngleRange = 10;

for ($i = 0; $i < strlen($captchaText); $i++) {
    $character = $captchaText[$i];

    $characterFontSize = $fontSize + rand(-5, 5);
    $characterRotationAngle = rand(-$rotationAngleRange, $rotationAngleRange);

    $characterColor = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));

    $characterX = $textX + ($i * 30) + rand(-5, 5);

    $characterY = $textY + rand(-10, 10);

    $shearAmount = rand(-10, 10) / 10;
    $characterBox = imagettfbbox($characterFontSize, $characterRotationAngle, $font, $character);
    $characterWidth = $characterBox[2] - $characterBox[0];
    $characterHeight = $characterBox[1] - $characterBox[7];
    imagettftext($image, $characterFontSize, $characterRotationAngle, $characterX, $characterY, $characterColor, $font, $character);
}

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

function generateRandomText($length): string
{
    $characters = '23456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
    $text = '';
    for ($i = 0; $i < $length; $i++) {
        $text .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $text;
}

