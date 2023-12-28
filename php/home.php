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
    <?php
        session_start();
        require 'connect.php';
        mysqli_set_charset($connect, 'UTF8');
        if(!isset($_SESSION['ten_dang_nhap'])){
            die('<span class="warning">bạn không có quyền truy cập trang này! Nhấp vào <a class="here" href="login.php">đây</a> để quay về trang đăng nhập</span>');
        }
    ?>
    <style>
        body{
            position: relative;
        }
        .projects-progress{
            display: grid;
            grid-auto-flow: row;
            grid-template-columns: 30% 30% 30%;
        }
        /* phần cần gỡ */
        .projects{
            padding-bottom: 30px;
            display: none;
        }
        .my-projects{
            padding-bottom: 30px;
            display: none;
        }
        .status{
            padding: 10px 0px 15px 30px;
        }

        #is_comming, #to_do, #completed{
            font-weight: bold;
            cursor: pointer;
            display: block;
        }
        
        .start-day b{
            font-weight: bold;
            font-size: 130%;
        }

        .project-info{
            width: 95%;
            margin: 20px 0px 0px 30px;
        }
        .project-name{
            background-color: white;
            height: 100px;
            border: 1px solid rgb(214, 207, 207);
            border-radius: 7px;
            padding: 10px 0px 0px 20px;
            cursor: pointer;
        }

        .project-status{
            display: grid;
            border-bottom: 1px solid rgb(226, 223, 223);
            grid-template-columns: 13% 8% 12%;
        }

        .bg-projects{
            background-color: rgb(241, 236, 236);
            border-radius: 5px
        }
        .progress-status{
            margin: 20px 0px 0px 10px;
            display: block;
            color: rgb(143, 143, 143);
            font-size: 90%;
            font-weight: bold;
        }
        .nums_requirement{
            font-weight: 400;
        }
        
        .comming-child, .to-do-child, .completed-child{
            margin-top: 20px;
            margin-bottom: 20px;
            height: 170px;
        }
        .comming-child p, .to-do-child p, .completed-child p {
            word-wrap: break-word; /* Cho phép tự động xuống dòng khi cần thiết */
        }
        .content{
            font-size: 130%;
            height: 657px;
            overflow: auto;
            z-index: 6;
            padding: 0%;
        }
        #project_to_do, #project_completed{
            display: none;
        }

        #is_comming{
            border-bottom: 5px solid grey;
        }

        .add_project{
            color: black;
        }
        .add_project:hover{
            text-decoration: none;
            color: black;
        }

        .project-detail-name{
            padding: 18px;
        }

        .requirement{
            
        }

        .label-requirement{
            position: absolute;
            bottom: 15px;
            left: 25px;
        }





























        /* Phần này của Hải */
        .ten_du_an{
            border-bottom: 1px solid black;
            padding-left: 20px
        }
        .cac_tin_nhan{
            height: 500px;
            padding: 30px 30px 0px 30px;
            display: none;
        }
        .chi-tiet-tin-nhan{
            position: relative;
        }
        .noi-dung-tin-nhan{
            height: 500px;
            overflow:auto;
        }

        .tin-nhan{
            background-color: white;
            height: 100px;
            border: 1px solid rgb(214, 207, 207);
            border-radius: 7px;
            padding: 10px 0px 0px 20px;
            cursor: pointer;
        }

        .nhap-tin-nhan{
            position: fixed;
            bottom: 20px;
            left: 30%;
            width: 67%;
        }
        .nhap-tin-nhan input{
            width: 91%
        }

        .nguoi-khac{
            display: inline-block;
            max-width: 50%;
            border: 1px solid black;
            word-wrap: break-word;
            margin: 15px 0px 0px 50px;
        }
        .ban-than{
            display: inline-block;
            max-width: 50%;
            border: 1px solid black;
            word-wrap: break-word;
            margin: 15px 40px 0px 800px;
            float: right; /* Canh lề phải */
        }
    
        .thong_tin_tn{
            
            display:flex;
        }

        .ten_nguoi_gui{
            position: absolute;
            left: 50px;
            top: -5px;
            font-size: 70%;
            color: rgb(120, 109, 109);

        }
        .tn{
            margin-top:40px
        }


    </style>
    <!-- <script src="../javascript/home_script.js">
    </script> -->
