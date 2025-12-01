<section id="subjects" class="panel">
    <div class="panel-head">
        <h2>Subjects</h2>
        <a href="#">Checklist</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Subject</th>
                    <th>Units</th>
                    <th>Professor</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($subjects)): ?>
                    <?php foreach ($subjects as $subject): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($subject['code']); ?></td>
                            <td><?php echo htmlspecialchars($subject['name']); ?></td>
                            <td><?php echo htmlspecialchars($subject['units']); ?></td>
                            <td><?php echo htmlspecialchars($subject['professor'] ?? $subject['prof']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-cell">No subjects found. Populate the `subjects` table.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

