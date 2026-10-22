<?php

$file = "registrations.csv";

echo "<h1>Registered Students</h1>";

if (file_exists($file)) {

    $handle = fopen($file, "r");

    echo "<table border='1' cellpadding='10'>";

    while (($data = fgetcsv($handle)) !== false) {

        echo "<tr>";

        foreach ($data as $value) {
            echo "<td>" . htmlspecialchars($value) . "</td>";
        }

        echo "</tr>";
    }

    echo "</table>";

    fclose($handle);

} else {

    echo "<p>No records found.</p>";

}

?>
