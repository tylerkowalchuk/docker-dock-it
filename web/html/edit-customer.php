<?php
$pageTitle = "Perfu.ME - Edit Customer";

include "includes/header.php";


$_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? md5(uniqid());

require_once "includes/database.php";

$clickedId = $_GET['CustomerId'] ?? '';


//build query
$query = "SELECT CustomerId, FirstName, LastName, Email, 
       Gender, Address, Zipcode
        FROM final__customers
        WHERE CustomerId = '$clickedId'";

// execute query
$result = mysqli_query($database, $query) or die('Error loading customers.');

// get one record from the database
$customerEdit = mysqli_fetch_array($result, MYSQLI_ASSOC);

// if form was submitted
if (isset($_POST['update'])) {
    if ($_POST['csrf_token'] != $_SESSION['csrf_token']) {
        die('Invalid token.');
    }
    // get values from form
    $customerId = $_POST['CustomerId'] ?? '';
    $firstName = $_POST['FirstName'] ?? '';
    $lastName = $_POST['LastName'] ?? '';
    $email = $_POST['Email'] ?? '';
    $gender = $_POST['Gender'] ?? '';
    $address = $_POST['Address'] ?? '';
    $zipcode = $_POST['Zipcode'] ?? '';


    // strip tags
    $firstName = strip_tags($firstName);
    $lastName = strip_tags($lastName);
    $email = strip_tags($email);
    $gender = strip_tags($gender);
    $address = strip_tags($address);
    $zipcode = strip_tags($zipcode);


    // query to edit record
    $query = "UPDATE `final__customers` SET 
                       `FirstName` = ?, 
                       `LastName` = ?, 
                       `Email` = ?, 
                       `Gender` = ?,
                       `Address` = ?,
                       `Zipcode` = ?
                WHERE `final__customers`.`CustomerId` = ?;";
    $stmt = mysqli_prepare($database, $query) or die('Invalid query');
    mysqli_stmt_bind_param($stmt, 'ssssssi',
        $firstName, $lastName, $email, $gender, $address, $zipcode, $customerId);
    mysqli_stmt_execute($stmt);

    // check if record was edited
    //if(mysqli_affected_rows($database)){
    // redirect
    header('Location: customers.php?');
    //}
}
?>
<div class="container-md">
    <div class="bg-light">
        <form class="form-horizontal ms-4" method="post">
            <div class="form-group">
                <label class="control-label col-sm-2" for="FirstName">First Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?= $customerEdit['FirstName'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="LastName">Last Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="LastName" name="LastName" value="<?= $customerEdit['LastName'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="Email">Email:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Email" name="Email" value="<?= $customerEdit['Email'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="Gender">Gender:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Gender" name="Gender" value="<?= $customerEdit['Gender'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="Address">Address:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Address" name="Address" value="<?= $customerEdit['Address'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="Zipcode">Zipcode:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Zipcode" name="Zipcode" value="<?= $customerEdit['Zipcode'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="visually-hidden" for="CustomerId"></label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="CustomerId" name="CustomerId" value="<?= $customerEdit['CustomerId'] ?>">
                </div>
            </div>
            <br>

            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <button type="submit" name="update" class="btn btn-primary">Update Customer Information</button>


        </form>
    </div>
</div>

<?php
mysqli_close($database);


include "includes/footer.php";