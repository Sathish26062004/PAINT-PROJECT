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
    <title>Challenge</title>
    <style>
        
header div {
  border: none;
  border-radius: 0px;
  padding: 0;
}

      main {
        padding-block: 20px;
        padding-inline: 10%;
      }
      .user_img {
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
    </style>
</head>
<body>
<?php
        require 'header.php';
      $active = 'home';
        require 'menu.php';
      ?>
    <main>
    <?php
      $query = "SELECT * FROM `order` WHERE d_id=".$_GET['order_id'];
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_array($result);
      ?>
     <div>
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
     <div id="Category" style="margin-top: 10px;">
      <?php
      $query = "SELECT * FROM `request` WHERE username ='".$_SESSION['username']."' AND d_id='".$_GET['order_id']."' ORDER BY status";
      $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result))
        {
        ?>
      <section>
        <p>Order id:<?php echo $row['d_id']; ?></p>
        <p>Status:<?php echo $row['status'] ?></p>
        <p>Description:<?php echo $row['description']; ?></p>
      </section>
      <?php
        }
        ?>
</main>
</body>
</html>