<?php

include "includes/header.php"
?>

<?php
require_once "includes/database.php";

$lostId = $_POST['lostID'] ?? '';
$name = $_POST['Name'] ?? '';
$description = $_POST['Description'] ?? '';
$status = $_POST['Status'] ?? '';
$lastSeen = $_POST['last_seen'] ?? '';
$contact = $_POST['contact'] ?? '';
?>



<body>


<div class="wrapper">

  <main>


      <?php


      if(isset($_POST['add'])){


          $lostId = intval($lostId);
          $description = strip_tags($description);
          $status = strip_tags($status);
          $lastSeen = strip_tags($lastSeen);
          $contact = strip_tags($contact);




          $query = "INSERT INTO `lost_pets`
           (`lostID`, `Name`, `Description`, `Status`, `last_seen`, `contact`)
           VALUES 
               (NULL, '$name', '$description', '$status', '$lastSeen', '$contact')";


          $result = (@mysqli_query( $db, $query)) or die('Error in query');


          header('Location: lost-pets.php?lostID=' . $lostId);

      }


      ?>



      <form method="post">
          <div>
              <label for="Name" >Name

              </label>
              <input type="text"  id="name" name="Name" required >
              <input type="hidden" name="lostID" >
          </div>

          <div>
              <label for="Description" >Description</label>
              <textarea id="description" name="Description" required></textarea>
          </div>

          <div><label for="Status" >Status</label>
              <input type="text"  id="status" name="Status" required >
          </div>

          <div><label for="last_seen" >Last Seen</label>
              <input type="date"  id="last-seen" name="last_seen" required >
          </div>

          <div><label for="contact" >Contact</label>
              <input type="text"  id="contact" name="contact" required >
          </div>


          <button type="submit" name="add" class="update-btn" >Add New Pet</button>

      </form>




  </main>

</div>

<?php

include "includes/footer.php"
?>

</body>
</html>

