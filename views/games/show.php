<?php

$title = htmlspecialchars($game['title']);
ob_start();
?>

<h1><?php echo htmlspecialchars($game['title']); ?></h1>

<table>
    <tr><th>Année</th><td><?php echo $game['release_date']; ?></td></tr>
    <tr><th>Genre</th><td><?php echo $game['genre']; ?></td></tr>
</table>

<p>
    <a href="index.php?page=games">Retour à la liste</a>
</p>

<?php
$content = ob_get_clean();

require __DIR__.'/../layout.php';
