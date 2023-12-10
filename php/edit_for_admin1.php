<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a{
            display: block;
            text-decoration: none;
            color: black;
        }
        table{
            border-collapse: collapse;
            margin-left: 24%;
        }
        tr:hover{
            background-color: orange;
        }
        th{
            height: 40px;
        }
        td{
            width: 200px;
            height: 30px;
        }
        .bg-lb{
            background-color: lightblue
        }
        .bg-yellow{
            background-color: lightyellow
        }
        caption{
            font-weight: bold;
            font-size: 130%
        }
    </style>
</head>
<body>
    <h1>THÔNG TIN CÁC ĐỒ UỐNG</h1>
    <table border="1px">
        <caption>DANH SÁCH CÁC ĐỒ UỐNG</caption>
        <tr style='background-color: blue; color:white'>
            <th>Tên đồ uống</th>
            <th>Loại đồ uống</th>
            <th>giá</th>
            <th>mô tả</th>
        </tr>
        <?php
            require 'connect.php';
            mysqli_set_charset($conn, 'UTF8');
            $sql = 'SELECT * FROM `do_uong`';
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                $col = 0;
                while($row = $result->fetch_assoc()){
                    $col++;
                    echo '<tr class=';
                    if ($col%2 == 0){
                        echo 'bg-lb';
                    }
                    else{
                        echo 'bg-yellow';
                    }
                    echo '>';
                    echo '<td><a href="sua_do_uong2.php?do_uong_id='. $row['do_uong_id'] .'">'. $row['ten_do_uong'] .'</a></td>';
                    echo '<td><a href="sua_do_uong2.php?do_uong_id='. $row['do_uong_id'] .'">'. $row['loai_do_uong'] .'</a></td>';
                    echo '<td><a href="sua_do_uong2.php?do_uong_id='. $row['do_uong_id'] .'">'. $row['gia_tien'] .'</a></td>';
                    echo '<td><a href="sua_do_uong2.php?do_uong_id='. $row['do_uong_id'] .'">'. $row['mo_ta'] .'</a></td>';
                    echo '</tr>';
                }
            }
        ?>
    </table>
</body>
</html>