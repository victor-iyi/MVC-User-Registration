
<fieldset>
  <legend> Login Form </legend>
  <form action="" method="POST">
    <ul>
      <li>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= old('username'); ?>">
      </li>
      <li>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?= old('password'); ?>">
      </li>
      <li>
        <input type="submit" value="Login">
      </li>
    </ul>
  </form>
  <?php if ( isset($status) ): ?>
    <p class="error"> <?= $status; ?> </p>
  <?php endif; ?>
</fieldset>
