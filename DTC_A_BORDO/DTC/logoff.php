<?php
 session_start();
  session_destroy();
  header('location:login.php');
?>

<script type="text/javascript">
    
    parent.location.href="index.php";
</script>