<?php

//Get variable form search
$name = isset($_GET['name']) ? $_GET['name'] : '';
$function = isset($_GET['function']) ? $_GET['function'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

//Create search with category
$searchSQLCategory = '';
if($category!=''){
    $searchSQLCategory = "カテゴリ = '" . $category . "' AND";
}

$checkbox1 = isset($_GET['checkbox1']) ? $_GET['checkbox1'] : '';
$checkbox2 = isset($_GET['checkbox2']) ? $_GET['checkbox2'] : '';
$checkbox3 = isset($_GET['checkbox3']) ? $_GET['checkbox3'] : '';
$checkbox4 = isset($_GET['checkbox4']) ? $_GET['checkbox4'] : '';

//Create search with checkbox value
$searchSQL = '';
if($checkbox1!='' || $checkbox2!=''  || $checkbox3!=''  || $checkbox4!='' ) {
    $searchSQL=" 種類 IN (";
    if($checkbox1!='' ) $searchSQL = $searchSQL . "'変数'" . ", ";
    if($checkbox2!='' ) $searchSQL = $searchSQL . "'構造体'" . ", ";
    if($checkbox3!='' ) $searchSQL = $searchSQL . "'関数'" . ", ";
    if($checkbox4!='' ) $searchSQL = $searchSQL . "'プロパティ'" . ", ";
    $searchSQL = $searchSQL .   " '' ) AND";
}


//Get the current page number
$pageno = isset($_GET['pageno']) ? $_GET['pageno'] : 1;

//Get connect
require_once("db.php");

$sql = "no sql";

if(count($_GET)>0) {

    //Formula paging variable
    $no_of_records_per_page = 25;
    $offset = ($pageno-1) * $no_of_records_per_page;
    
    //Get the number data row  
    // $total_pages_sql = "SELECT COUNT(*) FROM 関数リファレンス WHERE カテゴリ = '" . $category . "' AND 機能 LIKE '%" . $function . "%' AND 書式 LIKE '%" . $name . "%' " . $searchSQL ;
    $total_pages_sql = "SELECT COUNT(*) FROM 関数リファレンス WHERE " . $searchSQLCategory . $searchSQL . " 機能 LIKE '%" . $function . "%' AND 書式 LIKE '%" . $name . "%' " ;
    $result = mysqli_query($conn,$total_pages_sql);
    $row_cnt = mysqli_fetch_array($result)[0];

    //Get the number of total number of pages
    $total_pages = ceil($row_cnt / $no_of_records_per_page);

    //Get data
    $sql = "SELECT * FROM 関数リファレンス WHERE " . $searchSQLCategory .  $searchSQL . " 機能 LIKE '%" . $function . "%' AND 書式 LIKE '%" . $name . "%' ORDER BY カテゴリ, 種類, 書式 LIMIT $offset, $no_of_records_per_page";
    $result = mysqli_query($conn,$sql);

}    
// $sql2 = "SELECT DISTINCT カテゴリ FROM 関数リファレンス";
// $result2 = mysqli_query($conn,$sql2);
?>
<html>
<head>
    <title>関数一覧画面</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="navbar">
    <a href="index.php">一番星V8モジュールリファレンス</a>
</div>
<div class="page-info">
    <span>
        <a href="index.php">ホーム</a>　〉関数一覧画面
    </span>
    <a class="float-right btn btn-primary" href="index.php?category=<?php echo $category; ?>&name=<?php echo $name; ?>&function=<?php echo $function; ?><?php if($checkbox1 != '') echo"&checkbox1=1"; if($checkbox2 != '') echo"&checkbox2=2"; if($checkbox3 != '') echo"&checkbox3=3"; if($checkbox4 != '') echo"&checkbox4=4"; ?>">
        戻る
    </a>
</div>
<div class="container-table">
    <?php
    if(count($_GET)>0) {
        // echo $sql;
        if($row_cnt == 0){
    ?>
        <p class="bg-danger text-white">該当するテータがありません</p>
    <?php
        }
        else{
    ?>
    <table class="table table-bordered table-hover">
        <tr align="center" class="table-secondary">
            <th width="20%" >カテゴリ</th>
            <th width="5%" >種類</th>
            <th width="35%" >関数名</th>
            <th width="35%" >機能</th>
            <th width="5%" ></th>
        </tr>
    <?php
            while($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td align="center"><?php echo $row["カテゴリ"]; ?></td>
            <td align="center"><?php echo $row["種類"]; ?></td>
            <td><?php echo $row["書式"]; ?></td>
            <td><?php echo $row["機能"]; ?></td>
            <td align="center">
                <!-- <a href=detail.php?category=<?php echo $row["カテゴリ"]; ?>&name=<?php echo $row["書式"]; ?>&function=<?php echo $row["機能"]; ?>> -->
                <a href=detail.php?id=<?php echo $row["コード"]; ?>>
                    詳細
                </a>
            </td>

        </tr>
    <?php
            }
    ?>        
    </table>
    <div class="paging-info">
        <span>
            <?php 
            if ($pageno == $total_pages) {
            ?>      
                表示：<?php echo $offset+1; ?>-<?php echo $row_cnt; ?> / <?php echo $row_cnt; ?>件
            <?php    
            }
            else{
            ?>
                表示：<?php echo $offset+1; ?>-<?php echo $offset+$no_of_records_per_page; ?> / <?php echo $row_cnt; ?>件   
            <?php    
            }
            ?>
        </span>
        
        <span class="float-right">  
            <?php 
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>      
                    <a class="btn btn-sm btn-secondary btn-round" href="?category=<?php echo $category; ?>&name=<?php echo $name; ?>&function=<?php echo $function; ?><?php if($checkbox1 != '') echo"&checkbox1=1"; if($checkbox2 != '') echo"&checkbox2=2"; if($checkbox3 != '') echo"&checkbox3=3"; if($checkbox4 != '') echo"&checkbox4=4"; ?>&pageno=<?php echo $i; ?>">
                        <label><?php echo $i; ?></label>
                    </a>
            <?php    
            }
            ?>
        </span>
    </div>    
    <?php
        }
    }
    ?>
</div>
</body>
</html>