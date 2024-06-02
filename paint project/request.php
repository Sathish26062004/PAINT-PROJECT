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
    <title>Request</title>
    <style>
      main section {
        border: 2px solid black;
        box-shadow: 0px 0px 3px black;
        padding: 3%;
        display: flex;
        flex-direction: column;
        row-gap: 10px;
      }
      main {
        padding-block: 20px;
        padding-inline: 30%;
      }
      p img {
        width: 200px;
        height: 200px;
      }
      .request {
        align-content: center;
        padding: 10px;
        background: blue;
        color: white;
        border: 2px solid black;
        border-radius: 5px;
        width: 40%;
        text-align: center;
        margin-inline: auto;
      }
      .send {
        text-decoration: none;
        color: inherit;
      }
      .request:hover {
        background: white;
        color: black;
      }
      @media (max-width: 600px) {
        main {
          padding-inline: 10%;
        }
      }
    </style>
  </head>
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
     if(isset($_GET['order_id']))
     {
        $query = "SELECT * FROM `order` WHERE d_id = ".$_GET['order_id'];
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
     ?>
     <section>
     <p>Order id:<?php echo $row['d_id']; ?></p>
     <p><img src="uploads/<?php echo $row['user_img']; ?>" alt="user img"/></p>
     <p>Location:<?php echo $row['location'] ?></p>
     <p>Delivery date:<?php echo $row['delivery_date']; ?></p>
        <p>Art type:<?php echo $row['art_types']; ?></p>
        <p>Amount:<?php echo $row['amount']; ?></p>
        <p>Amount type:<?php echo $row['amount_type'] ?></p>
        <?php
        $query2 = "SELECT * FROM `request` WHERE d_id = ".$_GET['order_id']." AND username='".$_SESSION['username']."'";
        $result2 = mysqli_query($conn, $query2);
        if(mysqli_num_rows($result2) != 0) {
          $row2 = mysqli_fetch_array($result2);
          ?>
          <p>You are already <?php echo $row2['status']; ?></p>
          <?php
        } else {
        ?>
        <form method="post" action="#" enctype="multipart/form-data">
          <input name="d_id" value="<?php echo $row['d_id'];?>" style="display: none;"/>
          <p style="margin-bottom: 5px;">Upload QR image for online payment:
            <input  type="file" id="qr_img" name="qr_img" placeholder="QR image" />
          </p>
        <p style="margin-bottom: 10px;">Description: <input style="outline: none; border: 2px solid black; padding: 5px;" type="text" name="description" placeholder="description"/>
        <p class="request"><button style="background: transparent; border: none;" type="submit" class="send">Send request</button></p>
     </form>
     <?php
        }
        ?>
    </section>
    <?php
     }
     ?>
    </main>
    <?php
        require 'footer.php';
    ?>
  </body>
  <?php 
    if(isset($_POST['d_id'])) {
      $target_dir = "qr/";
      $target_file = $target_dir . basename($_FILES["qr_img"]["name"]);
      $message = move_uploaded_file($_FILES['qr_img']['tmp_name'],$target_file);
      $query = "INSERT INTO `request`(d_id, username, status, description, qr) VALUES('".$_POST['d_id']."','".$_SESSION['username']."', 'request', '".$_POST['description']."','".$_FILES['qr_img']['name']."')";
      if(mysqli_query($conn, $query)) {
        ?>
        <script>
          alert('Successfully request sended');
          window.location = 'home.php';
        </script>
        <?php
      }
    }
  ?>
</html>
