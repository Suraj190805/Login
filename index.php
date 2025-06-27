<?php
session_start();
$errors = [
  'login' => $_SESSION['login_error'] ??'',
  'register' => $_SESSION['register_error'] ??''
];
$activeForm = $_SESSION['active_form'] ??'login';
session_unset();
function showError($error){
  return !empty($error) ? "<p class = 'error-message'>$error</p>" : '';
}
function isActiveForm($formName,$activeForm){
  return $formName === $activeForm ? 'active':'';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Register</title>
  
<link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    
    <!-- Login Form -->
    <div class = "form-box <?= isActiveForm('login',$activeForm);?> " id="loginForm">
      <h2>Login</h2>
      <?= showError($errors['login']);?>
      <form action="login_register.php" method="post">
        <input type="hidden" name="action" value="login">
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>
      <div class="switch-link">
        Don't have an account? <a onclick="toggleForms()">Register here</a>
      </div>
    </div>

    <!-- Register Form -->
    <div class = "form-box <?= isActiveForm('register',$activeForm);?> hidden" id="registerForm" >
      <h2>Register</h2>
      <?= showError($errors['register']);?>
      <form action="login_register.php" method="post">
        <input type="hidden" name="action" value="register">
        <input type="text" name="name" placeholder="Full Name" required />
        <input type="email" name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <select name="role" required>
          <option value="">Select Role</option>
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
        <button type="submit">Register</button>
      </form>
      <div class="switch-link">
        Already have an account? <a onclick="toggleForms()">Login</a>
      </div>
    </div>

  </div>

  <script>
    function toggleForms() {
      const login = document.getElementById('loginForm');
      const register = document.getElementById('registerForm');
      login.classList.toggle('hidden');
      register.classList.toggle('hidden');
    }
  </script>

</body>
</html>
