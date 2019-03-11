<?php
    session_start();

    $isbn = $_GET['isbn'];
    
    $db_user="root";
    $db_pass="1234";
    $db_type="mysql";
    $db_host="localhost";
    $db_name="project";
    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";
    $tb_name="book_type";

    try{
        //isbn을 통해 book_type 정보 읽어오기
        $pdo=new PDO($dsn, $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "select * from $tb_name where isbn = :isbn";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_INT);
        $stmh->execute();
        //$pdo->commit();
        
        $row = $stmh->fetch(PDO::FETCH_ASSOC);
        $name = $row['name'];
        $price = $row['price'];
        $publisher = $row['publisher'];
        $author = $row['author'];
        
        //book 재고 갯수 읽어오기
        $tb_name = "book";
        $sql = "select * from $tb_name where isbn = :isbn and cid is null";

        $stmh = $pdo->prepare($sql);
        $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_INT);
        $stmh->execute();
        $count = $stmh->rowCount();
        
    } catch (PDOException $Exception) {
        //$pdo->rollBack();
        die('Error: '.$Exception->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8"/>
    <title>한빛출판네트워크</title>
    <link rel="stylesheet" href="/css/common.css" />
    <link href="/css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/css/layout-hanbit.css" />
    <link rel="stylesheet" href="/css/layout-member.css" />
    <link rel="stylesheet" href="/css/layout-network.css" />
    <link rel="stylesheet" href="/css/layout-store.css" />
    <link rel="stylesheet" href="/css/layout-myhanbit.css" />
    <link rel="stylesheet" href="/css/layout-event.css" />
    <link rel="stylesheet" href="./css/main.css" />
</head>
<body>
    <header>
        <nav>
            <div id="wrap_nav">
                <ul class="top_brand">
                    <li><a href="/index.php" name="hanbit_network"><span>HOME</span></a></li>
                </ul>

                <ul class="top_menu">
                    <?php
                        if(!isset($_SESSION['ses_id'])) {
                        ?>
                        <li><a href="/member/manager_login.php" class="login"><img src="/img/top_icon_login.png">매니저 로그인</a></li>
                        <li><a href="/member/login.php" class="login"><img src="/img/top_icon_login.png">로그인</a></li>
                        <li><a href="/member/member_agree.php" class="join"><img src="/img/top_icon_join.png">회원가입</a></li>
                        <?php
                        }
                        else {
                        ?>
                        <li><a href="/logout.php" class="logout"><img src="/img/top_icon_logout.png">로그아웃</a></li>
                        <li><a href="/myhanbit/myhanbit.php" class="myhanbit"><img src="/img/top_icon_my.png">마이한빛</a></li>
                        <?php
                        }
                        ?>
                        <li><a href="/store/store_submain.php" class="cart"><img src="/img/top_icon_cart.png">STORE</a></li>
                </ul>
            </div>
        </nav> 
    </header>

    <!-- Contents -->
    <div id="container">
      <!-- 카테고리 상세 wrap -->
        <div class="store_view_wrap">
            <div class="store_view_wrap_l">
              <!-- 책 정보 -->
                <div class="store_view_area">
                    <div class="store_product_box">
                        <div class="store_product_box_img">    
                            <img src="/img/B5934047828_l.jpg" alt="" class="thumb" />
                        </div>
                    </div>

                    <div class="store_product_info_box">
                        <h3><?=htmlspecialchars($name)?></h3>
                        <ul class="info_list">
                            <li><strong>ISBN : </strong><span><?=htmlspecialchars($isbn)?></span></li>
                            <li><strong>저자 : </strong><span><?=htmlspecialchars($author)?></span></li>            
                            <li><strong>출판사 :</strong><span><?=htmlspecialchars($publisher)?></span></li>
                        </ul>

                        <div class="tag_area">
                            <span>TAG : </span>
                        <?php
                            try{
                                $tb_name = "tags";
                                
                                $sql = "select * from $tb_name where isbn = :isbn";

                                $stmh = $pdo->prepare($sql);
                                $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_INT);
                                $stmh->execute();
                                //$pdo->commit();

                                $row2 = $stmh->fetch(PDO::FETCH_ASSOC);
                                $count2 = $stmh->rowCount();

                            } catch (PDOException $Exception) {
                                //$pdo->rollBack();
                                die('Error: '.$Exception->getMessage());
                            }
                            
                            while($row2 = $stmh->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <a><?=htmlspecialchars($row2['tag_name'])?> </a>
                        <?php
                            }
                        ?>
                        </div>  

                    </div>
                </div>

                <div class="store_like_area"></div>

                <!-- 버튼 -->
                <div class="store_btn_area">
                    <form method="post" action="./review.php">
                        <input type="hidden" name="book_isbn" id="book_isbn" value=<?=htmlspecialchars($isbn)?>>
                        <input type="hidden" name="book_name" id="book_name" value=<?=htmlspecialchars($name)?>>
                        <div class="btn_review">
                           <button name="btnReview" id="btnReview" type="submit" value="리뷰쓰기" class="btn_Review"> 리뷰쓰기</button>
                        </div>
                    </form>
                </div>
                <!-- //버튼 -->
                
                <div id="tabs_5" ><a id="review_tab" ></a>                       
                    <p class="detail_tit" style="display:none;">독자리뷰</p>
                    <div id="" class="detail_conbox" >
                        <div class="detail_review_area">
                            <ul>
                                <?php
                                    try{
                                        //review 불러오기
                                        $tb_name = "review";
                                        $sql = "select * from $tb_name where isbn = :isbn";

                                        $stmh = $pdo->prepare($sql);
                                        $stmh->bindValue(':isbn', (int) $isbn, PDO::PARAM_INT);
                                        $stmh->execute();

                                    } catch (PDOException $Exception) {
                                        //$pdo->rollBack();
                                        die('Error: '.$Exception->getMessage());
                                    }

                                    while($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <li class="article hide">
                                    <div class="review_li">
                                        <div class="info"><strong><?=htmlspecialchars($row['cid'])?>님</strong><span>l</span>별점 : <?=htmlspecialchars($row['rate'])?></div>
                                        <div class="star_rate1"></div>
                                        <div class="tit"><?=htmlspecialchars($row['title'])?></div>
                                    </div>
                                    <div class="review_view hanbit_edit_view">
                                        <?=htmlspecialchars($row['article'])?>
                                    </div>
                                </li>
                                <?php 
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>						
                </div>
            </div>

            <div class="store_payment_area">
                <form method="post" action="./buy.php">
                <!-- 결재 정보 -->
                    <fieldset>
                        <legend>결재하기</legend>
                        <label class="payment_box curr">
                            <p><span class="pbl"><strong>판매가 : </strong></span><span class="pbr"><strong><?=htmlspecialchars($price)?></strong>원</span></p>          
                        </label>

                        <div class="shopping_charge">
                            <div class="shopping_charge_tit"><span>&#149; 배송료 : </span>무료</div>
                        </div>
                        <div class="shopping_charge">
                            <div class="shopping_charge_tit"><span>&#149; 남은 수량 : </span><?=htmlspecialchars($count)?></div>
                        </div>

                        <label>
                            <button name="btnBuy" id="btnBuy" type="submit" value="구매하기" class="btn_buy"> 구매하기</button>
                        </label>
                        <input type="hidden" name="book_isbn" id="book_isbn" value=<?=htmlspecialchars($isbn)?>>
                        <input type="hidden" name="book_price" id="book_price" value=<?=htmlspecialchars($price)?>>
                        
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
