<?php

$todoFile = __DIR__ . '/.todolist';

if (!file_exists($todoFile)) {
    die("Todo file not found.");
}

$lines = file($todoFile);
?>
<!DOCTYPE html>
<html>
<head>
    <title>My TODO List</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        label { display: block; margin-bottom: 10px; }
        .done { text-decoration: line-through; color: gray; }
    </style>
</head>
<body>
    <h1>My TODO List</h1>
    <form>
    <?php foreach ($lines as $line): ?>
        <?php
            $trimmed = trim($line);

            if (preg_match('/^- \[( |x)\] (.+)/', $trimmed, $matches)) {
                $checked = $matches[1] === 'x' ? 'checked' : '';
                $text = htmlspecialchars($matches[2]);
                $class = $checked ? 'done' : '';
                echo "<label class='$class'><input type='checkbox' $checked disabled> $text</label>";
            }
        ?>
    <?php endforeach; ?>
    </form>
</body>
</html>
<!--
location /todo {
        alias /var/www/todo/;
        index todo.php;
        try_files $uri $uri/ /todo.php?$args;

        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php8.1-fpm.sock; # adjust version if needed
            fastcgi_param SCRIPT_FILENAME $request_filename;
        }
    }
-->
