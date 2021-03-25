<?php
require '../php/server/server.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<ul class="list-group pl-2 position-fixed w-100">
            <li class="p-2 d-flex align-items-center w-100">
              <a <?php if($_SESSION['sidebar']!="home"){?> href="<?php echo $host; ?>/joinme/Admin/dashboard?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebar']=="home"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/home.svg"></img> Home</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebar']!="addskills"){?> href="<?php echo $host; ?>/joinme/Admin/addskills?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none  <?php if($_SESSION['sidebar']=="addskills"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/terminal.svg"></img> Add Skills</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebar']!="logout"){?> href="<?php echo $host; ?>/joinme/php/logout?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none text-secondary"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/power.svg"></img> Logout</a>
            </li>
          </ul>