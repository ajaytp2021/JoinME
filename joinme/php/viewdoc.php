<?php
require 'con.php';
require 'server/server.php';
if($con){
    $file = base64_decode($_GET['filename']);

?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <title><?php echo $file; ?></title>
</head>
<body class="h-100">
<iframe src="../assets/users/docs/files/<?php echo $file; ?>" frameborder="0" class="w-100 h-100"></iframe>
  </div>
</body>
</html>
<?php } ?>