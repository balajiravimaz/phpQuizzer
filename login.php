<?php
require_once("config/config.php");
require_once("libraries/Database.php");

if (isset($_POST['signin'])) {
    $errors = [];    
    $required = array('email', 'pass');
    foreach ($required as $field) {
        if ($_POST[$field] == "") {
            $errors[] = ucfirst($field) . ' is required';
        }
    }
    if (empty($errors)) {
        $db = new Database();
        $email = trim($_POST['email']);
        $pass = $_POST['pass'];
        $db->query('SELECT * from users where email =:email');
        $db->bind(":email", $email);
        $data = $db->resultset();
        $result = $db->rowCount();
        if ($result > 0) {
            $password =$data[0]['password'];
            if (password_verify($pass, $data[0]['password'])) {
                $_SESSION['name'] = $data[0]['name'];
                $_SESSION['email'] = $data[0]['email'];
                header("Location: home.php");
            } else {
                $errors[] = "Invalid Password ";
            }
        } else {
            $errors[] = "Invalid Email Id";
        }
    }
}

?>
<div class="container mx-width">
    <?php if (!empty($errors)) {
        foreach ($errors as $err) : ?>
            <p class="text-danger"><?php echo $err;  ?></p>
    <?php endforeach;
    } ?>
    <form id="signup" method="POST">
        <h1 class="h3 mb-3 fw-normal text-center">Please sign to take Quiz</h1>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ""; ?>">
            <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" name="pass" placeholder="Password">
            <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" name="signin" type="submit">Sign in</button>
    </form>
</div>