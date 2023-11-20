<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-widsth, initial-scale=1.0">
    <title>data_insert</title>
</head>
<body>
    <?php
    # 변수 저장
        $prodnum = $_POST[ 'prodnum' ];
        $beltnum = $_POST[ 'beltnum' ];
        $foldsize = $_POST[ 'foldsize' ];
        $unfoldsize = $_POST[ 'unfoldsize' ];
        $weight = $_POST[ 'weight' ];
        $term = $_POST[ 'term' ];
        $wellfold = $_POST[ 'wellfold' ];
        $water = $_POST[ 'water' ];
        $key = $_POST['key'];
        $beltnum = $_POST['beltnum'];

        $test_conn = mysqli_connect( 'localhost', 'root', '1234', 'projectdb' );


        $test_sql = "INSERT INTO colltbl (foldSize, unfoldSize, weight, term, wellFold, waterProof, keyTest) VALUES ('$foldsize', '$unfoldsize', '$weight', '$term', '$wellfold', '$water', '$key');";
        
        $test_ret = mysqli_query($test_conn, $test_sql);
        // echo '<h1>Success</h1>';
        echo "<script>location.replace('dashboard.php');</script>";

    ?>
</body>

</html>


<!-- $test_sql = "INSERT INTO colltbl ( prodnum, beltnum, foldsize, unfoldsize, weight, term, wellfold, water, key ) VALUES ( '$prodnum', '$beltnum', '$foldsize', '$unfoldsize', '$weight', '$term', '$wellfold', '$water', '$key' );"; -->