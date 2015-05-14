<?php
/**
*@author Olivier Peurichard & Etienne Marois
*/

/**
* Disconnect the user and redirects to the home page.
*/
session_start();
 
// Détruisez les variables de session 
$_SESSION = array();
 

 
// Détruisez la session 
session_destroy();
?>
<head>

        <title>Return to index</title>

        <meta http-equiv="refresh" content="0; URL=../vue/index.html">
</head>
<?php
exit;
?>