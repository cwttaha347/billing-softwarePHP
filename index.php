<?php

include 'functions/route.php';


include 'functions/brain.php';

include 'inc/header.php';
if (!isset($_SESSION['user'])) {
    echo '<script>window.location.href="login.php"</script>';
}
?>
<link rel="stylesheet" href="css/fonts.css">
<link rel="stylesheet" href="fonts/all.css">
<link rel="stylesheet" href="fonts/all.min.css">
<link rel="stylesheet" href="fonts/fontawesome.css">
<link rel="stylesheet" href="fonts/fontawesome.min.css">
<div class="main-content">
    <?php
    if (isset($_GET['page'])) {
        include 'inc/main.php';
    }
    ?>

</div>

<?php include 'inc/footer.php'; ?>