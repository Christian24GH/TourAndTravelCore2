<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $root = $_SERVER["DOCUMENT_ROOT"] . '/dashboard/TourAndTravel/core2/public';
    $connectionPath = realpath($root . '/admin/connection.php');

    if (!$connectionPath || !file_exists($connectionPath)) {
        echo json_encode(["status" => "error", "message" => "Database connection file not found!"]);
        exit;
    }

    include $connectionPath;
    header("Content-Type: application/json");

    if (!isset($_FILES["Input_file_passport"]) || empty($_FILES["Input_file_passport"]["tmp_name"])) {
        echo json_encode(["status" => "error", "message" => "No file uploaded!"]);
        exit;
    }

    $targetDir = $root . "/server/documents/";
    $fileName = time() . "_" . basename($_FILES["Input_file_passport"]["name"]); // Unique file name
    $targetFile = $targetDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo json_encode(["status" => "error", "message" => "Invalid file type!"]);
        exit;
    }

    if (!move_uploaded_file($_FILES["Input_file_passport"]["tmp_name"], $targetFile)) {
        echo json_encode(["status" => "error", "message" => "Error saving file!"]);
        exit;
    }

    // Validate required POST parameters
    $requiredFields = [
        'passport_type', 'passport_number', 'issued_date', 'expiry_date',
        'customer_id',
    ];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty(trim($_POST[$field]))) {
            echo json_encode(["status" => "error", "message" => "Missing or invalid data: $field"]);
            exit;
        }
    }

    // Prepare data
    $passport_type = trim($_POST['passport_type']);
    $passport_number = trim($_POST['passport_number']);
    $issued_date = trim($_POST['issued_date']);
    $expiry_date = trim($_POST['expiry_date']);
    $customer_id = trim($_POST['customer_id']);

    // Prepared statement
    $insertstmt = $conn->prepare("CALL insertApplication(?,?,?,?,?,?,?)");

    if (!$insertstmt) {
        echo json_encode(["status" => "error", "message" => "Prepare statement failed!", "error" => $conn->error]);
        exit;
    }

    // Bind parameters
    $insertstmt->bind_param(
        "issssss",
        $customer_id,  
        $fileName, 
        $targetFile,  // Use correct variable for file path
        $passport_number, 
        $passport_type, 
        $issued_date, 
        $expiry_date
    );

    // Execute and handle response
    if ($insertstmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Data inserted successfully!"]);
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Database insert failed!", 
            "error" => $insertstmt->error
        ]);
    }

    // Debugging Logs
    error_log(print_r($_FILES, true));
    error_log(print_r($_POST, true));

?>
