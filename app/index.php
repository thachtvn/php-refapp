<?php

//Get variable form search
$name = isset($_GET['name']) ? $_GET['name'] : '';
$function = isset($_GET['function']) ? $_GET['function'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$checkbox1 = isset($_GET['checkbox1']) ? $_GET['checkbox1'] : '';
$checkbox2 = isset($_GET['checkbox2']) ? $_GET['checkbox2'] : '';
$checkbox3 = isset($_GET['checkbox3']) ? $_GET['checkbox3'] : '';
$checkbox4 = isset($_GET['checkbox4']) ? $_GET['checkbox4'] : '';

//Get connect
require_once("db.php");
   
$sql2 = "SELECT DISTINCT カテゴリ FROM 関数リファレンス ORDER BY カテゴリ";
$result2 = mysqli_query($conn,$sql2);
?>
<html>
<head>
    <title>検索画面</title>
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
        <a href="index.php">ホーム</a>　〉検索画面
    </span>
</div>
<div class="container">
    <form action="./list.php" method="get">
        <table class="custom-table">
            <tr>
                <td width="15%"><label>カテゴリ</label></td>
                <td>
                    <div class="form-group col-sm-9">
                        <select class="form-control" name="category">
                            <option value=""></option>
                        <?php
                                while($row2 = mysqli_fetch_array($result2)) {
                        ?>
                            <option value="<?php echo $row2["カテゴリ"]; ?>"  <?php if($row2["カテゴリ"] == $category) echo"selected"; ?>>
                                <?php echo $row2["カテゴリ"]; ?>
                            </option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label>種類</label></td>
                <td>
                    <div class="col-sm-9">
                        <label class="checkbox-inline"><input class="checkbox" name="checkbox1" type="checkbox" value="1" <?php if($checkbox1 != '') echo"checked"; ?>>&nbsp;変数&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <label class="checkbox-inline"><input class="checkbox" name="checkbox2" type="checkbox" value="2" <?php if($checkbox2 != '') echo"checked"; ?>>&nbsp;構造体&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <label class="checkbox-inline"><input class="checkbox" name="checkbox3" type="checkbox" value="3" <?php if($checkbox3 != '') echo"checked"; ?>>&nbsp;関数&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <label class="checkbox-inline"><input class="checkbox" name="checkbox4" type="checkbox" value="4" <?php if($checkbox4 != '') echo"checked"; ?>>&nbsp;プロパティ</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label>関数名</label></td>
                <td>
                    <div class="form-group col-sm-9">
                        <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" >
                    </div>
                </td>
            </tr>
            <tr>
                <td><label>機能</label></td>
                <td>
                    <div class="form-group col-sm-9">
                        <input class="form-control" type="text" name="function" value="<?php echo $function; ?>" >
                    </div>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <div class="form-group col-sm-9">
                        <input class="btn btn-primary" type="submit" value="検索" class="btnSubmit"></td>
                    </div>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>