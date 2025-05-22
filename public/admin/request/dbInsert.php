<?php

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $root = $_SERVER["DOCUMENT_ROOT"] . '/dashboard/TourAndTravel/core2/public';
    include $root.'/client/connection.php';

    $jsonData = file_get_contents("php://input");

    $data = json_decode($jsonData, true);

    $arr = [
        "passport_type" => $data["passport_type"],
        "country_code" => $data["country_code"],
        "passport_number" => $data["passport_number"], 
        "issued_date" => $data["issued_date"],
        "expiry_date" => $data["expiry_date"],
        "lname" => $data["lname"],
        "fname" => $data["fname"],
        "mname" => $data["mname"],
        "nationality" => $data["nationality"],
        "dateofbirth" => $data["dateofbirth"],
        "gender" => $data["gender"]
    ];

    if($data !== null){
        $stmt = $conn->prepare("CALL insertdb(?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssiisssss",
                            $arr["passport_number"],
                            $arr["passport_type"],
                            $arr["issued_date"],
                            $arr["expiry_date"],
                            $arr["country_code"],
                            $arr["nationality"],
                            $arr["fname"],
                            $arr["mname"],
                            $arr["lname"],
                            $arr["dateofbirth"],
                            $arr["gender"]);
        if($result= $stmt->execute()){
            echo json_encode($arr +=["Result:"=>$result]);
        }else{
            echo json_encode(["Result: "=>$stmt->errorInfo()]);
        }
        $stmt->close();
    }else{
        http_response_code(400);
        echo "Invalid JSON data";
    }
    $conn->close();
?>