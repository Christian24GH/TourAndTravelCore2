<?php
    $root = $_SERVER["DOCUMENT_ROOT"] . '/dashboard/TourAndTravel/core2/public';
    include $root.'/admin/connection.php';

    $jsonData = file_get_contents("php://input");

    $data = json_decode($jsonData, true);
    
    $Total = "SELECT COUNT(STATUS) AS Total, (SELECT COUNT(STATUS) FROM application WHERE STATUS = 'waiting') AS Waiting FROM application;";
    $result = $conn->query($Total);
    if($result !== false && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $res[]=[
                "Total"=>$row["Total"],
                "Waiting"=>$row["Waiting"]
            ];
        }
        echo json_encode($res);
    }else{
        echo json_encode(array("status"=>"bad", "message"=>"No Data Found!"));
    }

?>