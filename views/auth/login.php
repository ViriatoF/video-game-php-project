<h1>Connexion</h1>

<?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST" action="index.php?page=auth&action=login">
    <!-- <input type="hidden" name="csrf_token"
           value="<?php echo $_SESSION['csrf_token']; ?>"> -->
    <label for="email">Email
        <input type="email" name="email"
               value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
    </label>
    <label for="password">Mot de passe
        <input type="password" name="password">
    </label>
    <button type="submit">Se connecter</button>
</form>