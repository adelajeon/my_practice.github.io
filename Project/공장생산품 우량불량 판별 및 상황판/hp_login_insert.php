<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title></title>
</head>
<body>
   <?php
      session_start();
        //접속
      $con =  mysqli_connect("localhost", "root", "1234", "projectdb") or die("MariaDB 접속 실패!");

      //login.php에서 입력받은 id, password
      $usernum = $_POST['id'];
      $password = $_POST['pw'];
      
      $sql = "SELECT * FROM memtbl WHERE managerNum = '$usernum' AND PASSWORD = '$password';";

      $result = mysqli_query($con, $sql);

      $row = $result->fetch_array(MYSQLI_ASSOC);
      
      //결과가 존재하면 세션 생성
      if ($row != null) {
         $_SESSION['usernum'] = $row['managerNum'];
         $_SESSION['name'] = $row['NAME'];
         $_SESSION['en'] = $row['extensionNum'];
         $_SESSION['belt'] = $row['beltNum'];

         echo "<script>location.replace('data.php');</script>";
      }
      
      //결과가 존재하지 않으면 로그인 실패
      if($row == null){
         // echo "실패";
         echo "<script>alert('사원번호와 비밀번호를 다시 확인해주세요.')</script>";
         echo "<script>location.replace('login.php');</script>";
         exit;
      }
      ?>
   </body>