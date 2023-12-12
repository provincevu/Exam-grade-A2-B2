<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        body{
            position: relative;
        }
        .projects{
            margin-top : 5%;
            display: grid;
            grid-template-columns: 30% 30% 30%;
        }
        .is_comming{
            height: 700px
        }
        .bg-projects{
            background-color: rgb(241, 236, 236);
            border-radius: 5px
        }
        .project-status{
            margin: 20px 0px 0px 10px;
            display: block;
            color: rgb(143, 143, 143);
            font-size: 90%;
            font-weight: bold;
        }
        .nums_project{
            font-weight: 400;
        }
        
        .comming-child{
            height: 170px
        }
    </style>
    <script src="../javascript/home_script.js"></script>
</head>
<body>
    <?php
        session_start();
        require 'connect.php';
        mysqli_set_charset($connect, 'UTF8');
        if(!isset($_SESSION['ten_dang_nhap'])){
            die('<span class="warning">bạn không có quyền truy cập trang này! Nhấp vào <a class="here" href="login.php">đây</a> để quay về trang đăng nhập</span>');
        }
    ?>
    <header class="container-fluid header" id="container-fluid">
        <div class="row justify-content-between bg-header">
            <div class="col-7 row test align-content-center justify-content-center">
                <div class="logo-website col-1 bg-light pl-0 pr-0">
                    <img src="..\image\logo.png" alt="logo web" class="w-100 bg-header">
                </div>
                <div class="name-website col-10">
                    <b class="color-white pj">Project</b><span class="font-timeNewRoman mt color-white">Master</span>
                </div>
            </div>
            <form method="get" class="col-4">
                <div class="row justify-content-center">
                    <div class="col-9 bg-header mt-3 position-relative">
                        <i class="fas fa-search icon-search"></i>
                        <input type="text" class="search-form" placeholder="tìm kiếm nhanh công việc">
                    </div>
                    <div class="col-3 bg-header mt-3 pl-1"><input type="submit" value="Search" class="search-button"></div>
                </div>
            </form>
            <div class="col-1 position-relative test">
                <div class="profile w-75">
                    <img src = <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?> alt="Avatar" class="avatar w-100" id="showInfo">
                </div>
                <!-- hiển thị thông tin của người dùng -->
                <div class="info color-white" id="info">
                    <div class="row ml-2 idx-top">
                        <div class="col-3 row profile">
                            <img src= <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?> alt="Avatar" class="w-100" id="showImage">
                        </div>
                        <div class="col-8 mt-3 name-user">
                            <?php echo $_SESSION['ten']; ?>
                        </div>
                    </div>
                    <div class="row ml-2 mt-3 name-user">
                        Email: <?php echo $_SESSION['email']; ?>
                    </div>
                    <div class="row ml-2 mt-3 name-user">
                        Chức vụ: 
                        <?php
                            $chuc_vu_id = $_SESSION['chuc_vu_id'];
                            $chuc_vu = ($connect->query("SELECT * FROM `chuc_vu` WHERE chuc_vu_id = '$chuc_vu_id'"))->fetch_assoc();
                            echo $chuc_vu['ten_chuc_vu']; 
                        ?>
                    </div>
                    <div class="row ml-2 mt-3 name-user">
                        Địa chỉ: <?php echo $_SESSION['dia_chi']; ?>
                    </div>
                    <div class="row border-bottom"></div>
                    <a href='edit_profile.php'>
                        <div class="font-120 row" id='edit-profile'>
                            <div class="col-2"><i class="fa-solid fa-gear mt-2 ml-3"></i></div>
                            <p>Chỉnh sửa thông tin</p>
                        </div>
                    </a>
                    <a href="logout.php">
                        <div class="font-120 row" id='logout'>
                            <div class="col-2"><i class="fa-solid fa-right-from-bracket mt-2 ml-3"></i></div>
                            <p>đăng xuất</p>
                        </div>
                    </a>
                </div>
                <div class='anh_dai_dien' id='anh_dai_dien'>
                    <img src= <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?>>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid sec" id="container-fluid">
        <div class="row">
            <div class="col-3 functions">
                <div class="user-info row">
                    <div class="col-3 avatar-sm oi">
                        <img src= <?php echo '../image/upload/' . $_SESSION['anh_dai_dien']?> alt="Avatar" class="w-100 avatar2 mt-1 mb-1">
                    </div>
                    <div class="information">
                        <div class="information">
                            <p class="name-user">
                                <?php
                                    echo $_SESSION['ten'];
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="list-functions">
                    <b class="title-function">chức năng</b>
                    <div class="row function-item">
                        <i class="fa-solid fa-house col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="projects">Các dự án</p>
                    </div>
                    <div class="row function-item">
                        <i class="fa-solid fa-user-group col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="members">Thành viên</p>
                    </div>
                    <div class="row function-item">
                        <i class="fa-solid fa-folder col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="my_projects">Dự án của tôi</p>
                    </div>
                    <div class="row function-item">
                        <i class="fa-solid fa-message col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="discuss">Trao đổi công việc</p>
                    </div>
                </div>
            </div>
            <div class="col-9 content position-relative">
                <div class="projects justify-content-around">
                    <div class='is_comming bg-projects'>
                        <b class="project-status row">IS COMMING <span class='nums_project'>3</span></b>
                        <div class='bg-light col-11 ml-3 comming-child'>
                            <p>quản lý dự án 1</p>
                        </div>
                    </div>
                    <div class='to_do bg-projects'>
                        <b class="project-status">TO DO <span class='nums_project'>3</span></b>
                    </div>
                    <div class='completed bg-projects'>
                        <b class="project-status">COMPLETED <span class='nums_project'>3</span></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>