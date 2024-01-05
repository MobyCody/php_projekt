<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="Style.css">
    <meta charset="UTF-8">
</head>

<body>
    <div class="logo-container">
        <img src="logo.png" alt="Logo showing coffee mug, pen, and clipboard, pixel art">
    </div>
    <div class="menu">
        <input type="checkbox" id="burger-toggle">
        <label for="burger-toggle" class="burger-menu">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </label>
        <ul>
            <li><a href="anlegen.html">Artikel anlegen</a></li>
            <li><a href="bearbeiten.html">Bearbeiten</a></li>
            <li><a href="uebersicht.php">Übersicht</a></li>
            <li><a href="ueber.html">Über uns</a></li>
        </ul>
    </div>

    <h1>Übersicht</h1>
    <?php include('PHPuebersicht.php'); ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Marke</th>
                <th>Kostenstelle</th>
                <th>Preis</th>
                <th>Anschaffungsdatum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["ProdName"] . "</td>";
                    echo "<td>" . $row["Marke"] . "</td>";
                    echo "<td>" . $row["Kostenstelle"] . "</td>";
                    echo "<td>" . str_replace('.', ',', $row["Preis"]) . " €" . "</td>";
                    $formattedDate = date("d.m.Y", strtotime($row["KaufDatum"]));
                    echo "<td>" . $formattedDate . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php $conn->close(); ?>
</body>

</html>