<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="get" class="col-4">
        <div class="row justify-content-center">
            <div class="col-9 bg-header mt-3 position-relative">
                <i class="fas fa-search icon-search"></i>
                <input type="text" class="search-form" list="suggestion" placeholder="tìm kiếm nhanh công việc">
                <datalist id="suggestion">
                    <?php
                        require 'connect.php';
                        $sql = $connect->query('SELECT * FROM `du_an`');
                        while($data = $sql->fetch_assoc()){
                            echo "<option value='". $data['ten_du_an'] ."'>";
                        }
                    ?>
                </datalist>
            </div>
            <div class="col-3 bg-header mt-3 pl-1"><input type="submit" value="Search" class="search-button"></div>
        </div>
    </form>
</body>
</html>