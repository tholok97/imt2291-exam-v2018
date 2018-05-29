<?php

/**
 * Upload image gotten from post
 * Much of the code is taken from my own solution to lab task 
 *  0130 (https://github.com/tholok97/imt2291-web-technology/tree/master/lab0130_2
 */

require_once dirname(__FILE__) . '/DB.php';

/**
 * scales image to new width, new height
 * (From Øyvind Kolloen lab0130)
 */
function scale ($img, $new_width, $new_height) {
    $old_x = imageSX($img);
    $old_y = imageSY($img);

    if($old_x > $old_y) {                     // Image is landscape mode
        $thumb_w = $new_width;
        $thumb_h = $old_y*($new_height/$old_x);
    } else if($old_x < $old_y) {              // Image is portrait mode
        $thumb_w = $old_x*($new_width/$old_y);
        $thumb_h = $new_height;
    } if($old_x == $old_y) {                  // Image is square
    $thumb_w = $new_width;
    $thumb_h = $new_height;
        }

    if ($thumb_w>$old_x) {                    // Don't scale images up
        $thumb_w = $old_x;
        $thumb_h = $old_y;
    }

    $dst_img = ImageCreateTrueColor($thumb_w,$thumb_h);
    imagecopyresampled($dst_img,$img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);

    ob_start();                         // flush/start buffer
    imagepng($dst_img,NULL,9);          // Write image to buffer
    $scaledImage = ob_get_contents();   // Get contents of buffer
    ob_end_clean();                     // Clear buffer
    return $scaledImage;
}


define('THUMBNAIL_WIDTH', 200);
define('THUMBNAIL_HEIGHT', 200);


// fetch info about uploaded file
$fileName = $_FILES['imageFile']['name'];
$fileType = $_FILES['imageFile']['type'];

// make thumbnail by scaling down original image
$fileContent = file_get_contents($_FILES['imageFile']['tmp_name']);
$thumbnail = scale(imagecreatefromstring($fileContent), THUMBNAIL_WIDTH, THUMBNAIL_HEIGHT);
unset($fileContent);    // free up space


// TBA
$id = 923;



// save image to disk
move_uploaded_file($_FILES['imageFile']['tmp_name'], 'images/' . $id);

echo json_encode(array(
    "status" => "ok",
    "message" => null,
));


