<?php
session_start();
require __DIR__ . '/config.php';
$templates = require __DIR__ . '/templates/sample-data.php';

$status = $_GET['status'] ?? '';
$messages = [
    'missing' => 'Kindly fill in your email and password.',
    'invalid' => 'Invalid credentials. Please try again.',
    'needname' => 'Add your full name to create a new account.',
    'registered' => 'Account created! You are now signed in.',
    'welcome' => 'Welcome back, you are signed in.',
];
$feedback = $messages[$status] ?? '';
$currentUserId = $_SESSION['user_id'] ?? null;

try {
    $announcementsStmt = $pdo->query("
        SELECT title, body, DATE_FORMAT(COALESCE(highlight_date, created_at), '%b %e') AS display_date
        FROM announcements
        ORDER BY COALESCE(highlight_date, created_at) DESC
        LIMIT 3
    ");
    $announcements = array_map(static fn($row) => [
        'title' => $row['title'],
        'detail' => $row['body'],
        'date' => $row['display_date'],
    ], $announcementsStmt->fetchAll());
} catch (PDOException $e) {
    $announcements = [];
}
if (empty($announcements)) {
    $announcements = $templates['announcements'];
}

try {
    $subjectsStmt = $pdo->query("
        SELECT code, name, units, COALESCE(professor, 'TBA') AS professor
        FROM subjects
        ORDER BY code
    ");
    $subjects = $subjectsStmt->fetchAll();
} catch (PDOException $e) {
    $subjects = [];
}
if (empty($subjects)) {
    $subjects = $templates['subjects'];
}

try {
    if ($currentUserId) {
        $gradesStmt = $pdo->prepare("
            SELECT subjects.code AS course, COALESCE(grades.midterm, '-') AS midterm, COALESCE(grades.final, '-') AS final
            FROM grades
            INNER JOIN subjects ON subjects.id = grades.subject_id
            WHERE grades.student_id = ?
            ORDER BY subjects.code
        ");
        $gradesStmt->execute([$currentUserId]);
        $grades = $gradesStmt->fetchAll();
    } else {
        $grades = [];
    }
} catch (PDOException $e) {
    $grades = [];
}
if (empty($grades)) {
    $grades = $templates['grades'];
}

try {
    $scheduleStmt = $pdo->query("
        SELECT s.day, s.time_range, subj.code AS subject, s.room
        FROM schedules s
        INNER JOIN subjects subj ON subj.id = s.subject_id
        ORDER BY FIELD(s.day, 'Mon','Tue','Wed','Thu','Fri','Sat','Sun'), s.time_range
    ");
    $schedule = array_map(static fn($row) => [
        'day' => $row['day'],
        'time' => $row['time_range'],
        'subject' => $row['subject'],
        'room' => $row['room'],
    ], $scheduleStmt->fetchAll());
} catch (PDOException $e) {
    $schedule = [];
}
if (empty($schedule)) {
    $schedule = $templates['schedule'];
}

$unitsEnrolled = array_sum(array_map(fn($subject) => (int)($subject['units'] ?? 0), $subjects));

$pendingTasks = 0;
$openTickets = 0;
try {
    $pendingTasks = (int)$pdo->query("SELECT COUNT(*) FROM support_requests WHERE status = 'new'")->fetchColumn();
    $openTickets = (int)$pdo->query("SELECT COUNT(*) FROM support_requests WHERE status <> 'resolved'")->fetchColumn();
} catch (PDOException $e) {
    // ignore, keep defaults
}
?>
<?php include __DIR__ . '/partials/head.php'; ?>
<?php include __DIR__ . '/partials/header.php'; ?>

<main class="portal-main">
    <?php include __DIR__ . '/partials/section-login.php'; ?>
    <?php include __DIR__ . '/partials/section-dashboard.php'; ?>
    <?php include __DIR__ . '/partials/section-announcements.php'; ?>
    <?php include __DIR__ . '/partials/section-subjects.php'; ?>
    <?php include __DIR__ . '/partials/section-grades.php'; ?>
    <?php include __DIR__ . '/partials/section-schedule.php'; ?>
    <?php include __DIR__ . '/partials/section-support.php'; ?>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>

