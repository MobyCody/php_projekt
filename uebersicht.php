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
    <div class="search-container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="search-input" id="search-label">Suche:</label>
            <input type="search" id="search-input" name="search" placeholder="Suchbegriff eingeben..." pattern=".*\S.*" required>
            <button type="submit" class="button">Suchen</button>
            <a href="uebersicht.php">
                <button type="button" class="button">Alles anzeigen</button>
            </a>
        </form>
    </div>
    <div class=container>

        <?php
        // Aquire data from database
        include('PHPuebersicht.php');

        // Sorting functionality
        $sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'KaufDatum';
        $sortOrder = isset($_GET['sortOrder']) ? $_GET['sortOrder'] : 'ASC';

        // Handle the form submission and get the result
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
            $result = getOverviewData($_POST["search"], $sortColumn, $sortOrder);
        } else {
            // Default query if no search term
            $result = getOverviewData("", $sortColumn, $sortOrder);
        }

        ?>

        <table>
            <thead>
                <tr>
                    <th>
                        <a href="?sortColumn=ID&sortOrder=<?php echo ($sortColumn === 'ID' && $sortOrder === 'ASC') ? 'DESC' : 'ASC'; ?>">ID</a>
                    </th>
                    <th>
                        <a href="?sortColumn=ProdName&sortOrder=<?php echo ($sortColumn === 'ProdName' && $sortOrder === 'ASC') ? 'DESC' : 'ASC'; ?>">Name</a>
                    </th>
                    <th>
                        <a href="?sortColumn=Marke&sortOrder=<?php echo ($sortColumn === 'Marke' && $sortOrder === 'ASC') ? 'DESC' : 'ASC'; ?>">Marke</a>
                    </th>
                    <th>
                        <a href="?sortColumn=Kostenstelle&sortOrder=<?php echo ($sortColumn === 'Kostenstelle' && $sortOrder === 'ASC') ? 'DESC' : 'ASC'; ?>">Kostenstelle</a>
                    </th>
                    <th>
                        <a href="?sortColumn=Preis&sortOrder=<?php echo ($sortColumn === 'Preis' && $sortOrder === 'ASC') ? 'DESC' : 'ASC'; ?>">Preis</a>
                    </th>
                    <th>
                        <a href="?sortColumn=KaufDatum&sortOrder=<?php echo $sortColumn === 'KaufDatum' && $sortOrder === 'ASC' ? 'DESC' : 'ASC'; ?>">Anschaffungsdatum</a>
                    </th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Generate rows with data or display no data message
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
    </div>
</body>

</html>