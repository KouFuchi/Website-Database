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

    <center><h3>修改書系資料</h3></center><br>
    <center>
    <?php

      $conn = mysqli_connect('localhost', '107dba09', '107dba09', '107dba09');

      mysqli_query($conn, 'SET NAMES utf8');
      mysqli_query($conn, 'SET CHARACTER_SET_CLIENT=utf8');
      mysqli_query($conn, 'SET CHARACTER_SET_RESULTS=utf8');
  
      if (empty($_GET)){
       show($conn);

      }else{
     
        if (count($_GET) == 1){  //因為原本的主葉面只有一個修改按鈕
          $SeriesID = $_GET['SeriesID'];
          $sql = "SELECT * FROM Series where SeriesID = $SeriesID";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_row($result);
          list($SeriesID, $Seriesname ) = $row;
     
          echo '<form name="form" action="" method="get">';
          echo '<input type="text" name="SeriesID" value="' . $SeriesID . '" />';  
          echo '<input type="text" name="Seriesname" value="' . $Seriesname . '" />';    
          
          
          echo '<input type="submit" value="確認修改">';
          echo '<br>';
          echo '</form">';

        }else{

          $SeriesID = $_GET['SeriesID']; 
          $Seriesname = $_GET['Seriesname'];
          
         

          $sql = "UPDATE Series SET Seriesname ='$Seriesname' Where SeriesID = $SeriesID";
          $result = mysqli_query($conn, $sql) or die("Update Failed");
          show($conn);
         }
       }
 
      function show($conn){

        $sql = "SELECT * FROM Series";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
  
        echo '<table border="1">';
        echo '<tr><th>SeriesID</th>
                  <th>Seriesname</th>
                  
                 
                  <th>修改</th></tr>';

        while ($row != NULL){
           list($SeriesID, $Seriesname, $Chapterauthor) = $row;
           echo "<tr>";
           echo "<td>$SeriesID</td>";
           echo "<td>$Seriesname</td>";
          
          
           echo "<td><a href=Serie_update.php?SeriesID=$SeriesID>修改</a></td>";
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