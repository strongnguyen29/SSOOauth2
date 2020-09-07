<?php
use \Firebase\JWT\JWT;

if (isset($_POST['btn-submit'])) {
    if (isset($_POST['username']) && isset($_POST['pass'])) {
        if ($_POST['username'] == 'admin' && $_POST['pass'] == '123') {
            // Luu jwt main domain
            
            $jwt = JWT::encode($payload, SECRET);
            
            setcookie(COOKIE_NAME, $jwt, [
                'expires' => time() + 86400,
                'samesite' => 'none'
            ]);

            print_r($jwt);

            redirectToApp($apps, $payload);

            header('location:' . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            $errorMsg = 'Username hoặc pass ko đúng';
        }
    } else {
        $errorMsg = 'Username hoặc pass ko đc trống';
    }
}
?>

<div class="content">
    <?php if (isset($errorMsg)) : ?>
        <p class="msg"><?php echo $errorMsg; ?></p>
    <?php endif ?>
    <form action="" method="post">
        <div class="form-group">
            <label for="userName">User Name:</label>
            <input type="text" name="username" id="userName" required>
        </div>
        <div class="form-group">
            <label for="userPass">Pass:</label>
            <input type="text" name="pass" id="userPass" required>
        </div>
        <div class="form-group">
            <button type="submit" name="btn-submit">Login</button>
        </div>
    </form>
</div>
<style>
    .content {
        width: 992px;
        margin: 50px auto;
    }

    .msg, .form-group {
        margin-bottom: 10px;
    }

    .form-group label {
        display: inline-block;
        width: 150px;
    }

    .form-group input {
        width: 200px;
        margin-top: 5px;
    }
</style>
