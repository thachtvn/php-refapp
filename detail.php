<?php
    require_once("db.php");
    //Get variable form url
    // $name = isset($_GET['name']) ? $_GET['name'] : '';
    // $function = isset($_GET['function']) ? $_GET['function'] : '';
    // $category = isset($_GET['category']) ? $_GET['category'] : '';
    $select_query = "SELECT * FROM 関数リファレンス WHERE コード='" . $_GET["id"] . "'";
    // $select_query = "SELECT * FROM リファレンス WHERE カテゴリ = '" . $category . "' AND 機能 = '" . $function . "' AND 書式 = '" . $name . "' ";
    
    $result = mysqli_query($conn,$select_query);
    $row = mysqli_fetch_array($result); 
    // $arrListStr = explode(",", $row['パラメータ']);
?>
<html>
<head>
    <title>明細画面</title>
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
        <a href="index.php">ホーム</a>　〉明細画面
    </span>
    <a class="float-right btn btn-primary" href="javascript:window.history.back()">
        戻る
    </a>
</div>
<div class="container">
    <table class="custom-table">
        <tr>
            <td width="20%">カテゴリ</td>
            <td>
                <div class="form-group col-sm-9">
                    <input value="<?php echo $row['カテゴリ']; ?>" class="form-control" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td>クラス名</td>
            <td>
                <div class="form-group col-sm-9">
                    <input value='<?php echo $row['クラス名']; ?>' class="form-control" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td>書式</td>
            <td>
                <div class="form-group col-sm-9">
                <textarea rows="2" class="form-control" readonly="readonly" resize: none><?php echo $row['書式'] ?></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>機能</td>
            <td>
                <div class="form-group col-sm-9">
                    <input value="<?php echo $row['機能']; ?>" class="form-control form-control-lg" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td>パラメータ</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <div class="form-group col-sm-9">
                <textarea rows="5" class="form-control" readonly="readonly" resize: none><?php echo $row['パラメータ'] ?></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>戻り値</td>
            <td>
                <div class="form-group col-sm-9">
                    <input value="<?php echo $row['リターン']; ?>" class="form-control form-control-lg" readonly="readonly">
                </div>
            </td>
        </tr>
        <tr>
            <td>備考</td>
            <td>
                <div class="form-group col-sm-9">
                    <textarea rows="5" class="form-control" readonly="readonly" resize: none><?php echo $row['備考']; ?></textarea>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>