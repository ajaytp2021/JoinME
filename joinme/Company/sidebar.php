<?php
require '../php/server/server.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<ul class="list-group pl-2 position-fixed">
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebarc']!="home"){?> href="<?php echo $host; ?>/joinme/Company/home?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebarc']=="home"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/home.svg"></img> Home</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebarc']!="postjob"){?> href="<?php echo $host; ?>/joinme/Company/postjob?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebarc']=="postjob"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/case.svg"></img> Post Job</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebarc']!="basesalary"){?> href="<?php echo $host; ?>/joinme/Company/basesalary?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebarc']=="basesalary"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/currency.svg"></img> Base Salary</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebarc']!="profile"){?> href="<?php echo $host; ?>/joinme/Company/profile?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebarc']=="profile"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/profile.svg"></img> Profile</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebarc']!="logout"){?> href="<?php echo $host; ?>/joinme/Company/logout?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebarc']=="logout"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/power.svg"></img> Logout</a>
            </li>
          </ul>