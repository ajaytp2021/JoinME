<?php
require '../php/server/server.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<ul class="list-group pl-2 position-fixed">
            
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="home"){?> href="<?php echo $host; ?>/joinme/User/home?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebaru']=="home"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/home.svg"></img> Home</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="currentwork"){?> href="<?php echo $host; ?>/joinme/User/currentwork?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebaru']=="currentwork"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/case.svg"></img> My Current Work</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="requests"){?> href="<?php echo $host; ?>/joinme/User/requestedjobs?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebaru']=="requests"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/request.svg"></img> My Job Requests</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="profile"){?> href="<?php echo $host; ?>/joinme/User/profile?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebaru']=="profile"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/profile.svg"></img> Profile</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="addskills"){?> href="<?php echo $host; ?>/joinme/User/addskills?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebaru']=="addskills"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/terminal.svg"></img> Add Skills</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="documents"){?> href="<?php echo $host; ?>/joinme/User/documents?rawvalue=<?php echo $val;?>"<?php } ?> class="text-decoration-none <?php if($_SESSION['sidebaru']=="documents"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/docs.svg"></img> Documents</a>
            </li>
            <li class="p-2 d-flex align-items-center">
              <a <?php if($_SESSION['sidebaru']!="logout"){?> href="<?php echo $host; ?>/joinme/User/logout?rawvalue=<?php echo $val;?>"<?php } ?>  class="text-decoration-none <?php if($_SESSION['sidebaru']=="logout"){ echo 'text-dark'; }else{ echo 'text-secondary'; } ?>"><img class="img-fluid pr-2" alt="quixote" src="<?php echo $host; ?>/joinme/assets/images/icons/power.svg"></img> Logout</a>
            </li>
          </ul>