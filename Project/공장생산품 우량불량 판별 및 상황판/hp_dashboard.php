<?php
    session_start();
    $con =  mysqli_connect("localhost", "root", "1234", "projectdb") or die("MariaDB 접속 실패!");
    $sql = "SELECT * FROM finalTBL";

    $ret = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($ret);    # 하나씩 불러오기

    $sql2 = "SELECT sumFoldsize, sumUnfoldsize, sumWeight, sumTerm, sumWellfold, sumWaterproof, sumKeytest FROM finaltbl";
    $ret2 = mysqli_query($con, $sql2);
    $row2 = mysqli_fetch_assoc($ret2); 

    // 불러온 db 배열 컬럼-값을 다시 선언하기 위해 컬럼 이름 변수로 지정
    $old_key1 = 'sumFoldsize';
    $new_key1 = '접었을 때 크기';
    $old_key2 = 'sumUnfoldsize';
    $new_key2 = '안 접었을 때 크기';
    $old_key3 ='sumWeight';
    $new_key3 = '무게';
    $old_key4 = 'sumTerm';
    $new_key4 = '간격';
    $old_key5 = 'sumWellfold';
    $new_key5 = '잘 접히지 않음';
    $old_key6 = 'sumWaterproof';
    $new_key6 = '방수';
    $old_key7 = 'sumKeytest';
    $new_key7 = '키 눌림';

    $row2[$new_key1] = $row2[$old_key1];
    $row2[$new_key2] = $row2[$old_key2];
    $row2[$new_key3] = $row2[$old_key3];
    $row2[$new_key4] = $row2[$old_key4];
    $row2[$new_key5] = $row2[$old_key5];
    $row2[$new_key6] = $row2[$old_key6];
    $row2[$new_key7] = $row2[$old_key7];

    // 기존의 컬럼 이름 삭제
    unset($row2[$old_key1], $row2[$old_key2], $row2[$old_key3], $row2[$old_key4], $row2[$old_key5], $row2[$old_key6], $row2[$old_key7]);

    // 불량 수 최대값 구하는거
    $max_int_v = max($row2);
    $max_int_v_key = array_search($max_int_v,$row2);
    // 불량률
    $max_rate = ($max_int_v / $row[4]) *100;
    $format_max_rate = number_format($max_rate, 2);
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
        #dashboard {float: right; border: 3px; }
        .person_info {border: 35px solid #faf0ca; padding:50px 2px 50px 2px; text-align:center;}
        .now {margin: 50px 20px 0px 20px; color: #393E41; text-align:center; border: 3px solid #393E41; border-collapse: collapse; width:750px; }
        .table_head {
            color: #393E41;
            text-align : center;
            border:#393E41 1px;
            font-style: bold;
            height:30px;
        }
        .table_content {
            color: #f2545b;
            text-align:center;
            height:60px;
        }
        .last {margin-top: -40px; float: right;}
        .hr { border: 2px #f2545B solid; margin-top: -10px; float:inline-end;}
        span{
            float:left;
        }
        .badcause {
            margin-top: -10px;
            margin-bottom: 70px;
        }
        .datainsert {
            margin-top: 15px;
            margin-left: 20px;
            padding: 7px 12px 7px 12px;
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
                        <h3 class = "current">현 상황</h3>
                        <p class = "last">마지막 업데이트 시간 : <?php echo $row['currentTime']?></p>
                    </article>
                    <article>
                        <hr class="hr">
                    </article>
                    <article>
                        <table class = "now" border="2px" solid="black">
                            <tr class = 'table_head'>
                                <td>생산목표</td>
                                <td>양품수량</td>
                                <td>불량수량</td>
                                <td>불량률(%)</td>
                                <td>생산수량</td>
                            </tr>
                            <tr class="table_content">
                                <td><?php echo $row['targetAmount']?></td>
                                <td><?php echo $row['good']?></td>
                                <td><?php echo $row['bad']?></td>
                                <td><?php echo $row['defectPercent']?></td>
                                <td><?php echo $row['currentAmount']?></td>
                            </tr>
                        </table>
                    </article>
                    <br>
                    <br>
                    <br>
                    <article class = "current_last">
                        <h3 class = "current">불량 항목 누적 개수</h3>
                    </article>
                    <article>
                        <hr class="hr">
                    </article>
                    <article class="badcause">
                        <span> 현재 제일 많은 불량원인은&nbsp</span>
                        <span><?php echo "【", $max_int_v_key,"】이며, 전체 불량률 중 【", $format_max_rate ?> </span>
                        <span>%】를 차지하고 있습니다.</span>
                    </article>
                    <article>
                        <table class = "now" border="2px" solid="black">
                            <tr class = 'table_head'>
                                <td>접혔을 때 크기</td>
                                <td>안 접혔을 때 크기</td>
                                <td>무게</td>
                                <td>간격</td>
                                <td>잘 접히는지</td>
                                <td>방수</td>
                                <td>키 눌림</td>
                            </tr>
                            <tr class="table_content">
                                <td><?php echo $row['sumFoldsize']?></td>
                                <td><?php echo $row['sumUnfoldsize']?></td>
                                <td><?php echo $row['sumWeight']?></td>
                                <td><?php echo $row['sumTerm']?></td>
                                <td><?php echo $row['sumWellfold']?></td>
                                <td><?php echo $row['sumWaterproof']?></td>
                                <td><?php echo $row['sumKeytest']?></td>
                            </tr>
                        </table>
                    </article>
                    <button class="datainsert" type="button" onclick="location.href='data.php'">데이터 입력하기</button>
                </div>
            </section>
        </div>
    </div>
</body>
</html>