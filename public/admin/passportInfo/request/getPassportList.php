<?php
    $sql = "SELECT * FROM getpassportlist WHERE status = 'waiting'";
    $result = $conn->query($sql);

    if($result !== false && $result->num_rows > 0){
        $div = "";
        $status = "";
        while($row = $result->fetch_assoc()){
            if($row['status'] == "waiting"){
                $status = "<div class='badge text-bg-primary text-wrap' style='width:6rem;'>Waiting</div>";
            }else if($row['status'] == "approved"){
                $status = "<div class='badge text-bg-success text-wrap' style='width:6rem;'>Approved</div>";
            }else if($row['status'] == "rejected"){
                $status = "<div class='badge text-bg-danger text-wrap' style='width:6rem;'>Rejected</div>";
            }else if($row['status'] == "cancelled"){
                $status = "<div class='badge text-bg-warning text-wrap' style='width:6rem;'>Cancelled</div>";
            }
            $div .="<li class='list-group-item no-hover border border-0 py-2 d-flex justify-content-between' 
                        data-aid='{$row['applicationID']}' 
                        data-did='{$row['documentID']}'
                        data-pid='{$row['passportID']}'
                        data-ppn='{$row['passportNumber']}'>
                            {$row['passportNumber']}
                            {$status}
                        </li>";   
        }
        echo $div;
    }else{
        echo "<div class='bg-secondary-subtle'><div class='text-center text-body-secondary py-2'>No Table Record</div></div>";
    }
    $conn->close();
?>