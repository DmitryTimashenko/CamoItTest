<?php
require_once '../app/views/header.php'
?>
<h1>#3 Top Orders created on a weekday for the last 3 months</h1>
<table>
    <tr>
        <th>#</th>
        <th>Id</th>
        <th>Email</th>
        <th>Date</th>
    </tr>
    <?php
    $i = 1;
    foreach ($data['data'] as $row) {?>
        <tr>
            <td><?=$i ?></td>
            <td><?=$row['id'] ?></td>
            <td><?=$row['email'] ?></td>
            <td><?=$row['date'] ?></td>
        </tr>
    <?php
        $i++;
    } ?>
</table>

<?php
require_once '../app/views/footer.php'
?>
