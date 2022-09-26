<?php require_once "views/components/header.php"?>
<div class="registration-page">
    <form>
        <h2>Sign Up</h2>
        <div class="content">
            <div class="input-field">
                <input type="name" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="input-field">
                <input type="email" id="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="input-field">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <div class="action">
            <button>Create Account</button>
        </div>
        <div class="sign-in">
            <p>Already have an account? <a href="/login">Sign in</a><p>
        </div>
    </form>
</div>
<?php require_once "views/components/footer.php"?>