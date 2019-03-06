<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NumberSearch</title>
    <link rel="stylesheet" href="./css/search.css">
    <script type="text/javascript" src="./js/searchJs.js"></script>
</head>
<body>
        <div class="mainBox" >
            <div class="centerBox" style="top: 150px;">
                <div class="titleBox">
                        <p style="text-align: center;font-size: 48px;line-height: 1.5; font-family:Poor Richard; ">
                            <span id="titleFont" style="text-align: center" >PhoneNumbersOrName</span>
                        </p>
                </div>
                <form action="respond.php" id="searchFrom" method="post" target="_parent">
                    <div class="searchBox">
                        <input type="text" id="searchInput" name="searchInput" placeholder="PhoneNumberOrName" maxlength="11" autocomplete="off" value="">
                        <input type="submit" value="Search" id="searchButton" name="searchButton">
                    </div>
                </form>
            </div>
        </div>
</body>
</html>