<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BbalGaYo Company</title>
    <style>
        body {width: 1100px; margin: 5px auto; font-family: NanumBarunGothic;}
        fieldset {
            border-width:4px; 
            border-color: #f2545B;
            border-style:solid;}
        .box {
            width: 280px;
            margin: 250px 410px 0 410px;}
        .login {
            display:flex;
            justify-content:center;
            width: 280px;
        }
        .id, .password {height:30px;}

        .submit {
            padding: 7px 20px 7px 20px;
            margin-left:100px;
            margin-top:10px;
        }

    </style>
</head>
<body>
        <!-- 전체 틀 잡은거 입니다. -->
    <div id="page">
        <!-- 헤더 입니다 -->
        <header id ="main-header">
            <h1 class="comapany"> (주)빨개요 </h1>
            <hr style = "border: 2px black solid">
        </header>
        <section>
            <article>
                <form class="box" method="post" action="login_insert.php">
                    <fieldset>
                        <legend><b>로그인</b></legend>
                            <table class="login">
                                <tr class="id"><td>
                                사원번호 : <input id="id" name="id" type="text" placeholder="숫자8자리" required>
                                </td>
                                </tr>
                                <tr class="pw"><td>
                                    패스워드 : <input id="pw" name="pw" type="password" placeholder="숫자4자리" required>
                                </td></tr>
                            </table>
                            <input class="submit" type="submit" value="로그인">
                        </fieldset>
                    </form>

            </article>
        </section>
    </div>

</body>
</html>