<?php
$img_dest = imagecreatefrompng('molde.png');
$img_src_or = imagecreatefromjpeg('flor.jpg');

/* Transformamos el PNG para que sea más pequeño */
if(imagesx($img_src_or)<500){
    $width = 500;
    $height = (imagesy($img_src_or)*500)/imagesx($img_src_or);
}elseif(imagesy($img_src_or)<500){
    $height = 500;
    $width = (imagesx($img_src_or)*500)/imagesy($img_src_or);
}

$img_src_resize = imagecreatetruecolor( $width, $height );

imagealphablending( $img_src_resize, false );
imagesavealpha( $img_src_resize, true );
imagecopyresampled( $img_src_resize, $img_src_or, //dst_image, src_image
                    0, 0, //Coordenada x del punto de destino, Coordenada y del punto de destino
                    0, 0, //Coordenada x del punto de origen, Coordenada y del punto de origen
                    $width, $height, //Ancho del destino, Alto del destino
                    imagesx($img_src_or), imagesy($img_src_or) ); //Ancho original, Alto original
/**/
imagealphablending($img_dest, false);
imagesavealpha($img_dest, true);

imagecopymerge($img_dest, $img_src_resize, //dst_image, src_image
                    0, 0, //Coordenada x del punto de destino, Coordenada y del punto de destino
                    0, 0, //Coordenada x del punto de origen, Coordenada y del punto de origen
                    $width, $height, //Ancho del original, Alto del original
                    100); //opacity

header('Content-Type: image/png');
imagepng($img_dest);

imagedestroy($img_src_or);
imagedestroy($img_dest);
?>
