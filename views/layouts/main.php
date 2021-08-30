<h1>Test Site</h1>
<div style="display: flex; flex-direction: column;">

    <div style="justify-content: flex-start;display: flex;">

<a href="/">Home</a>
<a href="/contact">Contact</a>

<?php use app\core\Application;

if (Application::$app->session->getFlash('success')):  ?>
    <script>
        alert("<?php echo Application::$app->session->getFlash('success'); ?>");  //alerts. if success
    </script>
<?php endif; ?>
</div>
<!--    --><?php if(Application::isGuest()): ?>
    <div style="display: flex;justify-content: flex-end;">
        <a href="/register">Register</a>
        <a href="/login">login</a>
    </div>
        <?php else: ?>
    <div style="display: flex;justify-content: flex-end;">
        <a href="/profile">Profile</a>
        <p>Welcome, <?php echo Application::$app->user->getDisplayName() ?></p>
        <a href="/logout">Logout</a>
    </div>
    <?php endif; ?>
</div>

{{content}}

