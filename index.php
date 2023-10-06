<?php
// index.php
declare(strict_types = 1);

spl_autoload_register();

use App\Services\Session;

Session::add(Session::COLOR, 'blue');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>$Title$</title>
</head>
<body>
<pre>
    <?php print_r(Session::show()); ?>
</pre>
</body>
</html>
