<?php require __DIR__ . '/parts/connect_db.php' ?>
<?php
$pageName = "order add";
$title = "order add";

// ----------------------------------------------------------------------------
// 現在這筆資料
// $current_sid = $_GET['sid'];
// $current_sql = "SELECT * FROM `order_list` WHERE `sid`= $current_sid";
// $current_row = $pdo->query($current_sql)->fetch();
// print_r($current_row);

// ----------------------------------------------------------------------------
// 取得資料庫中的資料
// 顯示相對應的外鍵內容
$order_rows = [];
$order_sql = "SELECT * FROM `order_list`";
$order_rows = $pdo->query($order_sql)->fetchAll();

$member_rows = [];
$member_sql = "SELECT `sid`, `name` FROM `member`";
$member_rows = $pdo->query($member_sql)->fetchAll();

$order_status_rows = [];
$order_status_sql = "SELECT `sid`, `status` FROM `order_status`";
$order_status_rows = $pdo->query($order_status_sql)->fetchAll();

$order_detail_rows = [];
$order_detail_sql = "SELECT * FROM `order_detail`";
$order_detail_rows = $pdo->query($order_detail_sql)->fetchAll();

$trails_rows = [];
$trails_sql = "SELECT `sid`, `trail_name`, `price` FROM `trails`";
$trails_rows = $pdo->query($trails_sql)->fetchAll();

// ----------------------------------------------------------------------------
// 所有order_sid相同的資料
// $same_order_sid_rows = [];
// $same_order_sid_sql = "SELECT * FROM `order_detail` WHERE `order_sid`=$current_sid";
// $same_order_sid_rows = $pdo->query($same_order_sid_sql)->fetchAll();
// print_r($same_order_sid_rows);

// $this_trail_sid = "";
// $same_trail_rows = [];
// for ($i = 0; $i < count($same_order_sid_rows); $i++) {
//     $this_trail_sid = $same_order_sid_rows[$i]['trails_sid'];
//     // print_r($this_trail_sid);
//     $same_trail_sql = "SELECT `sid`, `trail_name`, `price` FROM `trails` WHERE `sid`=$this_trail_sid";
//     $this_trail_rows = $pdo->query($same_trail_sql)->fetch();
//     array_push($same_trail_rows, $this_trail_rows);
// print_r($same_trail_rows);
// }
// print_r($same_trail_rows);


?>
<?php require __DIR__ . '/parts/html-head.php' ?>
<?php require __DIR__ . '/parts/navbar.php'
?>
<style>
    .th_od {
        width: 100px;
    }
</style>
<div class="container">
    <!-- title -->
    <h3>訂單管理</h3>
    <div class="row mx-1 gap-3 my-3">
        <button class="btn btn-primary w-auto me-auto" onclick="history.back()">上一頁</button>
        <button class="btn btn-danger w-auto">修改</button>
        <button class="btn btn-danger w-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
            刪除
        </button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">刪除訂單</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除此筆訂單ㄇ？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="javascript: fake_delete_it(sid)">
                        <button type="button" class="btn btn-primary">軟刪除</button>
                    </a>
                    <a href="javascript: delete_it(sid)">
                        <button type="button" class="btn btn-primary">硬刪除</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form action="">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th scope="row" class="th_od">會員名稱</th>
                    <td>
                        <input type="text" placeholder="name">
                        <?php // foreach ($member_rows as $m_r) : 
                        ?>
                        <?php // if ($m_r['sid'] === $current_row['member_sid']) {
                        // echo $m_r['name'];
                        //} 
                        ?>
                        <?php // endforeach 
                        ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="th_od">訂購日期</th>
                    <td>
                        <input type="text" placeholder="date">
                        <?php foreach ($order_rows as $o_r) : ?>
                            <?php // if ($o_r['sid'] === $current_row['sid']) {
                            // echo $o_r['order_date'];
                            // } 
                            ?>
                        <?php endforeach ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="th_od">訂單狀態</th>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown button
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a id="status_button" class="dropdown-item" href="#" onclick="selectStatus(1)">Action</a></li>
                                <li><a id="status_button" class="dropdown-item" href="#" onclick="selectStatus(2)">Another action</a></li>
                                <li><a id="status_button" class="dropdown-item" href="#" onclick="selectStatus(3)">Something else here</a></li>
                            </ul>
                        </div>
                        <?php foreach ($order_status_rows as $o_s_r) : ?>
                            <?php // if ($o_s_r['sid'] === $current_row['order_status_sid']) {
                            // echo $o_s_r['status'];
                            // } 
                            ?>
                        <?php endforeach ?>

                    </td>
                </tr>
                <tr>
                    <th scope="row" class="th_od">商品明細</th>
                    <td>
                        <table class="table m-0 p-0 table-borderless">
                            <tbody>
                                <tr>
                                    <th scope="row">#</th>
                                    <td>商品名稱</td>
                                    <td>商品數量</td>
                                    <td>商品價錢</td>
                                    <td>商品總價</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>product name</td>
                                    <td>amount</td>
                                    <td>price</td>
                                    <td style="color: red; font-weight: bold">total price</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="th_od">訂單總價</th>
                    <td>price</td>
                </tr>
                <tr>
                    <th scope="row" class="th_od">備注</th>
                    <td>
                        <?php foreach ($order_rows as $o_r) : ?>
                            <?php // if ($o_r['sid'] === $current_row['sid']) {
                            // echo $o_r['memo'];
                            // } 
                            ?>
                        <?php endforeach ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php require __DIR__ . '/parts/scripts.php' ?>
<script>
    function delete_it(sid) {
        location.href = 'order_detail_delete.php?sid=' + sid;
    }

    function fake_delete_it(sid) {
        location.href = 'order_detail_fake_delete.php?sid=' + sid;
    }

    function selectStatus(status) {
        const statusButton = document.getElementById('dropdownMenuButton1');
        statusButton.innerText = status;
        console.log(status);
    }
</script>
<?php require __DIR__ . '/parts/html-foot.php' ?>