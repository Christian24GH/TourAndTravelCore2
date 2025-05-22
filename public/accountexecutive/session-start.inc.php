<?php
    require_once __DIR__ . 'database/connect.php';

    define('BASE_URL', '/ronron/');

    ini_set('session.cookie_lifetime', 86400);
    session_start();

    /*
    if(!ISSET($_SESSION['username'])){
        ?>
            <form method='POST' onsubmit="return logout('../')" action='<?= BASE_URL ?>/util/process_logout.php'>
                <button type='submit'>Back to Log in Page</button>
            </form>
        <?php
        die("<h1 style='position: relative; top: 40vh; left: 38vw;'>Session expired!</h1>");
    }*/

    $usertbl = 'user_tbl';
    $userid = 'user_id';
    $sql = "SELECT * FROM $usertbl WHERE $userid = {$_SESSION['user_id']}";
    $result = $connections->query($sql);
    if($result && $result instanceof mysqli_result && $result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $_SESSION['user_id'] = $row[$userid];
            $_SESSION['username'] = $row['username'];
            $_SESSION['password'] = $row['password'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['dateofbirth'] = $row['dateofbirth'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['contact_no'] = $row['contact_no'];
            $_SESSION['notes'] = $row['notes'];
            $_SESSION['created_at'] = $row['created_at'];
        }
    }
    // user_tbl
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $gender = $_SESSION['gender'];
    $address = $_SESSION['address'];
    $dateofbirth = $_SESSION['dateofbirth'];
    $role = $_SESSION['role'];
    $email = $_SESSION['email'];
    $contact_no = $_SESSION['contact_no'];
    $notes = $_SESSION['notes'];
    $created_at = $_SESSION['created_at'];