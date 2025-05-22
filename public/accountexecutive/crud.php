<?php

// Get parameter types for queries
function getParamTypes($params)
{
    $types = '';
    foreach ($params as $param) {
        if (is_int($param)) {
            $types .= 'i'; // Integer
        } elseif (is_float($param)) {
            $types .= 'd'; // Double
        } elseif (is_string($param)) {
            $types .= 's'; // String
        } else {
            $types .= 'b'; // Blob (rare case)
        }
    }
    return $types;
}

// Secure Query Execution
function executeQuery($query, $params = [])
{
    require 'connect.php';

    $stmt = $connections->prepare($query);

    if ($params) {
        $types = getParamTypes($params);
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();

    // Fetch results for SELECT queries
    if (str_starts_with(trim(strtoupper($query)), "SELECT")) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $data;
    }

    // Return true for non-SELECT queries
    $stmt->close();
    return true;
}

// Fetches the roles in the Database like admin user employee
function getEnumValues($tableName, $columnName)
{
    require 'connect.php';

    // Escape the table name and column name to prevent SQL injection
    $tableName = mysqli_real_escape_string($connections, $tableName);
    $columnName = mysqli_real_escape_string($connections, $columnName);

    // Query to get column details
    $query = "SHOW COLUMNS FROM `$tableName` LIKE '$columnName'";
    $result = mysqli_query($connections, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Extract ENUM values from the 'Type' field
        if (isset($row['Type']) && preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches)) {
            return explode("','", $matches[1]); // Split ENUM values into an array
        } else {
        echo "<script>alert('" . "Error: Column is not of ENUM type." . "');</script>";
        }
    } else {
        echo "<script>alert('" . "Error: Query failed or column not found. Debug info: " . mysqli_error($connections) . "');</script>";
    }

    return []; // Return empty array if no ENUM values found
}

// Sanitizes User Input
function sanitizeInput($field, $type = 'string') {
    $filter = match ($type) {
        'string' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL,
        'int' => FILTER_SANITIZE_NUMBER_INT,
        default => FILTER_SANITIZE_STRING,
    };
    return filter_input(INPUT_POST, $field, $filter);
}


/**************************************************** REUSABLE CRUD ****************************************************/

function create($tableName, $data)
{
    include 'connect.php';

    // Prepare column names and values
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));

    // Build the query
    $query = "INSERT INTO `$tableName` ($columns) VALUES ($placeholders)";
    $stmt = $connections->prepare($query);

    // Bind values dynamically
    $types = str_repeat('s', count($data)); // Assuming all are strings; adjust as needed
    $stmt->bind_param($types, ...array_values($data));

    // Execute the query and return success or error
    if ($stmt->execute()) {
        return [
            'success' => true,
            'message' => 'Record successfully inserted.',
            'insert_id' => $stmt->insert_id // Returns the ID of the inserted record
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Error: ' . $stmt->error
        ];
    }
}
// $createSample = create('sampletable', [
//     'column1' => 'sample_data',
//     'column2' => 'sample_data',
//     'column3' => 'sample_data',
// ]);

function read($tableName, $conditions = [])
{
    include 'connect.php';

    $query = "SELECT * FROM `$tableName`";
    if (!empty($conditions)) {
        $whereClauses = [];
        foreach ($conditions as $column => $value) {
            $whereClauses[] = "`$column` = ?";
        }
        $query .= ' WHERE ' . implode(' AND ', $whereClauses);
    }

    $stmt = $connections->prepare($query);

    if (!empty($conditions)) {
        $types = str_repeat('s', count($conditions));
        $stmt->bind_param($types, ...array_values($conditions));
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        return [
            'success' => true,
            'data' => $result->fetch_all(MYSQLI_ASSOC)
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Error: ' . $stmt->error
        ];
    }
}
// $readSample = "SELECT * FROM sample_tbl";
// $result = executeQuery($readSample);
//
// if (!empty($result)) {   // Display All
//     foreach ($result as $row) {
//         echo "COlumn 1: " . $row['column1'] . " Column 2: " . $row['column2'] . "<br>";
//     }
// } else {
//     echo "No records found.";
// }

function update($tableName, $data, $conditions)
{
    include 'connect.php';

    // Prepare SET clause
    $setClauses = [];
    foreach ($data as $column => $value) {
        $setClauses[] = "`$column` = ?";
    }
    $setQuery = implode(', ', $setClauses);

    // Prepare WHERE clause
    $whereClauses = [];
    foreach ($conditions as $column => $value) {
        $whereClauses[] = "`$column` = ?";
    }
    $whereQuery = implode(' AND ', $whereClauses);

    // Build the query
    $query = "UPDATE `$tableName` SET $setQuery WHERE $whereQuery";
    $stmt = $connections->prepare($query);

    // Bind values dynamically
    $types = str_repeat('s', count($data) + count($conditions));
    $stmt->bind_param($types, ...array_merge(array_values($data), array_values($conditions)));

    if ($stmt->execute()) {
        return [
            'success' => true,
            'message' => $stmt->affected_rows . ' record(s) updated.'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Error: ' . $stmt->error
        ];
    }
}
// $updateSample = "
//     UPDATE user_tbl 
//     SET column1 = ?, column2 - ?
//     WHERE sample_id = ?
// ";
// $params = [$column1, $column2, $sample_id];
// executeQuery($updateQuery, $params);

function delete($tableName, $conditions)
{
    include 'connect.php';

    // Prepare WHERE clause
    $whereClauses = [];
    foreach ($conditions as $column => $value) {
        $whereClauses[] = "`$column` = ?";
    }
    $whereQuery = implode(' AND ', $whereClauses);

    // Build the query
    $query = "DELETE FROM `$tableName` WHERE $whereQuery";
    $stmt = $connections->prepare($query);

    // Bind values dynamically
    $types = str_repeat('s', count($conditions));
    $stmt->bind_param($types, ...array_values($conditions));

    if ($stmt->execute()) {
        return [
            'success' => true,
            'message' => $stmt->affected_rows . ' record(s) deleted.'
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Error: ' . $stmt->error
        ];
    }
}

// $deleteSample = delete('sample_tbl', ['sample_id' => 5]);
