<?php
require_once '../app/views/header.php'
?>
<h1>#2 Top Customers without successful orders for the last year</h1>
<table>
    <tr>
        <th>#</th>
        <th>Customer</th>
    </tr>
    <?php
    $i = 1;
    foreach ($data['data'] as $row) {?>
        <tr>
            <td><?=$i ?></td>
            <td><?=$row['firstname'] . ' ' . $row['lastname'] ?></td>
        </tr>
    <?php
        $i++;
    } ?>
</table>

<?php
require_once '../app/views/footer.php'
?>
