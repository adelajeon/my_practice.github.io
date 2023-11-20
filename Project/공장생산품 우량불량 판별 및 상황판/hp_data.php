<?php
    session_start();
    $con =  mysqli_connect("localhost", "root", "1234", "projectdb") or die("MariaDB 접속 실패!");
    $sql = "SELECT * FROM finalTBL";

    // $_SESSION['usernum'] = $row['managerNum'];
    // $_SESSION['name'] = $row['NAME'];
    // $_SESSION['en'] = $row['extensionNum'];
    // $_SESSION['usernum'] = $row['id'];
    // $_SESSION['password'] = $row['pw'];
    // $m_sql = "SELECT * FROM memtbl WHERE managerNum = $_SESSION['usernum'] AND PASSWORD = $_SESSION['password'];";

    $ret = mysqli_query($con, $sql);
    // $m_ret = mysqli_query($con, $m_sql);
    $row = mysqli_fetch_array($ret);    # 하나씩 불러오기
    // $m_row = mysqli_fetch_array($m_ret);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBALGAEYO</title>
    <style>
        body {width: 1100px; margin: 5px auto; font-family: NanumBarunGothic;}
        hr {margin-bottom: 30px;}
        #info {float: left; width: 200px; border: 3px; margin: 0 5px 0 5px;}
        #dashboard {float: right; border: 3px;}
        .person_info {border: 35px solid #faf0ca; padding:50px 2px 50px 2px; text-align:center;}
        .now {margin: 20px 20px 0px 20px;  width:750px; margin-bottom: 35px;}
        .last {margin-top: -40px; float: right;}
        .hr { border: 2px #f2545B solid; float:inline-end;}

        .submit {padding: 7px 20px 7px 20px;}
        .suzip {height: 50px; }
        .select {margin: -15px 20px 0px 20px;  width:750px; margin-bottom: 35px;}
        .selection {width:191px; height: 30px;} 
        .dashboard {
            margin-left: 10px;
            padding: 7px 12px 7px 12px;
        }

    </style>
</head>
<body>
    <!-- 전체 틀 잡은거 입니다. -->
    <div id="page">
        <!-- 헤더 입니다 -->
        <header id ="main-header">
            <h1 class="company"> (주)빨개요 </h1>
            <hr style = "border: 2px black solid">
        </header>
        <!-- 본문 -->
        <div id ="content">
            <!-- 좌측영역 ( 사원 정보 ) -->
            <aside id="info" >
                <table class="person_info" >
                    <tr><td><img src="https://img1.daumcdn.net/thumb/R1280x0/?scode=mtistory2&fname=https%3A%2F%2Fblog.kakaocdn.net%2Fdn%2FrZ8CG%2FbtsnwZ4IbZM%2FclSHoKM3WdD4mdKyTuJFoK%2Fimg.jpg" width=150px></td></tr>
                    <tr><td height=10px></td></tr>
                    <tr><td><b><?php echo $_SESSION['name'] ?></b> 사원</td></tr>
                    <tr><td><?php echo $_SESSION['usernum'] ?></td></tr>
                    <tr><td>내선번호: <?php echo $_SESSION['en'] ?></td></tr>
                    <tr><td>남은연차 : 0</td></tr>
                    <tr><td height=10px></td></tr>
                    <tr><td class="logout"><a href="login.php">로그아웃</a></td></tr>
                </table>
            </aside>
            <!-- 우측영역 (대시보드)-->
            <section id="dashboard">
                <div>
                    <article class = "current_last">
                        <h3 class = "current">데이터 수집</h3>
                        <p class = "last">마지막 업데이트 시간 : <?php echo $row['currentTime']?></p>
                    </article>
                    <article>
                        <hr class="hr">
                    </article>
                    <article>
                        <form action="data_insert.php" method="POST">
                            <table class = "now">
                                <tr>
                                    <td class="selection">제품 번호</td>
                                    <td><select name="prodnum" style="width:177px; text-align:center;">
                                        <option value="BG-F17J"> BG-F17J </option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td class="selection" >벨트넘버</td>
                                    <td name="beltnum" id="beltnum"><?php echo $_SESSION['belt'] ?></td>
                                </tr>
                            </table>
                            <hr>
                            <table class="select">
                                <tr>
                                    <td class="suzip" colspan="2"><b>수집데이터</b></td>
                                </tr>
                                <tr>
                                    <td class="selection">접었을 때 크기</td>
                                    <td><input name="foldsize" id="foldsize" type="number" min="0" max="999" required></td>
                                </tr>
                                <tr>
                                    <td class="selection">펼쳤을 때 크기</td>
                                    <td><input name="unfoldsize" id="unfoldsize" type="number" min="0" max="999" required ></td>
                                </tr>
                                <tr>
                                    <td class="selection">무게</td>
                                    <td><input name="weight" id="weight" type="number" min="0" max="9999" required></td>
                                </tr>
                                <tr>
                                    <td class="selection">간격(틈)</td>
                                    <td><select name="term"style="width:50px; text-align:center;">
                                        <option value="0"> 0 </option>
                                        <option value="1"> 1 </option>
                                        <option value="2"> 2 </option>
                                    </select></td>
                                </tr>
                                <tr>
                                    <td class="selection">잘 접힘 여부</td>
                                    <td><input type="radio" name="wellfold" value="1">
                                    <label for="wellfold">O</label>
                                    <input type="radio" name="wellfold" value="0">
                                    <label for="wellfold">X</label><br></td>
                                </tr>
                                <tr>
                                    <td class="selection">방수</td>
                                    <td><input type="radio" name="water" value="1">
                                        <label for="water">O</label>
                                        <input type="radio" name="water" value="0">
                                        <label for="water">X</label><br></td>
                                </tr>
                                <tr>
                                    <td class="selection">키 눌림 횟수</td>
                                    <td><select name="key" style="width:50px; text-align:center;">
                                        <option value="0"> 0 </option>
                                        <option value="1"> 1 </option>
                                        <option value="2"> 2 </option>
                                        <option value="3"> 3 </option>
                                        <option value="4"> 4 </option>
                                        <option value="5"> 5 </option>
                                        <option value="6"> 6 </option>
                                        <option value="7"> 7 </option>
                                        <option value="8"> 8 </option>
                                        <option value="9"> 9 </option>
                                        <option value="10"> 10 </option>
                                        <option value="11"> 11 </option>
                                        <option value="12"> 12 </option>
                                        <option value="13"> 13 </option>
                                        <option value="14"> 14 </option>
                                        <option value="15"> 15 </option>
                                    </select></td>
                                </tr>
                            </table>
                            <hr>
                            <input class="submit" type="submit" value="입력">
                            <button class="dashboard" type="button" onclick="location.href='dashboard.php'">대시보드</button>
                        </form>
                    </article>
                </div>
            </section>
        </div>
    </div>
</body>
</html>