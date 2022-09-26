<?php require_once "views/components/header.php"?>
<div class="login-page">
    <form id="login-form" action="/login" method="post">
        <h2>Login</h2>
        <div class="content">
            <div class="input-field">
                <p><input type="email" id="email" name="email" placeholder="Email Address" required></p>
            </div>
            <div class="input-field">
                <p><input type="password" id="password" name="password" placeholder="Password" required></p>
            </div>
            <div class="input-field">
                <p><input type="submit" id="login" value="Login"></p>
            </div>
        </div>
        <div class="create-account">
            <p>Not a member? <a href="/register">Create Account</a><p>
        </div>
    </form>
</div>
<?php require_once "views/components/footer.php"?>