</head>
<body>
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
                        <i class="fa-solid fa-message col-2 logo-function"></i>
                        <p class="col-10 pl-2 name-function" id="discuss">Trao đổi công việc</p>
                    </div>
                    <?php
                        if($_SESSION['chuc_vu_id'] == 3){
                            echo '<div class="row function-item">
                                     <i class="fa-solid fa-briefcase col-2 logo-function"></i>
                                     <a href="add_project.php" class="col-10 pl-2 name-function add_project">Thêm dự án</a>
                                 </div>';
                        }
                    ?>
                </div>
            </div>
            <div class="col-9 content position-relative">
                <div class="projects bg-projects" id='project_content'>
                    <div class="project-status">
                        <div class="status">
                            <b id="is_comming">Is comming</b>
                        </div>
                        <div class="status">
                            <b id="to_do">to do</b>
                        </div>
                        <div class="status">
                            <b id="completed">completed</b>
                        </div>
                    </div>
                    <div class="project-list">
                        <?php
                            $moment = date('Y-m-d');
                            $select_du_an = $connect->query("SELECT *, HOUR(du_an.ngay_khoi_tao) AS hour,MINUTE(du_an.ngay_khoi_tao) AS minute FROM `du_an`");
                            while($du_an = $select_du_an->fetch_assoc()){
                                echo "
                                <div class='project-info' id=";
                                if ($du_an['ngay_bat_dau'] > $moment){
                                    echo 'project_is_comming';
                                }
                                elseif($du_an['ngay_ket_thuc'] >= $moment){
                                    echo 'project_to_do';
                                }
                                else{
                                    echo 'project_completed';
                                }
                                echo ">
                                    <div class='start-day mt-3'>
                                        <b>". $du_an['ngay_bat_dau'] ."</b>
                                    </div>
                                    <div class='project-name' id='project_name'>
                                        <p style='display: none' id='id_du_an'>". $du_an['id_du_an'] ."</p>
                                        <h4>". $du_an['ten_du_an'] ."</h4>
                                        <p>submitted at ". $du_an['hour'] .":". $du_an['minute'] ."</p>
                                    </div>
                                </div>
                                ";
                            }
                        ?>
                    </div>
                </div>
                <div class='project-detail' id='project_detail'>
                    <!-- chỗ để dự án hiển thị -->
                </div>

                <div>
                    <!-- đây là phần để thêm các nội dung mới -->
                </div>


                <!-- phần của hải -->
                <div class="cac_tin_nhan bg-projects" id='cac_tin_nhan'>
                    <?php
                        $nguoi_thuc_hien = $_SESSION['ten_dang_nhap'];
                        $select_thuc_hien = $connect->query("SELECT * FROM `thuc_hien` where nguoi_thuc_hien = '$nguoi_thuc_hien'");
                        if($select_thuc_hien->num_rows > 0){
                            while($row = $select_thuc_hien->fetch_assoc()){
                                $id_du_an = $row['id_du_an'];
                                $du_an = ($connect->query("SELECT * FROM `du_an` WHERE id_du_an = '$id_du_an'"))->fetch_assoc();
                                echo "
                                <div class='thong-tin-du-an'>
                                    <div class='tin-nhan' id='tin_nhan'>
                                        <p style='display: none' id='nguoi_thuc_hien'>". $nguoi_thuc_hien ."</p>
                                        <p style='display: none' id='id_da'>". $du_an['id_du_an'] ."</p>
                                        <h4>". $du_an['ten_du_an'] ."</h4>
                                    </div>
                                </div>
                                ";
                            }
                        }
                    ?>
                </div>
                <div class="chi-tiet-tin-nhan" id='chi_tiet_tin_nhan'>
                    <!-- đây là phần hiện chi tiết tin nhắn -->
                <div>
                <div>
                    <!-- đây là phần để thêm các nội dung mới -->
                </div>
            </div>
        </div>
    </div>





    <script>
        //hiện info
    document.addEventListener('click', function(e){
        const info = document.querySelector('#info');
        const showInfo = document.querySelector('#showInfo');

        if (e.target !== showInfo && !info.contains(e.target)) {
            info.style.display = 'none';
        } 
        if (e.target === showInfo) {
            info.style.display = 'block';
        }
    });
    //hiện ảnh
    document.addEventListener('click', function(e){
        const anh_dai_dien = document.querySelector('#anh_dai_dien');
        const showImage = document.querySelector('#showImage');

        if (e.target !== showImage && !anh_dai_dien.contains(e.target)) {
            anh_dai_dien.style.display = 'none';
        } 
        if (e.target === showImage) {
            anh_dai_dien.style.display = 'block';
        }
    });
    document.addEventListener('click', function(e){
        const projects = document.querySelector('#projects');
        const members = document.querySelector('#members');
        const discuss = document.querySelector('#discuss');
        const project_content = document.querySelector('#project_content');
        if (e.target === projects){
            projects.style.backgroundColor = '#4c9beb';
            project_content.style.display = 'block';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = 'white';
        }
        else if (e.target === members){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = '#4c9beb';
            discuss.style.backgroundColor = 'white';
        }
        else if(e.target === discuss){
            projects.style.backgroundColor = 'white';
            project_content.style.display = 'none';
            members.style.backgroundColor = 'white';
            discuss.style.backgroundColor = '#4c9beb';
        }
    })
    document.addEventListener('click', function(e){
        const is_comming = document.querySelector('#is_comming');
        const to_do = document.querySelector('#to_do');
        const completed = document.querySelector('#completed');
        const project_is_comming = document.querySelectorAll('#project_is_comming');
        const project_to_do = document.querySelectorAll('#project_to_do');
        const project_completed = document.querySelectorAll('#project_completed');

        if (e.target == is_comming) {
            is_comming.style.borderBottom = '5px solid grey';
            to_do.style.borderBottom = 'none';
            completed.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'block';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'none';
            });
        } else if (e.target == to_do) {
            to_do.style.borderBottom = '5px solid grey';
            is_comming.style.borderBottom = 'none';
            completed.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'block';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'none';
            });
        } else if (e.target == completed) {
            completed.style.borderBottom = '5px solid grey';
            to_do.style.borderBottom = 'none';
            is_comming.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'block';
            });
        }
    })
    document.addEventListener('click', function(e) {
        const project_names = document.querySelectorAll('#project_name');
        const project_detail = document.querySelector('#project_detail');
        const project_content = document.querySelector('#project_content');
        const projects = document.querySelector('#projects');
        const members = document.querySelector('#members');
        const my_projects = document.querySelector('#my_projects');
        const discuss = document.querySelector('#discuss');
        function lay_chi_tiet_du_an(id_du_an) {
            fetch(`lay_chi_tiet_du_an.php?id_du_an=${ id_du_an }`).then(response=>response.text()).
            then(response=>project_detail.innerHTML = response)
        }
        
        project_names.forEach(function(project_name) {
            if (project_name.contains(e.target)) {
                const id_du_an = project_name.querySelector('#id_du_an').textContent;
                project_content.style.display = 'none';
                lay_chi_tiet_du_an(id_du_an);
            }
        });
        if ((e.target == projects)||(e.target == members)||(e.target == my_projects)||(e.target == discuss)){
            project_detail.innerHTML = ''
        }
    });






    //hải
    document.addEventListener('click', function(e){
        const discuss = document.querySelector('#discuss');
        const cac_tin_nhan = document.querySelector('#cac_tin_nhan');
        if(e.target == discuss){
            cac_tin_nhan.style.display='block'
        }
    });
    

    document.addEventListener('click', function(e){
        const gui_tin_nhan = document.querySelector('#gui_tin_nhan');
        function gui_di_tin_nhan(id_du_an, ten_dang_nhap,noi_dung) {
            fetch(`gui_di_tin_nhan.php?id_du_an=${id_du_an}&ten_dang_nhap=${ten_dang_nhap}&noi_dung=${noi_dung}`)
        }
        if(e.target == gui_tin_nhan){
            const tin_nhan = document.querySelector('#tin_nhan_gui');
            const noi_dung_tin_nhan = document.querySelector('#noi_dung_tin_nhan')
            const noi_dung =  tin_nhan.value;
            const id_du_an = document.querySelector('#idda').value;
            const ten_dang_nhap = document.querySelector('#tdn').value;
            if(tin_nhan.value.length != 0){
                const p = document.createElement('p')
                p.innerHTML = tin_nhan.value;
                p.className = 'ban-than';
                noi_dung_tin_nhan.append(p);
                gui_di_tin_nhan(id_du_an, ten_dang_nhap, noi_dung)
                tin_nhan.value = '';
            }       
            e.preventDefault();
        }
    })


    document.addEventListener('click', function(e){
        const tin_nhans = document.querySelectorAll('#tin_nhan');
        const chi_tiet_tin_nhan = document.querySelector('#chi_tiet_tin_nhan');
        function lay_chi_tiet_tin_nhan(id_du_an, ten_dang_nhap) {
            fetch(`lay_chi_tiet_tin_nhan.php?id_du_an=${ id_du_an }&ten_dang_nhap=${ ten_dang_nhap }`).then(response=>response.text()).
            then(response=>chi_tiet_tin_nhan.innerHTML = response)
        }
        
        tin_nhans.forEach(function(tin_nhan) {
            if (tin_nhan.contains(e.target)) {
                const cac_tin_nhan = document.querySelector('#cac_tin_nhan');
                const id_du_an = tin_nhan.querySelector('#id_da').textContent;
                const ten_dang_nhap = tin_nhan.querySelector('#nguoi_thuc_hien').textContent;
                cac_tin_nhan.style.display = 'none';
                lay_chi_tiet_tin_nhan(id_du_an, ten_dang_nhap);
            }
        });
        if ((e.target == projects)||(e.target == members)||(e.target == discuss)){
            chi_tiet_tin_nhan.innerHTML = ''
        }
    })
    </script>
</body>
</html>