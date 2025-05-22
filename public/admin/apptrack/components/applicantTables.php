<div class="container py-2">
    <table class="table table-hover">
        <thead class='fixed'>
            <tr class="table-warning">
                <th scope="row" style="width: 10rem">Application ID</th>
                <th>Passport Number</th>
                <th>Customer Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody class=''>
            <?php
                include $local_url."/admin/apptrack/request/getTableInfo.php";
            ?>
        </tbody>
    </table>
</div>