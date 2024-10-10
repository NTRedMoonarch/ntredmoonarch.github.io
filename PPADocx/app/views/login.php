<?php
$controllerData = include_once '../app/controllers/accController.php';
$error = $controllerData['error'];
?>

<div class="container">
    <h2>Login</h2>
    <?php if (!empty($error)): ?>
    <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="?page=login" method="POST">
        <input type="hidden" name="action" value="login">
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="" disabled selected>Select your role</option>
                <option value="administrator">Administrator</option>
                <option value="coordinator">Coordinator</option>
            </select>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit">Login</button>
    </form>
    <div class="signup-link">
        <p>Don't have an account? <a href="?page=signup">Sign up here</a></p>
    </div>
</div>