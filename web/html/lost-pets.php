<?php

include "includes/header.php"
?>

<?php
require_once "includes/database.php";

/**
 * @var $db mysqli

 */
$id = $_GET['lostID'] ?? ' ';
$id =intval($id);
$query = " SELECT * FROM lost_pets WHERE lostID = '$id'";
$result = @mysqli_query($db, $query) or die("Error loading lost pets");
$lost = @mysqli_fetch_array($result, MYSQLI_ASSOC );


?>



<body>


<div class="wrapper">

  <main>

<h1 class="adopt-pet"> Lost Pet Dashboard</h1>


      <?php


      $query ="SELECT lostID, Name, Description, DATE_FORMAT(last_seen, '%M %D %Y') as last_seen, Status, contact
                FROM lost_pets";


      $result = (@mysqli_query( $db, $query)) or die('Error in query');

      ?>

      <table class="lostList">
          <thead>
          <tr>

              <th> Name</th>
              <th>Description</th>
              <th>Last Seen</th>
              <th>Status</th>
              <th>Contact Us</th>
              <th> Edit </th>
              <th> Delete </th>
          </tr>
          </thead>
            <tbody>
          <?php
          while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

              echo '<tr>';
              echo '<th>'   . htmlspecialchars( $row['Name']) .'</th>';
              echo '<th>'   . htmlspecialchars( $row['Description']) .'</th>';
              echo '<th>'   . htmlspecialchars( $row['last_seen']) .'</th>';
              echo '<th>'   .  htmlspecialchars($row['Status']) .'</th>';
              echo '<th>'   . htmlspecialchars($row['contact']) .'</th>';
              echo '<th><a href="edit-lost-pets.php?lostID='.htmlspecialchars($row['lostID']) .'" >'.'Edit'. '</a></th>';
              echo '<th><a href="delete-lost-pets.php?lostID='.htmlspecialchars($row['lostID']) .'" >'. 'Delete'.'</th>';
                echo '</tr>';


          }


          ?>




          </tbody>




      </table>

      <a href="report-pets.php?lostID=<?= $id ?>" class="report-lost-btn" > Report Lost Pet</a>


  </main>

</div>

</body>
</html>

