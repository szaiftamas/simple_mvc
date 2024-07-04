<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
  </head>
  <body>
    <h2>Login</h2>
    <?php if (isset($data['error'])): ?>
      <p><?php echo $data['error']; ?></p>
    <?php endif; ?>
    <form method="post" action="./index.php">
      <input type="text" id="methode" name="methode" style="display: none" value="login"><br>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username"><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password"><br>
      <input type="submit" value="Login">
    </form>
  </body>
</html>

<?php
