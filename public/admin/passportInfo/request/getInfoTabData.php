<?php
$local_url = $_SERVER["DOCUMENT_ROOT"] . "/dashboard/TourAndTravel/core2/public";
include "$local_url/admin/connection.php";
header('Content-Type: application/json');
$decodedData = json_decode(file_get_contents("php://input"), true);
$documentID = $decodedData["documentID"];
$passportNumber = $decodedData["passportNumber"];
$passportID = $decodedData["passportID"];
$applicationID = $decodedData["applicationID"];

$query = "SELECT * FROM getpassportinfo WHERE applicationID = $applicationID AND passportNumber = $passportNumber LIMIT 1;";
$result = $conn->query($query);
$documentquery = "SELECT * FROM getcustomerdocuments WHERE applicationID = $applicationID";
$documentResult = $conn->query($documentquery);
class format
{
    public $applicationID;
    public $passportID;
    public $passportNumber;
    public $applicationStatus;
    public $firstName;
    public $lastName;
    public $dateOfBirth;
    public $documentList = array();
}
if ($result === false) {
    echo json_encode(["error" => "Query failed", "sql" => $query, "db_error" => $conn->error]);
    exit;
}
if ($result != false && $result->num_rows > 0) {
    $data = new format();
    while ($row = $result->fetch_assoc()) {
        $data->applicationID = $row["applicationID"];
        $data->passportID = $row["passportID"];
        $data->passportNumber = $row["passportNumber"];
        $data->applicationStatus = $row["status"];
        $data->firstName = $row["firstName"];
        $data->lastName = $row["lastName"];
        $data->dateOfBirth = $row["dateOfBirth"];
    }
    if ($documentResult->num_rows > 0) {
        while ($row = $documentResult->fetch_assoc()) {
            $document = array(
                "documentID" => $row["documentID"],
                "documentName" => $row["documentName"],
                "documentPath" => $row["documentServerPath"]
            );
            array_push($data->documentList, $document);
        }
    }
    echo json_encode($data);
} else {
    echo json_encode(array("No Data Found"));
}
$conn->close();
