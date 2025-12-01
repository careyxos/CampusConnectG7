<section id="announcements" class="panel">
    <div class="panel-head">
        <h2>Announcements</h2>
        <a href="#">View all</a>
    </div>
    <div class="list">
        <?php if (!empty($announcements)): ?>
            <?php foreach ($announcements as $item): ?>
                <article>
                    <p class="eyebrow"><?php echo htmlspecialchars($item['date']); ?></p>
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p><?php echo htmlspecialchars($item['detail']); ?></p>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="empty-state">No announcements posted yet. Add rows to the `announcements` table.</p>
        <?php endif; ?>
    </div>
</section>

