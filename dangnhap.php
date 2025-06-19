<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="swetalerts/jquery-3.7.1.min.js"></script>
    <script src="swetalerts/sweetalert2.all.min.js"></script>
    <title>Đăng nhập</title>
    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Montserrat", serif;
        
    }
    
    body{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(to right, #f8f4f4, #93a6e4);
        color: #333;
        
    }
    .container{
        margin: auto 15px;
        

    }
    .form-box{
        /* margin-top: 50%; */
        width: 100%;
        max-width: 450px;
        padding: 30px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: none;
        /* backdrop-filter: blur(20px); */
    }
    .form-box.active{
        display: block;
        /* backdrop-filter: blur(20px); */
    }
    h2{
        font-size: 34px;
        text-align: center;
        margin-bottom: 20px;

    }
    input, select{
        
        width: 100%;
        padding: 12px;
        background: #eee;
        border-radius: 6px;
        border: none;
        outline: none;
        font-size: 14px;
        color: #333;
        margin-bottom: 20px;
    }
    button{
        width: 100%;
        padding: 12px;
        background: #7494ec;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 15px;
        color: #fff;
        font-weight: 500;
        margin-bottom: 20px;
        transition: 0.5s;
    }
    button:hover{
        background: #0c5ed8;
    }
    p{
        font-family: "Montserrat", serif;
        font-size: 14px;
        text-align: center;
        margin-bottom: 10px;
    }
    p a{
        color: #7494ec;
        text-decoration: none;
    }
    p a:hover{
        text-decoration: underline;
    }
    .error-message{
        padding: 12px;
        background: #f8f4f4;
        border-radius: 6px;
        font-size: 16px;
        color: red;
        text-align: center;
        margin-bottom: 20px;
    }
    </style>
</head>
<body>
<?php
include("../Website_TMK/admincp/config/config.php");
session_start();
if (isset($_POST['dangnhap'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password_user']);
    $select_email = "SELECT * FROM user WHERE email = '$email' AND password_user = '$password'";
    $select_user = mysqli_query($mysqli, $select_email);
    // $count = mysqli_num_rows($row); //dem so dong user
    
    if (mysqli_num_rows($select_user) > 0) {
        $row_data = mysqli_fetch_assoc($select_user);
        if($row_data['role'] == 'User'){
            $_SESSION['User'] = $row_data['username'];
            $_SESSION['id_user'] = $row_data['id_user'];
            header("Location: home_page.php");
        }
        else if($row_data['role'] == 'Admin'){
            $_SESSION['Admin'] = $row_data['username'];
            $_SESSION['id_user'] = $row_data['id_user'];
            header('Location: admincp/index.php');
        }
    }
    else {
        ?>
       <script>
            Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Tên đăng nhập hoặc mật khẩu không đúng. Vui lòng nhập lại!",
            });
        </script>
        <?php
    } 
}
?>
<div class="container">
        <div class="form-box active" id="login-form">
            <form action="" method="POST">
                <h2>Đăng nhập</h2>
                
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password_user" placeholder="Mật khẩu" required>
                <button type="submit" name="dangnhap">Đăng nhập</button>
                <p>Bạn chưa có tài khoản? <a href="pages/main/dangky.php" class="btn_dky">Đăng ký</a></p>
            </form>
        </div>
    </div>
</body>
</html>

