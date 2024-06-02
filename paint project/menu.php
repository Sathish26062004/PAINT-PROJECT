<aside>
    <ul>
        <?php
        if($_SESSION['type'] == 'admin') { ?>
        <li><a href="home1.php" <?php if( $active == 'home') { ?> class="active" <?php } ?>>Home</a></li>
        <?php } else { ?>    <li><a href="home.php" <?php if( $active == 'home') { ?> class="active" <?php } ?>>Home</a></li>
        <?php }    ?>
        <li><a href="order.php" <?php if( $active == 'order') { ?> class="active" <?php } ?>>Order</a></li>
        <li><a href="search.php" <?php if( $active == 'search') { ?> class="active" <?php } ?>>Search</a></li>
<?php        if($_SESSION['type'] != 'admin') { ?>
        <li><a href="view.php" <?php if( $active == 'view') { ?> class="active" <?php } ?>>View</a></li>
        <?php } ?> <li><a href="logout.php">Log Out</a></li>
    </ul>
</aside>


