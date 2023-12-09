<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="header.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="footer.css">
    <style>
        @media screen {
            .signup form input {
                height: 55px;
                width: 50%;
                border: 1px solid #ccc;
                border-radius: 6px;
                margin-bottom: 15px;
                font-size: 1rem;
                padding: 0 14px;
            }
            .signup form {
                width: auto;
                margin-left: 30%;
                margin-top: 3%;
                margin-bottom: 5%;
            }
            .signup .link {
                display: flex;
                flex-direction: column;
            }
            .signup .link input{
                color: black;
                cursor: pointer;
                background-color: blue;
            }
            .signup a {
                text-decoration: none;
                cursor: pointer;
            }
            span {
                color: red;
            }
            p {
                margin-left: 30%;
            }
        }
        @media screen and (max-width:860px) {
            .signup form input {
                height: 55px;
                width: 80%;
                border: 1px solid #ccc;
                border-radius: 6px;
                margin-bottom: 15px;
                font-size: 1rem;
                padding: 0 14px;
            }
            .signup form {
                width: auto;
                margin-left: 30%;
                margin-top: 10%;
            }
            .signup .link {
                display: flex;
                flex-direction: column;
            }
            .signup .link input{
                color: black;
                cursor: pointer;
            }
            .signup a {
                text-decoration: none;
                cursor: pointer;
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded",function()
        {
            document.querySelector('#submit').disabled = true;
            document.querySelectorAll(".check").onkeyup =function()
            {
                document.querySelector('#submit').disabled = false;
            }
            document.querySelector('#account').onkeyup = function () 
            {
                if (document.querySelector('#account').value.length <= 8)
                {
                    document.querySelector('#span').innerHTML = "*tài khoản không đủ dài";
                    document.querySelector('#submit').disabled = true;
                    const br = document.createElement('br');
                    document.querySelector('#span').append(br);
                }
                else
                {
                    document.querySelector('#span').innerHTML = "";
                }
            }
            document.querySelector('#phone').onkeyup = function () 
            {
                if (document.querySelector('#phone').value.length <= 8)
                {
                    document.querySelector('#span').innerHTML = "*Số điện thoại sai";
                    document.querySelector('#submit').disabled = true;
                    const br = document.createElement('br');
                    document.querySelector('#span').append(br);
                }
                else
                {
                    document.querySelector('#span').innerHTML = "";
                }
            }
            document.querySelector('#email').onkeyup = function () 
            {
                if (document.querySelector('#email').value.includes('@')=='')
                {
                    document.querySelector('#span-email').innerHTML = "*email thiếu @";
                    document.querySelector('#submit').disabled = true;
                    const brEmail = document.createElement('br');
                    document.querySelector('#span-email').append(brEmail);
                }
                else
                {
                    document.querySelector('#span-email').innerHTML = "";
                }
            }
            document.querySelector('#passwordreturn').onkeyup = function ()
            {
                if (document.querySelector('#password').value == document.querySelector('#passwordreturn').value)
                {
                    document.querySelector('#span-passowrd').innerHTML = "";
                }
                else
                {
                    document.querySelector('#span-password').innerHTML = "*mật khẩu không khớp";
                    document.querySelector('#submit').disabled = true;
                    const brPassword = document.createElement('br');
                    document.querySelector('#span-password').append(brPassword);
                }
            }
        }
        );
    </script>
</head>
<body>
    <header>
        <div class="all-content-header">
            <div class="icon">
                <h1>question</h1>
            </div>
            <div class="search">
                <label for="search"><i class='bx bx-search'></i></label>
                <input type="text" name="search" id="search" placeholder="Tìm kiếm">
            </div>
            <div class="login">
                <form action="login.html">
                    <input type="submit" value="login">
                </form>
            </div>
            <div class="sign-up">
                <form action="signup.html">
                    <input type="submit" value="sign up">
                </form>
            </div>
        </div>
    </header>
    <div class="signup">
        <form action="" id = "form" method = "GET">
            <h2>Trang đăng kí tài khoản</h2>
            <input name ="name" class = "check" type="text" id = "name" placeholder="Họ và tên">
            <input name ="account" class = "check" id="account" type="text" placeholder="Tài khoản"><br>
            <span id="span"></span>
            <input class = "check" type="password" id = "password" name = "password" placeholder="nhập password"><br>
            <input class = "check" type="password" id = "passwordreturn" name = "password" placeholder="nhập lại password"><br>
            <span id="span-password"></span>
            <input name ="email" class = "check" id = "email" type="text" placeholder="Email"><br>
            <span id="span-email"></span> 
            <input name ="phone" id="phone"type="text" placeholder="Số điện thoại">
            <input name ="cccd" class = "check" id = "cccd"type="text" placeholder="Căn cước công dân">
            <div class="link">
                <input type="submit" value="Sign up" id = "submit">
            </div>
        <div class="buttom">
            return login : <a href="login.php">login</a>
        </div>
        </form>
    </div>
    <?php
        require 'connect.php';
        if (isset($_GET['name']))
            {
                $name = $_GET["name"];
                $account = $_GET["account"];
                $password = $_GET["password"];
                $email = $_GET["email"];
                $phone = $_GET["phone"];
                $cccd = $_GET["cccd"];
                $sql = "INSERT INTO `users`(`name`, `account`, `password`, `email`, `phone`, `cccd`) 
                VALUES ('$name','$account','$password','$email','$phone','$cccd')";
                if($conn -> query($sql) == TRUE)
                {
                    echo "<p>Bạn đã đăng kí thành công</p>";
                }
                else {
                    echo "<p>Bạn đang gặp sự cố với lỗi" . $conn->error. "</p>";
                }
                $conn -> close();
            }
    ?>
    <footer>
        <div class="footer-content">
            <h3>Giao lưu và chia sẻ</h3>
            <ul>
                <li id="title">chức năng</li>
                <li>Đặt câu hỏi</li>
                <li>Tìm người trợ giúp</li>
                <li>Chat</li>
                <li>Trả lời câu hỏi</li>
            </ul>
            <ul>
                <li id="title">Lợi ích của người dùng</li>
                <li>Giúp củng cố kiến thức lập trình</li>
                <li>Giao lưu chia sẻ các kiến thức về lập trình</li>
                <li>Học hỏi nhiều kiến thức về lập trình</li>
                <li>Kết nối mọi người cùng ngành với nhau</li>
            </ul>
        </div>
    </footer>
</body>
</html>