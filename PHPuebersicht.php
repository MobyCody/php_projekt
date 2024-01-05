<?php

function getOverviewData($searchTerm = null)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_firmentechnik";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle the form submission and build the SQL query
    if ($searchTerm !== null) {
        $searchTerm = $conn->real_escape_string($searchTerm);
        $sql = "SELECT * FROM tbl_firmentechnik WHERE ProdName LIKE '%$searchTerm%' OR Marke LIKE '%$searchTerm%' OR Kostenstelle LIKE '%$searchTerm%'";
    } else {
        // Default query if no search term
        $sql = "SELECT * FROM tbl_firmentechnik";
    }

    $result = $conn->query($sql);

    // Close the connection
    $conn->close();

    return $result;
}
