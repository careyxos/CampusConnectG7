<section id="grades" class="panel">
    <div class="panel-head">
        <h2>Grades</h2>
        <a href="#">Download card</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Midterm</th>
                    <th>Final</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($grades)): ?>
                    <?php foreach ($grades as $grade): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($grade['course']); ?></td>
                            <td><?php echo htmlspecialchars($grade['midterm']); ?></td>
                            <td><?php echo htmlspecialchars($grade['final']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="empty-cell">
                            <?php echo $currentUserId ? 'No grades recorded yet.' : 'Sign in to view personalized grades.'; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

