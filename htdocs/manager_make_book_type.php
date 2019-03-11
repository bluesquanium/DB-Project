<?php
    $isbn = $_POST["isbn"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $publisher = $_POST["publisher"];
    $author = $_POST["author"];
    
    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $tb_name="book_type";
    
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";

    try{
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // book_type에 등록
        $sql = "insert into $tb_name (isbn, name, price, publisher, author) values (:isbn, :name, :price, :publisher, :author)";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_STR);
        $stmh->bindValue(':name', $name, PDO::PARAM_STR);
        $stmh->bindValue(':price', (int) $price, PDO::PARAM_INT);
        $stmh->bindValue(':publisher', $publisher, PDO::PARAM_STR);
        $stmh->bindValue(':author', $author, PDO::PARAM_STR);
        
        $stmh->execute();
        
        // tags가 있을 경우 tags에 등록
        if(isset($_POST["tags"])) {
            $tags = $_POST["tags"];
            $tb_name = "tags";
            foreach($tags as $tag) {
                $sql = "insert into $tb_name (isbn, tag_name) values (:isbn, :tag_name)";

                $stmh = $pdo->prepare($sql);
                $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_STR);
                $stmh->bindValue(':tag_name', $tag, PDO::PARAM_STR);

                $stmh->execute();
            }
        }
        
?>
<script>
    alert("정상적으로 등록되었습니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
    } catch (PDOException $Exception) {
        print('Error: '.$Exception->getMessage());
?>
<script>
    alert("이미 등록된 isbn이거나, 값들을 모두 채우지 않으셨습니다.");
    //history.go(-1);//첫번째 방법
    history.back();//두번째 방법
    //href.location ="주소"//해당 주소로 이동하는방법
</script>
<?php
    }
?>