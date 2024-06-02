<?php
    require 'session.php';
    require 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/index.css"/>
    <title>Orders</title>
    <style>
      main {
        padding-block: 20px;
        padding-inline: 10%;
      }
      .user_img, .qr_img {
        width: 200px;
        height: 200px;
      }
      div {
        border: 2px solid black;
        border-radius: 10px;
        padding: 5%;
      }
      div section p {
        display: inline;
      }
      div section:nth-child(1){
        width: 50%;
      }
      .request {
        border: none;
      }
      .request div {
        border: 2px solid black;
        margin-top: 10px;
      }
      .request div p {
        display: block;
      }
      .request div p:nth-child(1) {
        margin-bottom: 10px;
      }
      .accept, .reject {
        border: 2px solid black;
        color: white;
        padding: 5px;
        text-decoration: none;
      }
      .accept {
        background: green;
        margin-right: 10px;
      }
      .reject {
        background: red;
      }
      .accept:hover, .reject:hover {
        background: white;
        color: black;
      }
    
header div {
  border: none;
  border-radius: 0px;
  padding: 0;
}

    </style>
  </head>
  <?php
    if(isset($_GET['status'])) {
      if($_GET['status'] === 'complete') {
        $query = "UPDATE `order` SET status='complete' WHERE d_id='".$_GET['order_id']."'";
        $result = mysqli_query($conn, $query);
        ?>
        <script>
          alert('Successfully completed');
          window.location = 'home.php';
        </script>
        <?php
      } else {
      $query = "UPDATE `request` SET status='".$_GET['status']."' WHERE username='".$_GET['user']."' AND d_id='".$_GET['order_id']."'";
      $result = mysqli_query($conn, $query);
      if($_GET['status'] === 'accept') {
        $query = "UPDATE `request` SET status='reject' WHERE username='".$_GET['user']."' AND d_id='".$_GET['order_id']."' AND status = 'pending'";
        $result = mysqli_query($conn, $query); 
        ?>
        <script>
          alert('Successfully accepted');
          window.location = 'home.php';
        </script>
        <?php
      } else if(isset($_GET['status']) === 'reject') {
        ?>
        <script>
        alert('Successfully rejected');
        </script>
        <?php
      } else {
        ?>
        <script>
        alert('Successfully Cancelled');
        </script>
        <?php
      }
    }
  }
    ?>
  <body>
    <?php
        require 'header.php';
    ?>
    <?php
      $active = 'home';
        require 'menu.php';
      ?>
    <main>
      <?php
      $status = 0; 
      $query = "SELECT * FROM `order` WHERE d_id=".$_GET['order_id'];
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      ?>
     <div>
      <?php
        if($row['status'] == 'complete') {
          $status = 1;
        }
      ?>
        <section>
            <p>Username:</p>
            <p><?php echo $row['username'] ?></p>
        </section>
        <section>
            <p>Description:</p>
            <p?><?php echo $row['description']; ?></p>
      </section>
        <section>
            <p>Art type:</p>
            <p><?php echo $row['art_types'] ?></p>
        </section>
        <section>
          <p>Image:</p>
          <img src="uploads/<?php echo $row['user_img']; ?>" class="user_img" alt="user img"/>
        </section>
        <section>
            <p>Delivery date:</p>
            <p><?php echo $row['delivery_date'] ?></p>
        </section>
        <section>
            <p>Amount:</p>
            <p><?php echo $row['amount'] ?></p>
        </section>
        <section>
            <p>Amount type:</p>
            <p><?php echo $row['amount_type'] ?></p>
        </section>
        <section>
            <p>Status:</p>
            <p><?php echo $row['status'] ?></p>
        </section>
     </div>
     <div class="request">
     <?php
      $query = "SELECT * FROM `request` WHERE d_id='".$_GET['order_id']."' AND status='accept'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result)>0) {
        $r = mysqli_fetch_array($result);
        $query2 = "SELECT `username`, `phone`, `street`, `landmark`, `district`, `state` FROM `signup` WHERE username='".$r['username']."'";
        $result2 = mysqli_query($conn, $query2);
        while($row = mysqli_fetch_array($result2)) {
          ?>
          <div>
            <h2>Artiste Detail</h2>
          <p>username:<?php echo $row['username'] ?></p>
          <p>phone no:<?php echo $row['phone'] ?></p>
          <p>location:<?php echo $row['street'] ?>,
        <br><?php echo $row['landmark'] ?>
      <br><?php echo $row['district'] ?>
    <br><?php echo $row['state'] ?></p>
    <p>QR code for payment:<img class="qr_img" src="qr/<?php echo $r['qr']; ?>" alt="qr code"/></p>
    <?php 
    if($status === 0) {
      ?>
    <p style="margin-top: 10px;"><a href="?user=<?php echo $row['username']; ?>&order_id=<?php echo $_GET['order_id']; ?>&status=complete" class="accept">COMPLETE</a><a href="?user=<?php echo $row['username']; ?>&order_id=<?php echo $_GET['order_id']; ?>&status=reject" class="reject">CANCEL</a></p>
  <?php
    }
    ?>      
  </div>
      <?php
        }
      } else {
      $query = "SELECT * FROM `request` WHERE d_id='".$_GET['order_id']."' AND status='request'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_array($result)) {
          ?>
          <div>
            <p>username:<?php echo $row['username'] ?></p>
            <p>Description:<?php echo $row['description']; ?></p>
            <p style="padding-top: 10px;"><a href="?user=<?php echo $row['username']; ?>&order_id=<?php echo $_GET['order_id']; ?>&status=accept" class="accept">ACCEPT</a>
            <a href="?user=<?php echo $row['username']; ?>&order_id=<?php echo $_GET['order_id']; ?>&status=reject" class="reject">REJECT</a></p>
          </div>
          <?php
        }
      } else {
        ?>
        <p class="display red">No request found</p>
        <?php
      }
    }
      ?>
    </main>
    <?php
        require 'footer.php';
    ?>
  </body>
</html>