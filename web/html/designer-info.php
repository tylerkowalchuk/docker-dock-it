<?php
$pageTitle = "Perfu.ME - Designer Information";

include "includes/header.php";

require_once 'includes/database.php';

$clickedDesigner = $_GET['DesignerID'] ?? '';

?>

<h1 class="d-flex justify-content-center">The Perfumery - Designer Information</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item ms-4 mb-3"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item ms-4 mb-3"><a href="perfumery.php">The Perfumery</a></li>
        <li class="breadcrumb-item active" aria-current="perfumery">Designer Information</li>
    </ol>
</nav>
<?php
$query = "SELECT perfumeID, final__perfumery.Name AS Name, Description, ScentFamilyID, TopNote, MiddleNote, BaseNote,
     Gender, DesignerID, UnitPrice, FluidOunces, final__scentfamily.ScentFamilyName AS ScentFamily, final__designers.Name AS DesignerName
FROM final__perfumery
JOIN final__scentfamily ON final__scentfamily.ScentFamilyID = final__perfumery.ScentFamilyID
JOIN final__designers ON final__designers.DesignerID = final__perfumery.DesignerID
WHERE final__perfumery.DesignerID = '?'";

$stmt = mysqli_prepare($database, $query);
mysqli_stmt_bind_param($stmt, 'i', $clickedDesigner);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $description, $scentFamilyID, $topNote, $middleNote,
    $baseNote, $gender, $designerID, $unitPrice, $fluidOunces, $scentFamilyName, $designerName);


/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);

$totalRows = mysqli_stmt_num_rows($stmt);

echo "<p>$totalRows scents found.</p>";

// if rows are returned, display table
if (mysqli_stmt_num_rows($stmt)):
    ?>
    <br>
    <table class="table table-light table-striped">
        <thead>
        <tr>
            <th>Designer</th>
            <th>Name</th>
            <th>Scent Family</th>
            <th>Description</th>
            <th>Top Note</th>
            <th>Middle Note</th>
            <th>Base Note</th>
            <th>Gender</th>
            <th>Unit Price</th>
            <th>Fl. Oz.</th>
        </tr>
        </thead>

        <?php

        while (mysqli_stmt_fetch($stmt)) {

            echo "<tr>
            <!-- Use primary key when passing to another page -->
            
            <td>$designerName</td>
            <td>$name</td>
            <td>$scentFamilyName</td>
            <td>$description</td>
            <td>$topNote</td>
            <td>$middleNote</td>
            <td>$baseNote</td>
            <td>$gender</td>
            <td>$unitPrice</td>
            <td>$fluidOunces</td>
  

        </tr>";


        }
        ?>
    </table>
<?php
endif;

include "includes/footer.php";

?>


