<?php
require('stripe-php-master/init.php');

$publishableKey="pk_test_51HQqliJgRJkjjSc4rWb6SgDbddfgdyfQUC5UfzQPsdtB69fYXXMwlMX1CzxqkWvvQ1E8IekZYv2bLFBC2W0gfQFv007BkwASho";

$secretKey="sk_test_51HQqliJgRJkjjSc4UXdd7O9ylpE3iusYcMizJmCvUY6sC2uSebzwiRKFKC9wY3kghLtWviuK4lbhnn9Yxl7Uqcd800szeRnuYq";

\Stripe\Stripe::setApiKey($secretKey);
?>