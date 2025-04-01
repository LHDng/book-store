<?php
    while($row = mysqli_fetch_array($db_account_oder_run)){
        if($row['status'] == 1){
            $status = "Đang xử lý";
        }
        if($row['status'] == 2){
            $status = "Hoàn thành";
        }
        $cost = number_format($row['cost'], 0, ',', '.') . "đ";
        echo "
        <div class='history-status'>
            <div class='status-count'>
                <p class='status'>Trạng thái: $status</p>
            </div>
                <table class='table '>
                    <thead>
                        <tr>
                            <th scope='col'>Mã đơn</th>
                            <th scope='col'>Ngày mua</th>
                            <th scope='col'>Tổng tiền</th>
                            <th scope='col'></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>$row[oder_id]</td>
                            <td>$row[oder_date]</td>
                            <td>$cost</td>
                            <td>
                                <div class='action'>
                                <a href='order-detail.php?oder_id=$row[oder_id]'> <button type='button' class='btn btn-primary'>Chi tiết</button></a>
                                </div>
                            </td>
                            </tr>
                    </tbody>
                </table>
        </div>

        ";
        
    }
?>