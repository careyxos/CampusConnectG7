<header class="portal-header">
    <div class="brand">
        <img src="assets/images/psu.png" alt="Campus logo" width="56" height="56">
        <div>
            <p class="eyebrow">CampusConnect Portal</p>
            <h1>Mobile-ready student workspace</h1>
            <?php if (!empty($_SESSION['user_name'])): ?>
                <p class="muted">Signed in as <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <nav class="primary-nav">
        <a href="#login">Login</a>
        <a href="#dashboard">Dashboard</a>
        <a href="#announcements">Announcements</a>
        <a href="#subjects">Subjects</a>
        <a href="#grades">Grades</a>
        <a href="#schedule">Schedule</a>
        <a href="#support">Support</a>
    </nav>
</header>

