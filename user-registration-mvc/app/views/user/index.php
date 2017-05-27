<header>
  <h3> User Index Page <?= $isLoggedIn ? '[' . $_SESSION['username'] .']' : '' ?> </h3>
</header>
<nav>
  <ul>
    <?php if ( !$isLoggedIn ): ?>
      <li>
        <a href="./login/">Login</a>
      </li>
      <li>
        <a href="./register/">Register</a>
      </li>
    <?php else: ?>
      <li>
        <a href="./logout/">Logout </a>
      </li>
  <?php endif; ?>
  </ul>
</nav>
