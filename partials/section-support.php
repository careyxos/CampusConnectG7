<section id="support" class="panel form-panel">
    <h2>Support Request</h2>
    <form class="support-form" action="#" method="post">
        <label>
            Full Name
            <input type="text" name="full-name" placeholder="Juan Dela Cruz" required>
        </label>
        <label>
            Email
            <input type="email" name="email" placeholder="you@campus.edu" required>
        </label>
        <label>
            Concern
            <select name="concern" required>
                <option value="">Select a topic</option>
                <option value="enrollment">Enrollment</option>
                <option value="it">IT Support</option>
                <option value="finance">Finance</option>
                <option value="other">Other</option>
            </select>
        </label>
        <label>
            Details
            <textarea name="message" rows="4" placeholder="Tell us more..." required></textarea>
        </label>
        <button type="submit" class="btn solid full">Send ticket</button>
    </form>
</section>

