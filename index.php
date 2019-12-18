<?php require_once(__DIR__.'/includes/top.php'); ?>

<section id="login_form">
    <form action="home.php">
        <input type="text" name="username" class="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="repeatPassword" class="repeat" placeholder="Repeat password">
        <button class="submit">Login</button>
        <div class="change_container">
            <p class="no_user">Dont have a user?</p><button class="change_form">Sign up</button>
        </div>
    </form>
</section>
<script src="js/login.js"></script>
<?php require_once(__DIR__.'/includes/bottom.php'); ?>