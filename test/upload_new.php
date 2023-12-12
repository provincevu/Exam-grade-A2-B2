<!DOCTYPE html>
<html>
<head>
    <title>Upload ảnh</title>
</head>
<body>
    <form action="upload_new.php" method="post" enctype="multipart/form-data">
        ảnh của bạn
        <input type="file" name="image_upload" id="image_upload">
        <input type="submit" value="Upload" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])){
        $direct = '../image/upload/';
        $mime_file = array('image/png', 'image/jpg', 'image/jpeg');
        // Kiểm tra xem loại file có nằm trong danh sách được phép không
        if(in_array($_FILES["image_upload"]["type"], $mime_file)){
            // Tạo đường dẫn và tên file mới
            $image_upload = $direct . $_FILES["image_upload"]["name"];
            // Di chuyển tệp tải lên vào thư mục chỉ định
            move_uploaded_file($_FILES["image_upload"]["tmp_name"], $image_upload)
        }
    }
    ?>
</body>
</html>
