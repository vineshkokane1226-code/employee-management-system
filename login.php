<?php
// import header
include_once("./includes/header.php");

if (isset($_POST['btn_submit'])) {

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $error_email = "Email is required!";
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $error_password = "Password is required!";
    }

    if (isset($email) && isset($password)) {

        $connect = new mysqli("localhost", "root", "", "db_employeemanagement");
        $password = md5($password);
        $sql = "SELECT * from tbl_users where email='$email' and password='$password'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            $dashboard = "admin/dashboard.php";
            header("location: $dashboard");
        } else {
            $error_login = "Invalid email or password";
        }
    }
}

?>
<div class="main">
    <div class="auth">
        <h1>Login</h1>
        <form action="" method="post">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Enter Email">
            <?php if (isset($error_email)) { ?>
                <p class='alert alert-danger'>
                    <?php echo $error_email; ?>
                </p>
            <?php } ?>
            <label for="password">Password</label>
            <input type="text" name="password" class="form-control" placeholder="Enter Password">
            <?php if (isset($error_password)) { ?>
                <p class='alert alert-danger'>
                    <?php echo $error_password; ?>
                </p>
            <?php } ?>
            <button type="submit" name="btn_submit" class="btn btn-primary">Login</button>
            <?php if (isset($error_login)) { ?>
                <p class='alert alert-danger'>
                    <?php echo $error_login; ?>
                </p>
            <?php } ?>
        </form>
    </div>
</div>
<?php include_once("./includes/footer.php"); ?>