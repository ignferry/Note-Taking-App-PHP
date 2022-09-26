<?php require_once "views/components/header.php"?>
<div class="registration-page">
    <form id="registration-form" action="/register" method="post">
        <h2>Sign Up</h2>
        <div class="content">
            <div class="input-field">
                <p><input type="name" id="name" name="name" placeholder="Name" required></p>
            </div>
            <div class="input-field">
                <p><input type="email" id="email" name="email" placeholder="Email Address" required></p>
            </div>
            <div class="input-field">
                <p><input type="password" id="password" name="password" placeholder="Password" required></p>
            </div>
            <div class="input-field">
                <p><input type="submit" id="register" value="Create Account"></p>
            </div>
        </div>
        <div class="sign-in">
            <p>Already have an account? <a href="/login">Sign in</a><p>
        </div>
    </form>
</div>
<?php require_once "views/components/footer.php"?>