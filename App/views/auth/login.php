<?php require_once "views/components/header.php"?>
<div class="login-page">
    <form action="/login" method="post">
        <h2>Login</h2>
        <div class="content">
            <div class="input-field">
                <input type="email" id="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="action">
            <button type="submit">Login</button>
        </div>
        <div class="create-account">
            <p>Not a member? <a href="/register">Create Account</a><p>
        </div>
    </form>
</div>
<?php require_once "views/components/footer.php"?>