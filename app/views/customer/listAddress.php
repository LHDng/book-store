<?php
    $change_add="";
    while($row = mysqli_fetch_array($temp_add_run)){
        $id = $row['address_id'];
        echo "
        <tr>
        <td>$row[address]</td>
        </tr>
        <tr>
        <td>
        <a class='btn btn-primary' href='../../controller/changeAddress_ctl.php?delete_id=$row[address_id]' role='button'>Xóa</a>
        </td>
        </tr>
        ";
        
    }
?>