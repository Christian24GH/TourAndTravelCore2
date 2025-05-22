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
    
    class ResponseFormat {
        public ?int $applicationID = null;
        public ?string $note = null;
        public string $status;
        public string $message;
    }

    $jsonString = file_get_contents("php://input");
    $json = json_decode($jsonString, true);
    
    $data = new ResponseFormat();
    
    if ($json === null || json_last_error() !== JSON_ERROR_NONE) {
        $data->status = "Bad";
        $data->message = "Invalid JSON format";
        echo json_encode($data);
        exit;
    }
    
    $data->applicationID = (int)$json["applicationID"] ?? null;
    $data->note = $json["note"] ?? null;
    
    if ($data->applicationID === null || $data->note === null) {
        $data->status = "Bad";
        $data->message = "Invalid data";
        echo json_encode($data);
        exit;
    }

    $rejectionQuery = $conn->prepare("INSERT INTO rejections (applicationID, description) VALUES (?, ?)");
    if (!$rejectionQuery) {
        $data->status = "Error";
        $data->message = "Database error: " . $conn->error;
        echo json_encode($data);
        exit;
    }
    
    $rejectionQuery->bind_param("is", $data->applicationID, $data->note);
    
    if ($rejectionQuery->execute()) {
        $updateQuery = $conn->prepare("UPDATE application SET status = 'rejected' WHERE applicationID = ?");
        if ($updateQuery) {
            $updateQuery->bind_param("i", $data->applicationID);
            $updateQuery->execute();
        }
        $data->status = "ok";
        $data->message = "successful";
    } else {
        $data->status = "Error";
        $data->message = "Database error: " . $rejectionQuery->error;
    }
    
    echo json_encode($data);
?>