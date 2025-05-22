<?php
    function getApplicantInfo(){
        $local_url = $_SERVER["DOCUMENT_ROOT"]."/dashboard/TourAndTravel/core2/public";
        include "$local_url/admin/connection.php";

        $sql = "SELECT * FROM getapplicants";
        $result = $conn->query($sql);
        
        if($result !== false && $result->num_rows > 0){
            $data = [];
            while($row = $result->fetch_assoc()){
                $data[] = [
                        "passportNumber"=>$row["passportNumber"],
                        "passportType"=>$row["passportType"],
                        "dateOfIssue"=>$row["dateOfIssue"],
                        "dateOfExpiry"=>$row["dateOfExpiry"],
                        "country_code"=>$row["country_code"], 
                        "countryName"=>$row["countryName"],
                        "firstName"=>$row["firstName"], 
                        "middleName"=>$row["middleName"], 
                        "lastName"=>$row["lastName"],
                        "dateOfBirth"=>$row["dateOfBirth"], 
                        "gender"=>$row["gender"]
                    ];
            }
            echo json_encode($data);
        }else{
            echo "No Table Record";
        }
    }
    getApplicantInfo();
?>