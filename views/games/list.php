<?php
$title = 'Catalogue jeux vidéos';

ob_start(); ?>


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

<?php
$content = ob_get_clean();

require __DIR__.'/../layout.php';
