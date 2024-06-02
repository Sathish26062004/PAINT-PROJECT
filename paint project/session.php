<htmlsephp
    session_start();
    if(!isset($_SESSION['username']))
    {
        ?>
        <script>
        alert("Do not have authorized");
        window.location = 'login.php';
        </script>
        <?php
    }
