<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
     <title>資料庫概論第九組</title>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
     <link rel="icon" type="image/gif" href="images/favicon.gif" />
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/animate.css">
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/templatemo-style.css">
     <link rel="stylesheet" href="css/table.css">

</head>
<body>

     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top " role="navigation"  >
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand">華藝 <span>.</span> 資料庫</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first drop-down-menu">
                         <li><a href="index.html" class="smoothScroll">回首頁</a></li>
                         <li><a href="" class="smoothScroll">單表查詢</a>
                              <ul>
                                <li><a href="Books_search.php" class="smoothScroll">用書本表查詢</a></li>
                                <li><a href="Author_search.php" class="smoothScroll">用作者表查詢</a></li>
                                <li><a href="Chapters_search.php" class="smoothScroll">用章節表查詢</a></li>
                                <li><a href="Series_search.php" class="smoothScroll">用書系表查詢</a></li>
                              </ul>
                         </li>
                         <li><a href="" class="smoothScroll">合併查詢</a>
                              <ul>
                                <li><a href="BAinse.php" class="smoothScroll">合併書本&作者查詢</a></li>
                                <li><a href="BCinse.php" class="smoothScroll">合併書本&章節查詢</a></li>
                                <li><a href="BSinse.php" class="smoothScroll">合併書本&書系查詢</a></li>
                              </ul>
                         </li>
                         <li><a href="" class="smoothScroll">修改資料</a>
                              <ul>
                                <li><a href="Author_update.php" class="smoothScroll">修改作者資料</a></li>
                                <li><a href="Chapter_update.php" class="smoothScroll">修改文章資料</a></li>
                                <li><a href="Serie_update.php" class="smoothScroll">修改書系資料</a></li>
                              </ul>
                         </li>
                         <li><a href="" class="smoothScroll">增刪資料</a>
                              <ul>
                                <li><a href="Book_inde.php" class="smoothScroll">增刪書本資料</a></li>
                                <li><a href="Author_inde.php" class="smoothScroll">增刪作者資料</a></li>
                                <li><a href="Chapter_inde.php" class="smoothScroll">增刪章節資料</a></li>
                                <li><a href="Serie_inde.php" class="smoothScroll">增刪書系資料</a></li>
                              </ul> 
                         </li>
                         <li><a href="paperwork.html" class="smoothScroll">書面報告</a></li>
                    </ul>
               </div>

          </div>
      </section>
    <br><br><br><br>
    <center><h3>查詢Chapters資料表</h3></center><br>
    <form action="" method="post" align="center" >
      <h5>關鍵字：
      <input type="text" name="key" size="16" placeholder="若無輸入則列出所有..." > </h5> 
      <h5>指定欄位：    
      <select name="option">
        <option value="1">不限欄位</option>  <!--每個選項列值以供系統判斷 -->
        <option value="2">章節名稱</option>
        <option value="3">作者、編者</option>
        <option value="4">書名</option>         
      </select>&nbsp;&nbsp;
      <input type="submit" value="搜尋">
    </form>
       
       <?php
     
         $key = $_POST['key'] ;      //關鍵字
         $option = $_POST['option']; //將前面選擇的選項(值)存入變數以供後續的查詢語句判斷

        if (isset($option) && isset($key)){
           $link = @mysqli_connect('localhost', '107dba09', '107dba09','107dba09');   
           if($link===false){
           echo '連結錯誤代碼：'. mysqli_connect_errno().'<br>';
           echo '連結錯誤訊息：'. mysqli_connect_errno().'<br>';
           die();
           }  

           mysqli_query($link, 'set names utf8');


        if($option==1){       //根據前面選擇的選項(值)判斷要在哪個資料表中查詢

           $sql = "select * from `Chapters` where `Chaptername` like '%$key%' or `Chapterauthor` like '%$key%' order by Chaptername ";
        }
         else if($option==2){$sql = "select * from `Chapters` where `Chaptername` like '%$key%' order by Chaptername ";
         }
         else if($option==3){$sql = "select * from `Chapters` where `Chapterauthor` like '%$key%' order by Chaptername ";
         }
        

        //echo $sql;
        $result = mysqli_query($link,$sql);     //該次查詢結果
        $total = mysqli_num_rows($result);      //該次查詢結果的資料筆數  
    
        if (isset($option) && isset($key)){     //以表格形式列出結果，條件為關鍵字及按鈕都有觸發
        
          if ($total==0){

             echo '<p align = "center">並沒有包含「'. $key .'」的資料</p>';
             echo '<img src = "picture/no.jpg" style = "display:block; margin:auto;"/>';

          }else{
             echo'<p align="center">總共有'.$total.'筆資料 </p>'; 
             echo "<table align='center'  >" ;
              echo "<tr align='center'>";  
              echo "<td style='vertical-align:middle;'><b>章節名稱</b></td>";
              echo "<td style='vertical-align:middle;'><b>作者、編者</b></td>";
             
              echo "</tr>";              
           }
        }

        while ($row = mysqli_fetch_row($result)){
           echo "<tr align='center'>";
           echo '<td style="vertical-align:middle;">'. $row[1] .'</td>
                 <td style="vertical-align:middle;">'. $row[2] .'</td>
                 ';
           echo "</tr>";
        }
         echo "</table>";

        mysqli_close($link); } 

       ?>
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/wow.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
  </body>
</html>