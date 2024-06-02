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
    <title>Order</title>
    <style>
      main #Category {
        display: grid;
        grid-template-columns: repeat(3, auto);
        grid-template-rows: auto;
        column-gap: 10px;
        row-gap: 10px;
        margin-top: 10px;
      }
      #Category p a {
        text-decoration: none;
      }
      #Category p:hover {
      background-color: #111;
      }
      #Category p:hover a {
        color: white;
      }
      #Category p {
        padding: 10px;
        border: 2px solid black;
        background-color: rgba(252, 250, 250, 0.5);
      }
      main {
        padding-block: 20px;
        padding-inline: 10%;
      }
   
    </style>
  </head>
  <body>
    <?php
        require 'header.php';
    ?>
    <?php
      $active = 'order';
        require 'menu.php';
      ?>
    <main>
      <section id="order" class="form">
            <form method="post" action="" enctype="multipart/form-data">
                <h1>Post order</h1>
                <p>
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
                    <label for="art_types">Art types</label>
                    <br>
                    <input required name="art_types" list="art_types" id="art_types" placeholder="Art types" />
                </p>
                <p>
                    <label for="user_img">Upload your image</label>
                    <br>
                    <input  type="file" id="user_img" name="user_img" placeholder="Image" />
                </p>
                <p>
                  <label for="description">Description</label>
                  <br>
                  <input required type="text" id="description" name="description" placeholder="Description"/>
                </p>
                <p>
                    <label for="location">Location</label>
                    <br>
                    <input required type="text" id="location" name="location" placeholder="Location" />
                </p>
                <p>
                    <label for="dd">Delivery date</label>
                    <br>
                    <input required type="date" id="dd" name="dd" placeholder="Delivery date" />
                </p>
                <p>
                    <label for="amount">Amount</label>
                    <br> 
                    <input required type="number" id="amount" name="amount" placeholder="Amount" />
                </p>
                <div class="form-group">
                  <input type="checkbox" id="amount" onchange="money(this)" value="urgent" name="c1">For urgent need<span id="extra_money" style="display: none;">YOU NEED TO PAY RS.200/</span><br>  
                <script>
                function money(e) {
                  if(e.checked) {
                  document.getElementById("extra_money").style.display = "block";
                  } else {
                    document.getElementById("extra_money").style.display = "none";
                  }
                }
                </script>
           
                <p>
                    <datalist id="amt_type">
                      <option value="Online">
                      <option value="Ready cash">
                    </datalist>
                    <label for="amount_type">Online or Ready cash</label>
                    <br>
                    <input required id="amount_type" list="amt_type" name="amount_type" placeholder="Amount type" />
                </p>
                <p class="center">
                            
                  </label>
                    <input type="submit" class="submit" name="upload" placeholder="Upload" value="Upload post"/>
                </p>
            </form>
        </section>
    
        <?php
                 
            
          if(isset($_POST['upload'])) {
            $amount = $_POST['amount'];
            if(isset($_POST['c1'])){
                $amount = $_POST['amount'];
                
                $tomorrow = date('Y-m-d', strtotime('+1 day'));
                
                if ($_POST['dd'] == $tomorrow) {
                    $amount += 200;
                }
    
              }
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["user_img"]["name"]);
            $message = move_uploaded_file($_FILES['user_img']['tmp_name'],$target_file);
            $d_id = mysqli_query($conn, "SELECT MAX(d_id) FROM `order`");
            $result = mysqli_fetch_array($d_id);
            $value = $result["MAX(d_id)"] + 1;
            $upload = "INSERT INTO `order`(`username`,`art_types`,`description`, `user_img`, `location`, `delivery_date`, `amount`, `amount_type`, `d_id`) VALUES 
            ('".$_SESSION['username']."','".$_POST['art_types']."','".$_POST['description']."','".$_FILES['user_img']['name']."','".$_POST['location']."','".$_POST['dd']."',".$amount.",'".$_POST['amount_type']."','".$value."')";
            if(mysqli_query($conn, $upload)) {
              echo "<p class='display green'>successfully ordered</p>";
            }
          }
        ?>
    </main>
    <?php
        require 'footer.php';
    ?>
  </body>
</html>
