<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $local_url = $_SERVER["DOCUMENT_ROOT"]."/dashboard/TourAndTravel/core2/public";
    $connectionPath = realpath("$local_url/admin/connection.php");
    
    if (!$connectionPath || !file_exists($connectionPath)) {
        echo json_encode(["status" => "Error", "message" => "Invalid include path"]);
        exit;
    }
    include $connectionPath;

    header('Content-Type: application/json');

    // Get JSON input and validate
    $jsonString = file_get_contents("php://input");
    $json = json_decode($jsonString, true);

    if ($json === null || json_last_error() !== JSON_ERROR_NONE || empty($json['applicationID']) || !is_numeric($json['applicationID'])) {
        echo json_encode(["status" => "Bad", "message" => "Invalid or missing applicationID"]);
        exit;
    }

    $applicationID = (int) $json['applicationID'];

    // Use prepared statements for security
    $updateQuery = $conn->prepare("UPDATE application SET status = 'approved' WHERE applicationID = ?");
    $updateQuery->bind_param("i", $applicationID);

    if ($updateQuery->execute()) {
        $idResult = $conn->query("SELECT customerID FROM application WHERE applicationID = $applicationID LIMIT 1");
        
        if ($idResult && $row = $idResult->fetch_assoc()) {
            $ticket = 'TourAndTravel' . date('YmdHis') . $row['customerID'];
            $conn->query("INSERT INTO tickets(ticket, customerID) VALUES ('$ticket', {$row['customerID']})");
        }
        
        echo json_encode(["status" => "ok"]);
    }  else {
        echo json_encode(["status" => "Error", "message" => $conn->error]);
    }
?>
