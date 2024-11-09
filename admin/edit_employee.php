<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch signle employee data
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_users where id= $get_id";
$fetch_result = $connection->query($fetch_query);
if ($fetch_result->num_rows > 0) {
    $employee = $fetch_result->fetch_assoc();
} else {
    header("location: list_employee.php");
}


if (isset($_POST['btn_edit_employee'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = $employee['password'];
    }

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $email = $employee['email'];
    }

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password = md5($_POST['password']);
    } else {
        $password = $employee['password'];
    }

    if (isset($_POST['phone']) && !empty($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $phone = $employee['phone'];
    }

    if (isset($_POST['address']) && !empty($_POST['address'])) {
        $address = $_POST['address'];
    } else {
        $address = $employee['address'];
    }

    if (isset($_POST['position']) && !empty($_POST['position'])) {
        $position = $_POST['position'];
    } else {
        $position = $employee['position'];
    }

    if (isset($_POST['gender']) && !empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $gender = $employee['gender'];
    }

    if (isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])) {
        $date_of_birth = $_POST['date_of_birth'];
    } else {
        $date_of_birth = $employee['date_of_birth'];
    }

    if (isset($_POST['joint_date']) && !empty($_POST['joint_date'])) {
        $joint_date = $_POST['joint_date'];
    } else {
        $joint_date = $employee['joint_date'];
    }

    if (isset($_POST['leaved_date']) && !empty($_POST['leaved_date'])) {
        $leaved_date = $_POST['leaved_date'];
    } else {
        $leaved_date = $employee['leaved_date'];
    }

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
        isset($status)
    ) {
        // if email is match to previous email then skip to update
        if ($employee['email'] == $email) {
            $update_query = "UPDATE tbl_users SET name = '$name', password = '$password', phone = '$phone', address = '$address', gender = '$gender', position = '$position', joint_date = '$joint_date', leaved_date = '$leaved_date', date_of_birth = '$date_of_birth', status = $status WHERE id = $get_id";
        } else {

            // check new email is already exist or not
            $checkEmailQuery = "SELECT * FROM tbl_users where email='$email'";
            $resultCheckEmailQuery = $connection->query($checkEmailQuery);

            if ($resultCheckEmailQuery->num_rows > 0) {
                $result_failed = "This email is already in used!";
            } else {
                $update_query = "UPDATE tbl_users SET name = '$name', email = '$email', password = '$password', phone = '$phone', address = '$address', gender = '$gender', position = '$position', joint_date = '$joint_date', leaved_date = '$leaved_date', date_of_birth = '$date_of_birth', status = $status WHERE id = $get_id";
            }
        }

        $connection->query($update_query);

        if ($connection->affected_rows > 0) {
            $result_success = "Employeee updated successfully!";
        } else {
            $result_success = "No changes were made.";
        }

        $updated_fetch_query = "SELECT * FROM tbl_users where id= $get_id";
        $updated_fetch_result = $connection->query($updated_fetch_query);
        $employee = $updated_fetch_result->fetch_assoc();
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Edit Employee</h1>
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
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $employee['name']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Email :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $employee['email']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>New Password :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Phone :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone" value="<?php echo $employee['phone']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Address :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="address" class="form-control" placeholder="Enter Address" value="<?php echo $employee['address']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Position :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="position" class="form-control" placeholder="Enter Position" value="<?php echo $employee['position']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Birth Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="date_of_birth" class="form-control" value="<?php echo date('Y-m-d', strtotime($employee['date_of_birth'])); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Gender :</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="Male" <?php if ($employee['gender'] == 'Male') {
                                                        echo 'selected';
                                                    } ?>>Male</option>
                            <option value="Female" <?php if ($employee['gender'] == 'Female') {
                                                        echo 'selected';
                                                    } ?>>Female</option>
                            <option value="Other" <?php if ($employee['gender'] == 'Other') {
                                                        echo 'selected';
                                                    } ?>>Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Joint Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="joint_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($employee['joint_date'])); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Leaved Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="leaved_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($employee['leaved_date'])); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Status :</label>
                    </div>
                    <div class="col-sm-9 status-container">
                        <div>
                            <label for="active" class="status">
                                <input type="radio" id="active" name="status" value="1" <?php if ($employee['status'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?>> Active
                            </label>
                        </div>
                        <div>
                            <label for="deactive" class="status">
                                <input type="radio" id="deactive" name="status" value="0" <?php if ($employee['status'] == 0) {
                                                                                                echo 'checked';
                                                                                            } ?>> Deactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_edit_employee" class="btn btn-success">
                    <i class="fa-solid fa-edit"></i>
                    Edit Employee
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>