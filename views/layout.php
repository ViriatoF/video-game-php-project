<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? 'Mon site'; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?page=games">Jeux</a>
            <a href="index.php?page=platforms">Plateform</a>
        </nav>
    </header>

    <main><?php echo $content; ?></main>

    <footer>&copy; <?php echo date('Y'); ?> — Mon projet PHP</footer>
</body>
</html>