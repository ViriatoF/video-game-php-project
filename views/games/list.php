<?php

use App\Middleware\AuthMid;

$title = 'Catalogue jeux vidéos';

ob_start(); ?>
<?php $user = AuthMid::currentUser(); ?>

<?php if ($user) { ?>
<p>Bonjour <?php echo htmlspecialchars($user['name']); ?></p>

<h1>Catalogue (<?php echo count($games); ?> Jeux)</h1>
<table>
    <?php foreach ($games as $game) { ?>
        <tr>
            <td><?php echo htmlspecialchars($game['title']); ?></td>
            <td><?php echo htmlspecialchars($game['genre']); ?></td>
            <td><?php echo htmlspecialchars($game['release_date']); ?></td>
    </tr>
    <?php } ?>
</table>

<div>
    <a href="index.php?page=games&action=create">Ajouter un jeu</a>
</div>


<a href="index.php?page=auth&action=logout">Déconnexion</a>

<?php } else { ?>
    <a href="index.php?page=auth&action=login">Connexion</a>
<?php } ?>

<?php
$content = ob_get_clean();

require __DIR__.'/../layout.php';
