<section id="login" class="panel form-panel">
    <h2>Secure Login</h2>
    <?php if ($feedback): ?>
        <div class="alert <?php echo in_array($status, ['registered', 'welcome'], true) ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($feedback); ?>
        </div>
    <?php endif; ?>
    <form class="login-form" action="auth.php" method="post">
        <label>
            Full Name (for first-time login)
            <input type="text" name="full_name" placeholder="Juan Dela Cruz">
        </label>
        <label>
            Student Email
            <input type="email" name="student_email" placeholder="you@campus.edu" required>
        </label>
        <label>
            Password
            <input type="password" name="password" placeholder="••••••••" required>
        </label>
        <div class="form-meta">
            <label class="checkbox">
                <input type="checkbox"> Remember me
            </label>
            <a href="#">Forgot password?</a>
        </div>
        <button type="submit" class="btn solid full">Sign in</button>
    </form>
</section>

