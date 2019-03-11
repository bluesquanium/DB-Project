<?php
    session_start();
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
        <div class="docu_title">
            
            <div class="my_coupon_search">
                <!--p>검색 결과입니다.</p-->
                <?php
                    $db_user="root";
                    $db_pass="1234";
                    $db_type="mysql";
                    $db_host="localhost";
                    $db_name="project";
                    $dsn    ="$db_type:host=$db_host; dbname=$db_name; charset=utf8";
                
                    $bookname = $_POST["bookname"];
                    $search_key = '%'.$bookname.'%';
                    
                    try{
                        $pdo=new PDO($dsn, $db_user, $db_pass);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        $sql = "select * from book_type where name like :book_name";
                        
                        $stmh = $pdo->prepare($sql);
                        $stmh->bindValue(':book_name', $search_key, PDO::PARAM_STR);
                        $stmh->execute();
                        $count = $stmh->rowCount();
                        
                        if($count<1) {
                            print "조회된 검색 결과가 없습니다.<br><br>";
                        }
                        else {
                            print "검색 결과는 ".$count."건입니다.<br><br>";
                        }
                    } catch (PDOException $Exception) {
                        die('Error: '.$Exception->getMessage());
                    }
                ?>
            </div>
        </div>
        
        <div class="docu_title">
            <h2>검색</h2>
        </div>

    <!-- 검색 리스트 wrap -->
    <div class="srch_list_wrap">
        <!-- 검색창 -->
        <form method="post" action="./search_sublist.php">
            <div class="my_coupon_search">
                <div><label class="i_label"><input title="검색어" type="text" value="" name="bookname" id="bookname" class="i_text"></label></div>
                <div><label><button type="submit" name="" value="" class="btn_blue">검색</button></label></div>        
            </div>
        </form>
        <!-- //검색창 -->    

        <div class=mgr_table">
            <table width="900" boarder="1" cellspacing="0" cellpadding="8">
                <tbody>
                    <tr>
                        <th>등록번호</th>
                        <th>서명</th>
                        <th>가격</th>
                        <th>저자</th>
                        <th>출판사</th>
                    </tr>
                    <?php
                    while($row = $stmh->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td align="center" width=100 style="word-break:break-all"><?=htmlspecialchars($row['isbn'])?></td>
                        <td width=300 style="word-break:break-all"><?=htmlspecialchars($row['name'])?></td>
                        <td align="center" width=80 style="word-break:break-all"><?=htmlspecialchars($row['price'])?></td>
                        <td align="center" width=120 style="word-break:break-all"><?=htmlspecialchars($row['author'])?></td>
                        <td align="center" width=200 style="word-break:break-all"><?=htmlspecialchars($row['publisher'])?></td>
                        <td>
                            <form name="look_book" method="get" action="../store/books/look.php" style="margin: 0 auto; ">
                                <div style="text-align: center">
                                    <input type="hidden" name="isbn" value=<?=htmlspecialchars($row['isbn'])?>>
                                    <!--
                                    <input type="hidden" name="name" value=<?=htmlspecialchars($row['name'])?>>
                                    <input type="hidden" name="price" value=<?=htmlspecialchars($row['price'])?>>
                                    <input type="hidden" name="author" value=<?=htmlspecialchars($row['author'])?>>
                                    <input type="hidden" name="publisher" value=<?=htmlspecialchars($row['publisher'])?>>
                                    -->
                                    <input type="submit" value="책 정보" style=" background: #2d3651; width: 82px; height: 30px; margin:0; border: 0; padding:0; border-radius: .3em; color: #FFF;">
                                </div>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </div>
    <!-- //Contents -->
</body>
</html>
