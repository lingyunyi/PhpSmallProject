<?php setcookie("user", "true", time()+360);?>
<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>欢迎登入</title>
    <link rel="stylesheet" href="../static/Public/css/all_login.css">
    <script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
    <style>

    </style>
</head>
<body>

<div class="lowin">
    <div class="lowin-brand">
        <img src="../static/Public/img/login.jpg" alt="logo">
    </div>
    <div class="lowin-wrapper">
        <!--        登入模块-->
        <div class="lowin-box lowin-login">
            <div class="lowin-box-inner">
                <form method="post" id="login_form">
                    <!--                    登入表单开始-->
                    <p>登入账号</p>
                    <div class="lowin-group">
                        <label>账号<a href="#" class="login-back-link">重新登入</a></label>
                        <input type="text" id="login_account" class="lowin-input">
                    </div>
                    <div class="lowin-group password-group">
                        <label>密码<a href="#" class="forgot-link">忘记密码</a></label>
                        <input type="password" id="login_password" class="lowin-input">
                    </div>
                    <button class="lowin-btn login-btn" onclick="return Ajax_login();">
                        登入
                    </button>
                    <div class="text-foot">
                        <a href="" class="register-link">注册</a>
                    </div>
                    <!--                    登入表单结束-->
                </form>
            </div>
        </div>
        <!--        登入模块结束-->
        <!--        注册模块开始-->
        <div class="lowin-box lowin-register">
            <div class="lowin-box-inner">
                <section method="post" id="register_form">
                    <!--                    注册表单开始-->
                    <p>注册账号</p>
                    <div class="lowin-group">
                        <label>账户ID</label>
                        <input type="text" id="register_account" class="lowin-input">
                    </div>
                    <div class="lowin-group">
                        <label>密码</label>
                        <input type="password" id="register_password" class="lowin-input">
                    </div>
                    <!-- Cmd返回一个True 或者 False 如果返回False 那么就会出现 取消后续的默认事件 -->
                    <button class="lowin-btn" onclick="return Ajax_register();">
                        注册
                    </button>

                    <div class="text-foot">
                        <a href="" class="login-link">登入</a>
                    </div>
                    <!--                    注册表单结束-->
                </section>
            </div>
        </div>
        <!--        注册模块结束-->
    </div>
    <!--    页脚模块开始-->
    <footer class="lowin-footer">
        @www.lingyunyi.com
    </footer>
    <!--    页脚模块结束-->
</div>
<!--引用js模块-->
<script src="../static/Public/js/all_login.js"></script>
<!--自定义js脚本-->
<script>
    //    调用类中的init函数
    Auth.init({
        login_url: '',
        forgot_url: '#'
    });
</script>
<script>

    function Ajax_login() {
        if($("#login_account").val() == "" || $("#login_password").val() == "" ){
            alert("不能输入空字符串。。。")
            return false;
        }
        $.ajax({
            url: '/add_one_img/api_php/login_register.php',
            type: "POST",
            // 设置超时的时间XXs
            timeout: 30000,
            data: {
                "type":"login",
                'username':$("#login_account").val(),
                'userpasswd':$("#login_password").val(),
            },
            success: function (recv) {
                //当服务端处理完成后，返回数据时，该函数自动调用
                // data代表服务器给我们返回的值
                // 可以使用 JavaScript进行html的内容修改展示内容，或者刷新界面
                console.log(recv)
                // 登入成功
                recv = JSON.parse(recv)
                if (recv["status"] == "true") {
                    alert("登入成功。")
                    <?php $_SESSION['type']="islogin";?>
                    location.href = "/add_one_img/templates/add_one_img.php?username="+ recv["username"]
                }
                ;
                if (recv["status"] == "false") {
                    alert("登入失败，请重新登入。")
                    location.reload();
                }
                ;
            }})
        return false;
    }


    function Ajax_register() {
        if($("#register_account").val() == "" || $("#register_password").val() == "" ){
            alert("不能输入空字符串。。。")
            return false;
        }
        $.ajax({
            url: '/add_one_img/api_php/login_register.php',
            type: "POST",
            // 设置超时的时间XXs
            timeout: 30000,
            data: {
                "type":"register",
                'username':$("#register_account").val(),
                'userpasswd':$("#register_password").val(),
            },
            success: function (recv) {
                //当服务端处理完成后，返回数据时，该函数自动调用
                // data代表服务器给我们返回的值
                // 可以使用 JavaScript进行html的内容修改展示内容，或者刷新界面
                console.log(recv)
                // 登入成功
                recv = JSON.parse(recv)
                if (recv["status"] == "true") {
                    alert("注册成功，请登入。")
                    location.reload();
                }
                ;
                if (recv["status"] == "false") {
                    alert("注册失败请重试，请登入。")
                    location.reload();
                }
                ;
            }})
        return false;
    }




</script>
</body>
</html>