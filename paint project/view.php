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
    <title>View</title>
    <style>
      main #Category {
        display: grid;
        grid-template-columns: repeat(3, auto);
        grid-template-rows: auto;
        column-gap: 10px;
        row-gap: 10px;
        margin-top: 10px;
      }
      #Category div a {
        text-decoration: none;
        padding-inline: auto;
        padding-block: 5px;
        border: 2px solid black;
      }
      #Category div a:hover {
      background-color: #111;
      color: white;
      }
      #Category div {
        padding: 10px;
        border: 2px solid black;
        background-color: rgba(252, 250, 250, 0.5);
      }
      main {
        padding-block: 20px;
        padding-inline: 10%;
      }
      .link {
        margin-top: 8px;
        margin-inline: auto;
        width: 80%;
        text-align: center;
      }
      .search {
        text-align: center;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <?php
        require 'header.php';
    ?>
    <?php
      $active = 'view';
        require 'menu.php';
      ?>
    <main>
      <section id="Category">
        <?php 
        $query = "SELECT * FROM `order` WHERE username !='".$_SESSION['username']."' AND status='pending' ORDER BY status";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                ?>
                <div>
                        <p>Username:<?php echo $row['username']; ?></p>
                        <p>Art type:<?php echo $row['art_types']; ?></p>
                        <p>Delivery date:<?php echo $row['delivery_date']; ?></p>
                        <p>Amount:<?php echo $row['amount']; ?></p>
                        <p>Amount type:<?php echo $row['amount_type']; ?></p>
                        <p>Description:<?php echo $row['description']; ?></p>
                        <p class="link"><a style="padding:5px;" href="request.php?order_id=<?php echo $row['d_id']; ?>">View</a>
                </div>
                <?php
            }
        } 
        ?>
              </section>
        <?php
        if(mysqli_num_rows($result) == 0)
        {
          ?>
          <p class="display red">No record found</p>
          <?php
        }
        ?>
    </main>
    <?php
        require 'footer.php';
    ?>
  </body>
</html>
