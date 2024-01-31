<?php
$pageTitle = "Perfu.ME - Perfumery";

include "includes/header.php";

require_once 'includes/database.php';

$sort = $_GET['sort'] ?? 'Name';

$sort = in_array($sort, ['Designer','Name', 'ScentFamilyName', 'Gender', 'UnitPrice']) ? $sort : 'Designer';

?>
<div class="container-fluid d-flex justify-content-center">
    <div class="container-fluid" id="topImage">

    </div>



</div>

<h1 class="d-flex justify-content-center">The Perfumery</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item ms-4 mb-3"><a href="home.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="perfumery">The Perfumery</li>
    </ol>
</nav>

<?php
require_once "includes/database.php";

// query to run on the database
$query = "SELECT final__perfumery.Name, Description, final__perfumery.ScentFamilyID, Gender, 
       TopNote, MiddleNote, BaseNote, UnitPrice, FluidOunces, final__perfumery.DesignerID, 
       ScentFamilyName, final__designers.Name AS Designer
FROM final__perfumery
JOIN final__scentfamily ON final__scentfamily.ScentFamilyID = final__perfumery.ScentFamilyID
JOIN final__designers ON final__designers.DesignerID = final__perfumery.DesignerID
ORDER BY $sort";

$stmt = mysqli_prepare($database, $query);
mysqli_stmt_execute($stmt);

/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);


$start = $_GET['start'] ?? 0;
$query .= " LIMIT ?, 29";
$stmt = mysqli_prepare($database, $query);
mysqli_stmt_bind_param($stmt, 'i', $start);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $name, $description, $scentFamilyID, $gender, $topNote, $middleNote,
    $baseNote, $unitPrice, $fluidOunces, $designerID, $scentFamilyName, $designer);

/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);



// if rows are returned, display table
if(mysqli_stmt_num_rows($stmt)):
?>
<div class="container-fluid m-4">
<table id="perfumeTable" class="table table-light table-striped">
    <thead>
    <tr>
        <th><a href ="?sort=Designer">Designer</a></th>
        <th><a href ="?sort=Name">Name</a></th>
        <th>Description</th>
        <th><a href ="?sort=ScentFamilyName">Scent Family</a></th>
        <th>Top Note</th>
        <th>Middle Note</th>
        <th>Base Note</th>
        <th><a href ="?sort=Gender">Gender</a></th>
        <th><a href ="?sort=UnitPrice">Price</a></th>
        <th>Fl.Oz</th>
    </tr>
    </thead>

    <?php

    while (mysqli_stmt_fetch($stmt)) {

       echo "<tr>
            <!-- Use primary key when passing to another page -->
            <td><a href =\"designer-info.php?DesignerID=$designerID\">$designer</a></td>
            <td>$name</td>
            <td>$description</td>
            <td>$scentFamilyName</td>
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

</div>

<?php
endif;

//close the database connection
mysqli_close($database);
?>


<!--footer include ---->

<?php
include "includes/footer.php";