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
    <link rel="stylesheet" href="css/form.css"/>
    <title>Search</title>
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
      $active = 'search';
        require 'menu.php';
      ?>
    <main>
      <section id="login" class="form">
            <form method="post" action="">
                <h1>Search</h1>
                <datalist id="art_types">
      <?php
        $art = "SELECT * FROM art";
        if($result = mysqli_query($conn, $art)) {
            foreach($result as $row) {
                ?>
                    <option value="<?= $row['type'] ?>">
                <?php
            }
        }
      ?>
      </datalist>
                <p>
                    <label for="art_type">Art type</label>
                    <br>
                    <input required name="art_type" list="art_types" id="art_type" placeholder="Art type" />
                </p>
                <p>
                    <label for="amount">Amount</label>
                    <br>
                    <input required onchange="amount_num(this)" type="range" value="0" min="0" max="5000" id="amount" name="amount" placeholder="Amount" />
                    <span id="amount_num">0</span>
                </p>
                <p>
                    <label for="amount_type">Amount type</label>
                    <br>
                    <input required name="amount_type" id="amount_type" placeholder="Amount type" />
                </p>
                <p class="center">
                    <input type="submit" class="submit" name="search" placeholder="Search" value="Search"/>
                </p>
            </form>
            <script>
                function amount_num(e) {
                    document.getElementById('amount_num').innerText = e.value;
                }
            </script>
        </section>
        <section id="Category">
        <?php 
        if(isset($_POST['search'])) {
          $art_type = $_POST['art_type'];
          $amount = $_POST['amount'];
          $amount_type = $_POST['amount_type'];
          $query = "SELECT * FROM `order` WHERE art_types='$art_type' AND amount>='$amount' AND amount_type='$amount_type' AND status = 'pending' AND username !='".$_SESSION['username']."'";
          $result = mysqli_query($conn, $query);
          if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)) {
              ?>
              <div>
                      <p>Username:<?php echo $row['username']; ?></p>
                      <p>Art type:<?php echo $row['art_types']; ?></p>
                      <p>Delivery date:<?php echo $row['delivery_date']; ?></p>
                      <p>Amount:<?php echo $row['amount']; ?></p>
                      <p>Amount type:<?php echo $row['amount_type']; ?></p>
                      <p>Description:<?php echo $row['description']; ?></p>
                      <p class="link"><a style="padding: 5px;" href="request.php?order_id=<?php echo $row['d_id']; ?>">View</a>
              </div>
              <?php
            }
          } else {
            ?>
            <p class="display red">Not found anything</p>
            <?php
          }
        }
        ?>
        </section>
    </main>
    <?php
        require 'footer.php';
    ?>
  </body>
</html>
