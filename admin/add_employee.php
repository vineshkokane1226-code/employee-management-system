<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

if (isset($_POST['btn_add_employee'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $error_name = "Name is required!";
    }

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

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $error_phone = "Phone is required!";
    }

    if (isset($_POST['address']) && !empty($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $error_address = "Address is required!";
    }

    if (isset($_POST['position']) && !empty($_POST['position'])) {
        $position = $_POST['position'];
    } else {
        $error_position = "Position is required!";
    }

    if (isset($_POST['gender']) && !empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $error_gender = "Gender is required!";
    }

    if (isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])) {
        $date_of_birth = $_POST['date_of_birth'];
    } else {
        $error_date_of_birth = "Date of Birth is required!";
    }

    if (isset($_POST['joint_date']) && !empty($_POST['joint_date'])) {
        $joint_date = $_POST['joint_date'];
    } else {
        $error_joint_date = "Joint Date is required!";
    }

    if (isset($_POST['leaved_date']) && !empty($_POST['leaved_date'])) {
        $leaved_date = $_POST['leaved_date'];
    } else {
        $error_leaved_date = "Leaved Date is required!";
    }

    $role = "Employee";
    $status = $_POST['status'];

    if (
        isset($name) &&
        isset($email) &&
        isset($password) &&
        isset($phone) &&
        isset($address) &&
        isset($position) &&
        isset($gender) &&
        isset($date_of_birth) &&
        isset($joint_date) &&
        isset($leaved_date) &&
        isset($role) &&
        isset($status)
    ) {

        $connection = new mysqli("localhost", "root", "", "db_employeemanagement");
        $checkEmailQuery = "SELECT * FROM tbl_users where email='$email'";
        $result = $connection->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            $result_failed = "This email is already in used!";
        } else {
            $password = md5($password);
            $sql = "INSERT INTO tbl_users (name, email, password, phone, address, gender, role, position, joint_date, leaved_date, date_of_birth, status) 
                    VALUES ('$name', '$email', '$password', '$phone', '$address', '$gender', '$role', '$position', '$joint_date', '$leaved_date', '$date_of_birth', $status)";
            $connection->query($sql);

            if ($connection->insert_id > 0) {
                $result_success = "New employeee added successfully!";
            }
        }
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Add Employee</h1>
    </div>
    <div class="body-panel">
        <?php if (isset($result_success)) { ?>
            <p class="alert alert-success">
                <?php echo $result_success; ?>
            </p>
        <?php } ?>
        <?php if (isset($result_failed)) { ?>
            <p class="alert alert-danger">
                <?php echo $result_failed; ?>
            </p>
        <?php } ?>
        <form action="" method="POST" class="add-employee-form">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Name :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                    </div>
                </div>
                <?php if (isset($error_name)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_name; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Email :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                </div>
                <?php if (isset($error_email)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_email; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Password :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                </div>
                <?php if (isset($error_password)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_password; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Phone :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone">
                    </div>
                </div>
                <?php if (isset($error_phone)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_phone; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Address :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="address" class="form-control" placeholder="Enter Address">
                    </div>
                </div>
                <?php if (isset($error_address)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_address; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Position :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="position" class="form-control" placeholder="Enter Position">
                    </div>
                </div>
                <?php if (isset($error_position)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_position; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Birth Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="date_of_birth" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_date_of_birth)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_date_of_birth; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Gender :</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                <?php if (isset($error_gender)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_gender; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Joint Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="joint_date" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_joint_date)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_joint_date; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Leaved Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="leaved_date" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_leaved_date)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_leaved_date; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Status :</label>
                    </div>
                    <div class="col-sm-9 status-container">
                        <div>
                            <label for="active" class="status">
                                <input type="radio" id="active" name="status" value="1" checked> Active
                            </label>
                        </div>
                        <div>
                            <label for="deactive" class="status">
                                <input type="radio" id="deactive" name="status" value="0"> Deactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_add_employee" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Add Employee
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>