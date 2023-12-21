<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body{
            background-image: url('../image/add_project.jpg');
            background-size: 100%;
            background-attachment: fixed;
        }
        form{
            opacity: 0.83;
            margin: 5% 0% 0% 34%;
        }
        input{
            height: 25px;
            border-radius: 15px;
            margin-bottom: 7px;
            border: 1px solid white;
            padding: 0px 7px 0px 10px;
            font-size: 70%;
            width: 330px;
        }
        input:focus{
            outline: none;
        }
        p{
            font-size: 85%;
            margin-bottom: 0px;
        }
        .add{
            margin-left: -26px;
            cursor: pointer;
        }
        #add_project{
            background-color: rgb(84, 227, 84);
            margin-bottom: 150px;
        }
        ul{
            font-size: 65%;
        }
        span{
            color: red;
            font-size: 80%;
            margin: 0px;
            height: 5px;
        }
        select{
            font-size: 90%
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            const form = document.querySelector('#form');
            const start_day = document.querySelector('#start_day');
            const end_day = document.querySelector('#end_day');
            const tb_end_day = document.querySelector('#tb_end_day');
            const ten_du_an = document.querySelector('#ten_du_an');
            const add_project = document.querySelector('#add_project');

            add_project.disabled = true
            document.querySelector('#add').onclick = function(){
                const new_yc = document.querySelector('#new_yc');
                const list_yc = document.querySelector('#list_yc');
                const li = document.createElement('li');
                li.innerHTML = new_yc.value;
                list_yc.append(li);
                new_yc.value = ' ';  
            }

            end_day.onchange = function(){
                const start_date = new Date(start_day.value);
                const end_date = new Date(end_day.value);

                if (end_date <= start_date){
                    tb_end_day.innerHTML = '*ngày kết thúc không thể sớm hơn ngày bắt đầu, vui lòng nhập lại!';
                }
                else{
                    tb_end_day.innerHTML = '';
                }
            }

            ten_du_an.onblur = function(){
                if(ten_du_an.value.length < 1){
                    tb_ten_du_an.innerHTML = '*vui lòng nhập tên dự án';
                }
                else{
                    tb_ten_du_an.innerHTML = '';
                }
            }

            form.onchange = function(){
                if((ten_du_an.value.length > 1) && (end_day.value != '') && (start_day.value != '')){
                    add_project.disabled = false
                }
            }

            //thêm các yêu cầu cho dự án
            function add_order(id_du_an, item_content){
                fetch(`add_order.php?id_du_an=${id_du_an}&noi_dung_yeu_cau=${item_content}`)
            }

            add_project.onsubmit = function(){
                const list_yc = document.querySelector('#list_yc');
                const list_item = list_yc.querySelectorAll('li');
                const id_du_an = document.querySelector('#id_du_an');

                list_item.forEach((item) =>{
                    const item_content = item.textContent;
                    add_order(id_du_an, item_content)
                })
            }

        })
    </script>
</head>
<body>
    <form method="post" class="align-items-center" id='form'>
        <p>Tên dự án:</p>
        <input type="text" placeholder="Nhập tên dự án muốn thêm" id="ten_du_an" name="ten_du_an"><br>
        <span id="tb_ten_du_an"></span>
        <p>Người quản lý:</p>
        <select name="nguoi_quan_ly">
            <?php
                require 'connect.php';
                mysqli_set_charset($connect, 'UTF8');
                $nhan_vien_data = $connect->query("SELECT `ten_dang_nhap`,`ten` FROM `nhan_vien` WHERE chuc_vu_id = 1");
                $id_du_an = ($connect->query('SELECT `id_du_an` FROM `du_an` ORDER BY id_du_an DESC LIMIT 1')->fetch_assoc())['id_du_an'];
                while($quan_ly = $nhan_vien_data->fetch_assoc()){
                    echo "<option value=". $quan_ly['ten_dang_nhap'] .">". $quan_ly['ten'] ."</option>";
                }
            ?>
        </select>
        <p>Ngày bắt đầu:</p>
        <input type="date" id="start_day" name="start_day"><br>
        <p>Ngày kết thúc:</p>
        <input type="date" id="end_day" name="end_day"><br>
        <span id="tb_end_day"></span>
        <p>Các yêu cầu:</p>
        <ul id="list_yc"> 
        </ul>
        <input type="text" id="new_yc" placeholder="Nhập yêu cầu sau đó ấn dấu thêm ở bên phải ->">
        <i class="fa-solid fa-plus add" id="add"></i><br>
        <input type="hidden" value= <?php echo (int)$id_du_an + 1; ?> id= 'id_du_an'>
        <input type="submit" value="Thêm dự án" id="add_project" name="add_project">
    </form>
    <?php
        if(isset($_POST['add_project'])){
            $ten_du_an = $_POST['ten_du_an'];
            $nguoi_quan_ly = $_POST['nguoi_quan_ly'];
            $start_day = $_POST['start_day'];
            $end_day = $_POST['end_day'];
            $id_du_an = $_POST['id_du_an'];
            
            $connect->query("INSERT INTO `du_an`(`ten_du_an`, `nguoi_quan_ly`, `ngay_bat_dau`, `ngay_ket_thuc`) 
                            VALUES ('$ten_du_an','$nguoi_quan_ly','$start_day','$end_day')");
            echo 'Thêm dự án thành công';
        }
    ?>
</body>
</html>