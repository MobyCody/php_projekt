<?php

function getOverviewData($searchTerm = null, $sortColumn = "KaufDatum", $sortOrder = "ASC")
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_firmentechnik";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Search functionality
    if ($searchTerm !== null) {
        $searchTerm = $conn->real_escape_string($searchTerm);
        $sql = "SELECT * FROM tbl_firmentechnik 
        WHERE ProdName LIKE '%$searchTerm%' OR 
        Marke LIKE '%$searchTerm%' OR 
        Kostenstelle LIKE '%$searchTerm%'
        ORDER BY $sortColumn $sortOrder";
    } else {
        // Default query if no search term
        $sql = "SELECT * FROM tbl_firmentechnik ORDER BY $sortColumn $sortOrder";
    }

    $result = $conn->query($sql);

    // Close the connection
    $conn->close();

    return $result;
}