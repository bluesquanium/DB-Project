<?php
    session_start();

    $book_isbn = $_POST['book_isbn'];
    $book_name = $_POST['book_name'];
    $book_price = $_POST['book_price'];
    $book_author = $_POST['book_author'];
    $book_publisher = $_POST['book_publisher'];
    
    $r_title = $_POST['r_title'];
    $r_rate = $_POST['r_rate'];
    $r_content = $_POST['r_content'];
    
    print "$book_isbn, $book_name, $book_price, $book_author, $book_publisher <br>";
    print "$r_title, $r_rate, $r_content";
    

    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $tb_name = "review";
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";

    $book_isbn = $_POST["book_isbn"];
    $book_price = $_POST["book_price"];

    try{
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "insert into $tb_name (cid, isbn, rate, article, title) values (:cid, :isbn, :rate, :article, :title)";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':cid', $_SESSION['ses_id'], PDO::PARAM_STR);
        $stmh->bindValue(':isbn', $book_isbn, PDO::PARAM_STR);
        $stmh->bindValue(':rate', (int) $r_rate, PDO::PARAM_STR);
        $stmh->bindValue(':article', $r_content, PDO::PARAM_STR);
        $stmh->bindValue(':title', $r_title, PDO::PARAM_STR);
        $stmh->execute();
        //$pdo->commit();
        
        Header("Location:./look.php?isbn=$book_isbn");
    } catch (PDOException $Exception) {
        //$pdo->rollBack();
        //die('Error: '.$Exception->getMessage());
?>
<script>
    alert("리뷰는 한 번만 작성 가능합니다. (여러 권 샀어도 한 번만 가능)");
    //history.go(-1);//첫번째 방법
    //history.back();//두번째 방법
    location.href ="../store_submain.php"//해당 주소로 이동하는방법
</script>
<?php
    }
?>