<?php

session_start();
 
// Détruisez les variables de session 
$_SESSION = array();
 

 
// Détruisez la session 
session_destroy();
?>
<head>

        <title>Return to index</title>

        <meta http-equiv="refresh" content="0; URL=../FinalApp/index.html">
</head>
<?php
exit;
?>