<?php
$pageTitle = "Perfu.ME - Add Customer";

include "includes/header.php";

    $_SESSION['csrf_token'] = $_SESSION['csrf_token'] ?? md5(uniqid());


	require_once "includes/database.php";


// if form was submitted
if (isset($_POST['add'])) {
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


    // query to add record
    $query = "INSERT INTO `final__customers`
                       (`CustomerId`,`FirstName`, `LastName`, `Email`, `Gender`,`Address`,`Zipcode`)
                       VALUES
                        (?,?,?,?,?,?,?);";

    $stmt = mysqli_prepare($database, $query) or die('Invalid query'. mysqli_error($database));

    mysqli_stmt_bind_param($stmt, 'issssss',
        $customerId, $firstName, $lastName, $email, $gender, $address, $zipcode);

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
    <form class="form-horizontal m-4" method="post">
        <div class="form-group">
            <label class="control-label col-sm-2" for="FirstName">First Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="FirstName" name="FirstName">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="LastName">Last Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="LastName" name="LastName">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Email">Email:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Email" name="Email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Gender">Gender:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Gender" name="Gender">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Address">Address:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Address" name="Address">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="Zipcode">Zipcode:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="Zipcode" name="Zipcode">
            </div>
        </div>
 <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <button type="submit" name="add" class="btn btn-primary m-2">Add Customer</button>


    </form>
</div>

</div>
<?php
mysqli_close($database);


include "includes/footer.php";

