<?php
$_SESSION['cars']="";
require_once('db_connect.php');

// query the database using the search term
$sql = "SELECT * FROM tbl_cars, tbl_location";
$sqlC = "SELECT COUNT(Car_ID) FROM tbl_cars";
if (isset($connect)) {
    $result = $connect->query($sql);
    $resultC = mysqli_query($connect, $sqlC);
    $_SESSION['cars'] = mysqli_fetch_array($resultC)[0];
    $_SESSION['cars'] = intval($_SESSION['cars']);
    $html = "";
    if ($result->num_rows > 0) {
        $html .= "<ul>";
        while ($row = $result->fetch_assoc()) {
            $imagePath = str_replace('"', '', $row["CarIMG"]); // remove double quotes from the image path
            $html .= "<li><img src='" . $imagePath . "' width='250' height='150'/>" . "<p>Marka: " . $row["Make"] . "<br>Model: " . $row["Model"] . "<br>Lokalizacja: " . $row["LocationName"] . "</p>";
            if(isset($_SESSION['username'])){ $html .= '<form method="GET" id="rentForm" action="../HTML/rentForm.php"><button type="submit" id="rentButton">Wypożycz</button></form>';};
            $html .="</li>";
        }
        $html .= "</ul>";
    } else {
        $html = "<p>Brak dostępnych aut.</p>";
    }

// output the HTML markup to the page
    echo $html;

// close the database connection
    $connect->close();
}

