<?php if (isset($_SESSION['flash'])) { ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($_SESSION['flash']); ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php } ?>

<h1>Inscription</h1>

    <form action="index.php?page=auth&action=register" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <label for="name">Nom
            <input type="text" name="name"value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>">
        </label>

        <label for="email">Email
            <input type="email" name="email" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
        </label>
        <label for="password">Mot de passe 
            <input type="password" name="password">
        </label>

        <button type="submit">S'inscrire</button>
    </form>