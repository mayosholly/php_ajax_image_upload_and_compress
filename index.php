<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/datatables.min.css" rel="stylesheet">
    <script src="assets/bootstrap.bundle.min.js"></script>
    <script src="assets/jquery.js"></script>
</head>

<body class="bg-light">

    <!-- image upload modal -->

    <div class="modal fade" id="upload_image_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="message_alert"></div>
                    <div class="progress mb-3" style="height: 25; display: none;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemax="100" aria-valuemin="0"></div>
                    </div>

                    <form action="#" method="post" enctype="multipart/form-data" id="image_upload_form">
                        <div class="mb-3">
                            <input type="text" name="altText" id="alt_text" class="form-control" placeholder="Image Alternate Text" required />
                        </div>
                        <div class="mb-3">
                            <input type="file" name="image" id="image_upload" class="form-control">
                        </div>

                        <div class="mb-3" id="preview_image"></div>

                        <div class="mb-3 d-grid">
                            <input type="submit" value="upload" class="btn btn-primary" id="upload_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- end  -->

    <!-- change image modal -->
    <div class="modal fade" id="edit_image_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change New Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="edit_message_alert"></div>
                    <div class="progress mb-3" style="height: 25; display: none;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemax="100" aria-valuemin="0"></div>
                    </div>

                    <form action="#" method="post" enctype="multipart/form-data" id="image_edit_form">
                        <input type="hidden" name="edit_image_id" id="edit_image_id">
                        <input type="hidden" name="old_image" id="old_image">
                        <div class="mb-3">
                            <input type="text" name="altText" id="edit_alt_text" class="form-control" placeholder="Image Alternate Text" required />
                        </div>
                        <div class="mb-3">
                            <input type="file" name="image" id="edit_image_upload" class="form-control">
                        </div>

                        <div class="mb-3" id="edit_preview_image"></div>

                        <div class="mb-3 d-grid">
                            <input type="submit" value="Update" class="btn btn-success" id="change_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- end change modal -->

    <!-- images upload modal -->

    <div class="modal fade" id="image_preview_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="image_alt_text"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" id="set_image">

                    <div class="mt-2 float-end">
                        <a href="#" class="text-primary me-2 change_image" title="Change Image" data-bs-toggle="modal" data-bs-target="#edit_image_modal">
                            <i class="fas fa-edit fa-lg"></i>
                        </a>
                        <a href="#" class="text-danger me-2 remove_image" title="Remove Image">
                            <i class="fas fa-trash fa-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- image upload modal end -->

    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <h4>Image Gallery</h4>
                <button class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#upload_image_modal">
                    <i class="fas fa-image me-2"></i> Upload New Image
                </button>
            </div>
        </div>
        <hr />
        <div id="delete_image_alert"></div>
        <div class="row g-4" id="show_all_images">
            <h1 class="text-center text-secondary p-5">Loading Please Wait..</h1>
        </div>
    </div>
    <script src="js/main.js"> </script>
</body>

</html>