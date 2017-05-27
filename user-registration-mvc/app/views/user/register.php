<fieldset>
  <legend>Sign up</legend>
  <form action="" method="POST">
    <ul>
      <li>
        <label for="firstname"> First name: </label>
        <input type="text" id="firstname" name="firstname" value="<?= old('firstname'); ?>">
      </li>
      <li>
        <label for="lastname"> Last name: </label>
        <input type="text" id="lastname" name="lastname" value="<?= old('lastname'); ?>">
      </li>
      <li>
        <label for="username"> Username: </label>
        <input type="text" id="username" name="username" value="<?= old('username'); ?>">
      </li>
      <li>
        <label for="password"> Password: </label>
        <input type="password" id="password" name="password" value="<?= old('password'); ?>">
      </li>
      <li>
        <input type="submit" value="Sign up">
      </li>
    </ul>
    <?php if ( isset($status) ):  ?>
      <p> <?= $status; ?> </p>
    <?php endif; ?>
  </form>
</fieldset>
