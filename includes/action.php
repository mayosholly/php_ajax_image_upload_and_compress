<?php
require_once('../classes/gallery.php');
require_once('../classes/util.php');

$util = new Util();
$gallery = new Gallery();
// handle upload request

if (isset($_POST['image_upload'])) {
    // print_r($_FILES);
    $altText = $util->testInput($_POST['altText']);

    $image_name = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $image_ext = explode('.', $image_name);
    $image_ext = strtolower(end($image_ext));

    $allowed_ext = ['jpg', 'jpeg', 'png'];

    $target_dir = '../uploads/';
    $image_unique_name = uniqid() . '.' . $image_ext;
    $image_path = $target_dir . $image_unique_name;

    if (!file_exists($image_path)) {
        if (in_array($image_ext, $allowed_ext)) {
            if ($image_size <= 1000000) {
                // if (move_uploaded_file($image_tmp, $image_path)) {
                if (compress($image_tmp, $image_path, 70)) {
                    $gallery->setAltText($altText);
                    $gallery->setImagePath($image_unique_name);
                    $gallery->insertData();
                    echo $util->showMessage('primary', 'Image Uploaded Successfully!');
                }
            } else {
                echo $util->showMessage('danger', 'Image size should be less or equal to 1mb!');
            }
        } else {
            echo $util->showMessage('danger', 'Image Type is not supported!');
        }
    } else {
        echo $util->showMessage('danger', 'Image already Exist in the database!');
    }
}


// handle all images
if (isset($_POST['fetch_all_images'])) {
    $images = $gallery->fetchAll();
    $output = '';
    if ($images) {
        foreach ($images as $row) {
            $output .= '<div class="col-sm-6 col-md-4 col-lg-3">
                <a href="#" class="open_image" id="' . $row['id'] . '"
                data-bs-toggle="modal" data-bs-target="#image_preview_modal">
                <img src="uploads/' . $row['image_path'] . '" alt="' . $row['alt_text'] .
                '"class="img-fluid rounded-0 img-thumbnail">
                </a> 
            </div>';
        }
        echo $output;
    } else {
        echo '<div class="col-lg-12">
        <h1 class="text-center p-4">No images found in the database</h1>
        </div>';
    }
}

// edit image
if (isset($_POST['edit_image'])) {
    $id = $_POST['id'];
    $gallery->setId($id);
    $image = $gallery->fetchOne();
    echo json_encode($image);
}

// handle image update request
if (isset($_POST['update_image_upload'])) {
    $image_id = $_POST['edit_image_id'];
    $alt_text = $util->testInput($_POST['altText']);
    $old_image = $_POST['old_image'];

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    $image_ext = explode('.', $image_name);
    $image_ext = strtolower(end($image_ext));

    $target_dir = '../uploads/';
    $image_unique_name = uniqid() . '.' . $image_ext;
    $image_path = $target_dir . $image_unique_name;

    if (isset($image_name) && $image_name != '') {
        $new_image_path = $image_unique_name;
        compress($image_tmp, $image_path, 70);
        if ($old_image != null) {
            unlink($target_dir . $old_image);
        }
    } else {
        $new_image_path = $old_image;
    }

    $gallery->setId($image_id);
    $gallery->setAltText($alt_text);
    $gallery->setImagePath($new_image_path);
    if ($gallery->update()) {
        echo $util->showMessage('primary', 'Image Updated Successfully');
    } else {
        echo $util->showMessage('danger', 'Something Went Wrong');
    }
}


// handle set image
if (isset($_POST['image_id'])) {
    $id = $_POST['image_id'];
    $gallery->setId($id);
    $image = $gallery->fetchOne();
    echo json_encode($image);
}

// handle remove image
if (isset($_POST['remove_image'])) {
    // print_r($_POST);
    $id = $_POST['id'];
    $img_url = '../' . $_POST['img_url'];

    $gallery->setId($id);

    if ($gallery->delete()) {
        unlink($img_url);
        echo $util->showMessage('success', 'Image Deleted');
    } else {
        echo $util->showMessage('danger', 'Something went wrong');
    }
}

// compress image

function compress($source, $destination, $quality)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
    }
    imagejpeg($image, $destination, $quality);
    return $destination;
}
