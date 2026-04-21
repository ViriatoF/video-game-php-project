<?php
$title = 'Ajouter un jeu';
ob_start();
?>

<h1>Ajouter un film</h1>

<form method="POST" action="index.php?page=games&action=create">

<input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
    <div>
        <label for="title">Titre</label>
        <input type="text" id="title" name="title"
               value="<?php echo htmlspecialchars($old['title'] ?? ''); ?>">
        <?php if (isset($errors['title'])) { ?>
            <p style="color: red"><?php echo $errors['title']; ?></p>
        <?php } ?>
    </div>

    <div>
        <label for="release_date">Date de sortie</label>
        <input type="date" id="release_date" name="release_date"
               value="<?php echo htmlspecialchars($old['release_date'] ?? ''); ?>">
        
        <?php if (isset($errors['release_date'])) { ?>
            <p style="color: red"><?php echo $errors['release_date']; ?></p>
        <?php } ?>
    </div>

    <div>
        <label for="genre">Genre</label>
        
        <select id="genre" name="genre">
            <option value="">-- Sélectionnez un genre --</option>
            
            <option value="Action" <?php echo ($old['genre'] ?? '') === 'Action' ? 'selected' : ''; ?>>
                Action
            </option>
            
            <option value="RPG" <?php echo ($old['genre'] ?? '') === 'RPG' ? 'selected' : ''; ?>>
                RPG
            </option>
            <option value="FPS" <?php echo ($old['genre'] ?? '') === 'FPS' ? 'selected' : ''; ?>>
                FPS
            </option>
            
            <option value="Adventure" <?php echo ($old['genre'] ?? '') === 'Adventure' ? 'selected' : ''; ?>>
                Aventure
            </option>
            
            <option value="Platform" <?php echo ($old['genre'] ?? '') === 'Platform' ? 'selected' : ''; ?>>
                Plateforme
            </option>
            <option value="Simulation" <?php echo ($old['genre'] ?? '') === 'Simulation' ? 'selected' : ''; ?>>
                Simulation
            </option>
            <option value="Strategy" <?php echo ($old['genre'] ?? '') === 'Strategy' ? 'selected' : ''; ?>>
                Stratégie
            </option>
            <option value="Sports" <?php echo ($old['genre'] ?? '') === 'Sports' ? 'selected' : ''; ?>>
                Sports
            </option>
        </select>

        <?php if (isset($errors['genre'])) { ?>
            <p style="color: red"><?php echo $errors['genre']; ?></p>
        <?php } ?>
    </div>

    <button type="submit">Ajouter</button>
    <a href="index.php?page=games&action=list">Annuler</a>
</form>

<?php
$content = ob_get_clean();

require __DIR__.'/../layout.php';
