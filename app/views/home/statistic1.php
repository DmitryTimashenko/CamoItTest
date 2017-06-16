<?php
require_once '../app/views/header.php'
?>
<h1>#1 Top Customers by total orders sum</h1>
<table>
    <tr>
        <th>#</th>
        <th>Total</th>
        <th>Customer</th>
    </tr>
    <?php
    $i = 1;
    foreach ($data['data'] as $row) {?>
        <tr>
            <td><?=$i ?></td>
            <td><?=$row['total_sum'] ?></td>
            <td><?=$row['firstname'] . ' ' . $row['lastname'] ?></td>
        </tr>
    <?php
        $i++;
    } ?>
</table>

<?php
require_once '../app/views/footer.php'
?>
