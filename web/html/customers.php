<?php
$pageTitle = "Perfu.ME - Customers";

include "includes/header.php";

require_once 'includes/database.php';

$sort = $_GET['sort'] ?? 'LastName';
$sort = in_array($sort, ['LastName', 'FirstName']) ? $sort : 'LastName';



?>

    <div class="container-fluid d-flex justify-content-center">
        <div class="container-fluid" id="topImage">

        </div>
    </div>

    <h1 class="d-flex justify-content-center">Customers</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item ms-4 mb-3"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="customers">Customers</li>
        </ol>
    </nav>

<?php
require_once "includes/database.php";
?>
    <form class="d-flex ms-5">
        <input id="search" class="form-control me-2" type="search"
               placeholder="Search by Last Name, First Name, or Email" aria-label="Search">
    </form>
<br>
<br>
    <a href="add-customer.php" class="btn btn-primary ms-5">Add New Customer</a>
<br>
<br>
    <div class="container-md" id="customerResults">

<?php
// query to run on the database
$query = "SELECT CustomerId, FirstName, LastName, Email, Gender, Address, Zipcode
FROM final__customers
ORDER BY $sort";

$stmt = mysqli_prepare($database, $query);
mysqli_stmt_execute($stmt);

/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);

$totalRows = mysqli_stmt_num_rows($stmt);
echo "<p>$totalRows customers found.</p>";

//run again with limit for pagination
$start = $_GET['start'] ?? 0;
$query .= " LIMIT ?, 50";
$stmt = mysqli_prepare($database, $query);
mysqli_stmt_bind_param($stmt, 'i', $start);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $customerID, $firstName, $lastName, $email,
    $gender, $address, $zipcode);

/* store the result in an internal buffer */
mysqli_stmt_store_result($stmt);

// if rows are returned, display table
if (mysqli_stmt_num_rows($stmt)):
    ?>


    <br>
    <table id="customerTable" class="table table-light table-striped">
        <thead>
        <tr>
            <th><a href="?sort=LastName#customerTable">Last Name</a></th>
            <th><a href="?sort=FirstName#customerTable">First Name</a></th>
            <th>Email</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Zipcode</th>
            <th></th>
        </tr>
        </thead>

        <?php

        while (mysqli_stmt_fetch($stmt)) {

            echo "<tr>
            <!-- Use primary key when passing to another page -->
            
            <td>$lastName</td>
            <td>$firstName</td>
            <td>$email</td>
            <td>$gender</td>
            <td>$address</td>
            <td>$zipcode</td>
            <td>
            <a href='edit-customer.php?CustomerId=$customerID' class='btn btn-sm btn-secondary'>Edit</a>
            <a href='delete-customer.php?CustomerId=$customerID' class='btn btn-sm btn-danger'>Delete</a>
            </td>
  

        </tr>";


        }
        ?>
    </table>


    <nav>
        <ul class="pagination">
            <li class="page-item <?= $start == 0 ? 'disabled' : '' ?>">
                <a class="page-link" href="?start=<?= $start - 50 ?>#customerTable">Previous</a>
            </li>

            <?php
            $totalPages = ceil($totalRows / 50);
            for ($page = 1; $page <= $totalPages; $page++) {
                $newStart = (($page - 1) * 50);
                $link = "?start=$newStart#customerTable";

                echo '  <li class="page-item ' . ($start == $newStart ? 'active' : '') . ' ">
                    <a class="page-link" href=" ' . $link . '">' . $page . '</a>
                    </li>';
            }
            ?>
            <li class="page-item <?= $totalRows <= $start + 50 ? 'disabled' : '' ?>">
                <a class="page-link" href="?id=<?= $sort ?>&start=<?= $start + 50 ?>#customerTable">Next</a>
            </li>
        </ul>
    </nav>
    </div>


<?php
endif;

//close the database connection
mysqli_close($database);
?>


    <!--footer include ---->

<?php
include "includes/footer.php" ?>