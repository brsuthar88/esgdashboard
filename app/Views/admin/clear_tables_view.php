<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clear Database Tables</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        form { display: inline-block; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input { display: block; margin: 10px auto; padding: 8px; }
        button { background: red; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        button:hover { background: darkred; }
        .message { margin-top: 10px; font-weight: bold; }
    </style>
</head>
<body>

    <h2>Clear Database Tables (Except Admin)</h2>

    <?php if (isset($message)) : ?>
        <p class="message"><?= esc($message) ?></p>
    <?php endif; ?>

    <form method="POST" action="<?= site_url('/private3011/clearTables') ?>">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Clear Database</button>
    </form>

</body>
</html>
