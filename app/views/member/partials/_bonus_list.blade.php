<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Tên hoa hồng</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bonus as $b): ?>
            <tr>
                <td><?php echo $b['name']; ?></td>
                <td><?php echo $b['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>