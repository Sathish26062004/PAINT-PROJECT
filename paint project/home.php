<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <link rel="stylesheet" href="css/index.css">
  <title>Home</title>
  <style>
    main {
      padding: 20px;
      font-family: 'DUBAI-LIGHT', sans-serif;
      font-size: 20px;
    }
    #Category {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      grid-gap: 20px;
      margin-top: 10px;
    }
    section {
      border: 2px solid black;
      padding: 10px;
    }
    section:hover {
      transform: scale(1.05);
    }
    .view {
      color: blue;
      text-decoration: none;
    }
    .view:hover {
      text-shadow: 0px 0px 3px blue;
    }
  </style>
</head>
<body>
  <?php
    session_start();
    require 'header.php';
    include 'conn.php';
    $active = 'home';
    require 'menu.php';
  ?>
  <main style="padding-inline: 50px;">
    <h2>Order</h2>
    <div id="Category">
      <?php
      $query = "SELECT * FROM `order` WHERE username ='".$_SESSION['username']."'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
      ?>
      <section>
        <p>Order id: <?php echo $row['d_id']; ?></p>
        <p>Art type: <?php echo $row['art_types']; ?></p>
        <p>Amount: <?php echo $row['amount']; ?></p>
        <p>Amount type: <?php echo $row['amount_type'] ?></p>
        <p>Status: <?php echo $row['status']; ?></p>
        <p>Description: <?php echo $row['description']; ?></p>
        <p><a class="view" href="orders.php?order_id=<?php echo $row['d_id'];?>">View</a></p>
      </section>
      <?php
        }
      } else {
      ?>
      <p>No order found</p>
      <?php
      } ?>
    </div>
    <h2 style="margin-top: 30px;">Challenge</h2>
    <div id="Category">
      <?php
      $query = "SELECT * FROM `request` WHERE username ='".$_SESSION['username']."' ORDER BY status";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
      ?>
      <section>
        <p>Order id: <?php echo $row['d_id']; ?></p>
        <p>Status: <?php echo $row['status'] ?></p>
        <p>Description: <?php echo $row['description']; ?></p>
        <p><a class="view" href="challenge.php?order_id=<?php echo $row['d_id']; ?>">View</a></p>
      </section>
      <?php
        }
      } else {
      ?>
      <p>No order found</p>
      <?php
      } ?>
    </div>
  </main>
  <?php
    require 'footer.php';
  ?>
</body>
</html>
