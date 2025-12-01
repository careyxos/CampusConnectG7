<section id="schedule" class="panel">
    <div class="panel-head">
        <h2>Weekly Schedule</h2>
        <a href="#">Sync calendar</a>
    </div>
    <div class="list compact">
        <?php if (!empty($schedule)): ?>
            <?php foreach ($schedule as $slot): ?>
                <article>
                    <strong><?php echo htmlspecialchars($slot['day']); ?></strong>
                    <div>
                        <p><?php echo htmlspecialchars($slot['subject']); ?> · <?php echo htmlspecialchars($slot['time']); ?></p>
                        <small><?php echo htmlspecialchars($slot['room']); ?></small>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty-state">No schedule entries yet. Add rows to the `schedules` table.</p>
        <?php endif; ?>
    </div>
</section>

