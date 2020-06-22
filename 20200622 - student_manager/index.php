<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <script src="http://libs.baidu.com/jquery/1.9.1/jquery.js"></script>
    <script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <title>用户登入</title>
</head>
<body>
<div style="height: 100px"></div>
<div class="container">
    <section>
        <div class="form-group">
            <label for="login_users">ID</label>
            <input type="text" class="form-control" id="login_user" placeholder="ID" oninput="AjaxSend_get_name();">
        </div>
        <div class="form-group">
            <label for="login_users">姓名</label>
            <input type="text" class="form-control" id="login_name" placeholder="姓名" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="login_passwd">密码</label>
            <input type="password" class="form-control" id="login_passwd" placeholder="密码">
        </div>
        <div class="form-group">
            <label for="check_code">验证码</label>
            <input type="text" class="form-control" id="check_code" placeholder="">
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio1" grade="A" checked>学生登入
                </label>
                <label class="radio-inline">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio2" grade="B">教师登入
                </label>
                <label class="radio-inline">
                    <input type="radio" name="inlineRadioOptions" id="inlineRadio3" grade="C">管理登入
                </label>
            </div>
        <button type="submit" class="btn btn-primary btn-lg" onclick="return AjaxSend();">确认登入</button>
        <a href="register.php"><button type="submit" class="btn btn-default"">注册页面</button></a>
    </section>
</div>
<script>
    var zkzcode; //在全局 定义验证码
    // 清除所有的cookie

    function createCode() {
        zkzcode = "";
        var zkzcodeLength = 4;//验证码的长度
        var selectChar = new Array(2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'K', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');//所有候选组成验证码的字符，当然也可以用中文的
        for (var i = 0; i < zkzcodeLength; i++) {
            var charIndex = Math.floor(Math.random() * 31);
            zkzcode += selectChar[charIndex];
        }
        console.log(zkzcode)
        $("#check_code").attr("placeholder", "请输入验证码：" + zkzcode)
    }
    window.onload = function () {
        createCode();
    }

    function AjaxSend() {
        if($("#check_code").val() != zkzcode){
            alert("验证码错误，请重新输入。")
            $(":input").val("")
            return false
        }
        $.ajax({
            url: 'php_api/pubic_api/login_api.php',
            type: "POST",
            data: {
                "login_user": $("#login_user").val(),
                "login_name": $("#login_name").val(),
                "login_passwd": $("#login_passwd").val(),
                "login_type": $("input[name='inlineRadioOptions']:checked").attr("grade")
            },
            // 设置超时的时间XXs
            timeout: 30000,
            success: function (recv) {
                //当服务端处理完成后，返回数据时，该函数自动调用
                // data代表服务器给我们返回的值
                // 可以使用 JavaScript进行html的内容修改展示内容，或者刷新界面
                console.log(recv)
                // 登入成功
                recv = JSON.parse(recv)
                if (recv["status"] == "true") {
                    alert("登入成功。。。。")
                    if(recv["grade"] == "A"){
                        location.href = "html_template/html_student/student_info.php?cookie_name="+$("#login_user").val()
                    }
                    if(recv["grade"] == "B"){
                        location.href = "html_template/html_teacher/teacher_student_info.php?cookie_name="+$("#login_user").val()
                    }
                    if(recv["grade"] == "C"){
                        location.href = "html_template/html_admin/admin_student_info.php?cookie_name="+$("#login_user").val()
                    }
                    $(":input").val("")
                };

                if (recv["status"] == "false") {
                    alert("异常，请重试，或将信息补充完整,账号密码错误");
                    location.reload();
                };
            }
        })
    }

    function AjaxSend_get_name() {
        $("#login_name").val("")
        $.ajax({
            url: 'php_api/pubic_api/id_get_name_api.php',
            type: "POST",
            data: {
                "login_id": $("#login_user").val(),
            },
            // 设置超时的时间XXs
            timeout: 30000,
            success: function (recv) {
                //当服务端处理完成后，返回数据时，该函数自动调用
                // data代表服务器给我们返回的值
                // 可以使用 JavaScript进行html的内容修改展示内容，或者刷新界面
                console.log(recv)
                // 登入成功
                recv = JSON.parse(recv)
                if(recv["status"] == "true"){
                    $("#login_name").val(String(recv["id_name"]))
                }else {
                    $("#login_name").val("该账户未注册...")
                }
            }
        })
    }
</script>
</body>
</html>
