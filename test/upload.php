<?php
    $target_dir = "../image/upload/"; // Thư mục bạn muốn lưu ảnh
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    // Kiểm tra nếu $uploadOk bằng 0 tức là có lỗi xảy ra
    if ($uploadOk == 0) {
        echo "Xin lỗi, file của bạn không được upload.";
    // Nếu không có lỗi, tiến hành upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "upload thành công.";
        } else {
            echo "Xảy ra lỗi khi upload file.";
        }
    }
?>