<?php
    $protocol = (!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] !== "off")?"https://":"http://";
    $domain = $_SERVER["SERVER_NAME"];
    $server_url = $protocol.$domain."/dashboard/TourAndTravel/core2/public";
    $local_url = $_SERVER["DOCUMENT_ROOT"]."/dashboard/TourAndTravel/core2/public";
    
    include "$local_url/admin/connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Passport</title>
    <link rel="stylesheet" href="<?php echo $server_url."/admin/global/components/global.css"?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
<div class="row">
        <?php
            include $local_url."/admin/global/components/toast.php";
            include $local_url."/admin/global/components/sidebar.php";
        ?>
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="text-center">Upload Passport</h3>
            </div>
            <?php
                include $local_url."/admin/uploadPassport/components/formpage.php";
                include $local_url."/admin/uploadPassport/components/pageButtons.php";
            ?>
        </div>
    </div>
</div>    
</body>
<script type="module" src="<?php echo $server_url."/admin/uploadPassport/script/PageScript.js"?>"></script>
<script type="module" src="<?php echo $server_url."/admin/uploadPassport/script/Request.module.js"?>"></script>
<script type="module" src="<?php echo $server_url."/admin/uploadPassport/script/Form.module.js"?>"></script>
</html>