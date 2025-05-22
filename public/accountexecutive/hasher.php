<?php
require_once __DIR__.'/../database/connect.php';

// Hash all users' passwords
// hasher($connections, 'tblname', 'id', 'password');

// Hash password for a single user with ID 2
// hasher($connections, 'tblname', 'id', 'password', 2);

function hasher($connections, $tableName, $idColumn, $passwordColumn, $userId = null) {
    $query = "SELECT $idColumn, $passwordColumn FROM $tableName";
    
    // If a specific user ID is provided, update only that user
    if ($userId !== null) {
        $query .= " WHERE $idColumn = ?";
        $stmt = $connections->prepare($query);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $connections->query($query);
    }

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_id = $row[$idColumn];
            $plainPassword = $row[$passwordColumn];

            // Skip if the password is already hashed
            if (password_needs_rehash($plainPassword, PASSWORD_DEFAULT)) {
                // Hash the plain-text password
                $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

                // Update the database with the hashed password
                $updateQuery = $connections->prepare("UPDATE $tableName SET $passwordColumn = ? WHERE $idColumn = ?");
                $updateQuery->bind_param("si", $hashedPassword, $user_id);
                $updateQuery->execute();
            }
        }
        echo "<script>alert('" . "Password(s) have been hashed successfully!" . "');</script>";
    } else {
        echo "<script>alert('" . "No users found or all passwords are already hashed." . "');</script>";
    }
    
}