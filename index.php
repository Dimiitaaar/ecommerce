 <?php

 session_start();

 if (isset($_GET['page'])){
     $page = $_GET['page'];
 } else {
     $page = 'home';
 }

 /* tampon start
    Enclenche le tampon
 */
ob_start();

/* tampon add page */
 switch ($page) {

     case 'home' :
         include "Controller/controllerHome.php";
         break;

     case 'signin' :
         include "Controller/controllerSignin.php";
         break;

     case 'login' :
         include "Controller/controllerLogin.php";
         break;

     case 'product' :
         include "Controller/controllerProduct.php";
         break;

     case 'company' :
         include "Controller/controllerCompany.php";
         break;

     default:
         echo "<br><p>La page '".$page."' n'existe pas !</p>";
         break;

 }

 /* tampon in $content
    Lit, retournes le contenu tampon puis l'efface
 */
 $content = ob_get_clean();

     include "View/template.php";
