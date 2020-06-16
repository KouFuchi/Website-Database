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

    <center><h3>增刪章節資料</h3></center><br>

    <?php

      $conn = mysqli_connect('localhost','107dba09','107dba09','107dba09');   
    
      mysqli_query($conn, 'SET NAMES utf8');
      mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
      mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8'); 
       // if (!isset($_GET['id'])){
      if (empty($_GET)){

       show($conn);

      }else if (count($_GET)==1){

        $ChapterID = $_GET['ChapterID'];
        $sql = "Delete from Chapters where ChapterID = $ChapterID  ";
        $result = mysqli_query($conn, $sql) or die("刪除失敗".mysqli_error($conn));
        show($conn);

       }else{

          $ChapterID = $_GET['ChapterID'];
          $Chaptername = $_GET['Chaptername'];
          $Chapterauthor = $_GET['Chapterauthor'];
          
          $sql = "Insert into Chapters values($ChapterID, '$Chaptername', '$Chapterauthor')";
          $result = mysqli_query($conn, $sql) or die("新增失敗".mysqli_error($conn));
          show($conn);
        }
  
      function show($conn){

        $sql =" select * from Chapters";
        $result = mysqli_query($conn, $sql);
  
        $row = mysqli_fetch_row($result);
        echo " <form action='' method='get'>";
        echo "<center>";
        echo "編號<input type=text name=ChapterID >&nbsp;&nbsp;";
        echo "章節<input type=text name=Chaptername >&nbsp;&nbsp;";
        echo "作者<input type=text name=Chapterauthor >&nbsp;&nbsp;";
       
        echo " <input type=submit value=新增>";
        echo "</form><br><br>";
  
        $sql = " select * from Chapters";
        $result = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($result);
        echo "<center>";
        echo '總共有'.$total.'筆資料';
        echo "<br><br>";

        $row = mysqli_fetch_row($result);
  
        echo '<table border="1">';
        echo '<tr><th>編號</th>
                  <th>章節</th>
                  <th>作者</th>
                
                  <th>刪除</th></tr>';

        while ($row != NULL){

          list($ChapterID, $Chaptername, $Chapterauthor) = $row;
          echo "<tr>";
          echo "<td>$ChapterID</td>";
          echo "<td>$Chaptername</td>";
          echo "<td>$Chapterauthor</td>";
          
          echo "<td><a href=Chapter_inde.php?ChapterID=$ChapterID>刪除</a></td>";
          echo "</tr>";
          $row = mysqli_fetch_row($result); 
        }
       }
     ?> 


    </center>
    
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