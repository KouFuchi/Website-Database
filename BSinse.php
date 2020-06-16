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
     <center><h3>合併查詢Books和Series資料表</h3></center><br>
     <form action="" method="post" align="center" >
      <h5>關鍵字：
      <input type="text" name="key" size="16" placeholder="若無輸入則列出所有..." > </h5> 
      <h5>指定欄位：  
      <select name="option">
        <option value="Books.Bookname">書名</option>  <!--每個選項列值以供系統判斷 -->
        <option value="Books.Introduction">關於</option>
        
        <option value="Series.Seriesname">書系名</option>
            
      </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit" value="搜尋" name="submit"></h5> 
    </form>
  
    <?php
    /*
    SELECT AuthorS.AuthorID, AuthorS.Authorname, AuthorS.Field, AuthorS.Organization,
    city.Name, city.Population ciPop,
    city.Population / AuthorS.Population * 100 Scale
    FROM AuthorS, city
    WHERE Capital = ID

    SELECT AuthorS.*, Write.*, Books.*FROM AuthorS INNER JOIN (Books INNER JOIN Write ON Books.BookID = Write.BookID) ON AuthorS.AuthorID = Write.AuthorID

    SELECT AuthorS.*, Write.*, Books.* 
    FROM AuthorS, Write, Books
    WHERE AuthorS.AuthorID = Write.AuthorID
    AND Books.BookID = Write.BookID

    SELECT Books.*, Belong.*, Series.*
    FROM Books INNER JOIN (Series INNER JOIN Belong ON Series.SeriesID = Belong.SeriesID) ON Books.BookID = Belong.BookID;

    SELECT Books.*, Include.*, Chapters.*
    FROM Books INNER JOIN (Chapters INNER JOIN Include ON Chapters.ChapterID = Include.ChapterID) ON Books.BookID = Include.BookID;

    SELECT Books.*, Write.*, AuthorS.*
    FROM Books INNER JOIN (AuthorS INNER JOIN Write ON AuthorS.AuthorID = Write.AuthorID) ON Books.BookID = Write.BookID;
    */
     $submit=$_POST['submit'];
     $option=$_POST['option'];
     $key=$_POST['key'];
     if(isset($_POST['submit'])){
      $link = @mysqli_connect('localhost', '107dba09', '107dba09', '107dba09');

        if ($link === false) {
          echo '連結錯誤代碼： ' . mysqli_connect_errno() . '<br>';
          echo '連結錯誤訊息： ' . mysqli_connect_error() . '<br>';
          die();
        }


        mysqli_query($link, 'set names utf8');
    
        $sql='SELECT Books.*, Belong.*, Series.*
    FROM Books INNER JOIN (Series INNER JOIN Belong ON Series.SeriesID = Belong.SeriesID) ON Books.BookID = Belong.BookID WHERE '.$option.' like "%'.$key.'%"' ;

        $result = mysqli_query($link, $sql);
        $total = mysqli_num_rows($result);

        if ($total==0) {

           echo '<p align = "center">並沒有包含「'. $key .'」的資料</p>';
           echo '<img src = "picture/no.jpg" style = "display:block; margin:auto;">';
          
        } else {

             echo "<center>";
             echo'總共有'.$total.'筆資料';
             echo "</center><br>";
             echo "<table border=2>";
             //echo $sql;
             echo "<tr><th>書名</th>
                       <th>書系</th>
                       
                       <th>ISBN</th>
                       <th>出版日期</th>
                       <th>價錢</th>
                  
                       <th>圖片</th>
                       
                       </tr>";
        
            while ($row = mysqli_fetch_row($result)){

          /*$Bookname = $row['Bookname'];
          $Authorname = $row['Authorname'];
          $ISBN = $row['ISBN'];
          $Pubdate = $row['Pubdate'];
          $Price = $row['Price'];
          $Introduction = $row['Introduction'];
          $Picture = $row['Picture'];
          $Field = $row['Field'];
          $Organization = $row['Organization'];

          echo "<tr>";
          echo "<td>" . $Bookname . ' </td>
                <td>' . $Authorname. ' </td>
                <td>' . $ISBN . ' </td>
                <td>' . $Pubdate. ' </td>
                <td>' . $Price. ' </td>
                <td>' . $Introduction. ' </td>
                <td style="text-align: center;"><img src="picture/' . $Picture. '"></td>
                <td>' . $Field. ' </td>
                <td>' . $Organization;
          echo "</tr>"; */
              echo "<tr>";
              echo "<td>". $row[1] . ' </td>
                    <td>' . $row[11]. ' </td>
                    <td>' . $row[2].' </td>
                    <td>' . $row[3]. ' </td>
                    <td>NT$' . $row[4]. ' </td>
                   
                
                    <td style="text-align: center;"><img src="picture/' . $row[6]. '"></td>';
                    
              echo "</tr>";      
            }

             echo "</table>";

            mysqli_close($link);
           }
     }


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