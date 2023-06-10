<?php
// Include db_connect.php to access the $conn object
require_once('db_connect.php');

// query the database using the search term
$query = $_GET['query'];
$sql = "SELECT * FROM tbl_cars AS c
        INNER JOIN tbl_car_location AS cl ON c.Car_ID = cl.Car_ID
        INNER JOIN tbl_location AS l ON cl.Location_ID = l.Location_ID
        WHERE c.Make LIKE ? OR c.Model LIKE ? OR c.YearOfManufacture LIKE ? OR l.LocationName LIKE ?";

if (isset($connect)) {
    $stmt = $connect->prepare($sql);
    $queryParam = "%$query%";
    $stmt->bind_param("ssss", $queryParam, $queryParam, $queryParam, $queryParam);

    
    $stmt->execute();
    
    $result = $stmt->get_result();

// generate the HTML markup for the rows and store it in a variable
    $search = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $imagePath = str_replace('"', '', $row["CarIMG"]); // remove double quotes from the image path
            $search .= "<li><img src='" . $imagePath . "' width='250' height='150'/>" . "<p>Marka: " . $row["Make"] . "<br>Model: " . $row["Model"] . "<br>Lokalizacja: " . $row["LocationName"] . "<br>Rok produkcji: " . $row["YearOfManufacture"] . "</p>";
            if(isset($_SESSION['username'])){ $search .= '<form method="POST" id="rentForm" action="../HTML/rentForm.php"><button type="submit" id="rentButton">Wypożycz</button></form>';};
            $search .="</li>";
        }
    } else {
        $search = "<p>Brak dostępnych aut.</p>";
    }

// output the HTML markup to the page
    echo $search;

// close the statement and database connection
    $stmt->close();
    $connect->close();
}
