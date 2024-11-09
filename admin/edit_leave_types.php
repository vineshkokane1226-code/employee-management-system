<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch single leave_types data
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_leave_types where id= $get_id";
$fetch_result = $connection->query($fetch_query);
if ($fetch_result->num_rows > 0) {
    $leave_types = $fetch_result->fetch_assoc();
} else {
    header("location: list_employee.php");
}


if (isset($_POST['btn_edit_leave_types'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = $leave_types['name'];
    }

    $status = $_POST['status'];
    $updated_by = $_SESSION['id'];

    if (
        isset($name) &&
        isset($updated_by) &&
        isset($status)
    ) {
        if ($leave_types['name'] != $name) {
            $update_query = "UPDATE tbl_leave_types SET name = '$name', updated_by = '$updated_by',  status = $status WHERE id = $get_id";
        } else {
            $update_query = "UPDATE tbl_leave_types SET updated_by='$updated_by', status=$status WHERE id = $get_id";
        }

        $connection->query($update_query);

        if ($connection->affected_rows > 0) {
            $result_success = "Leave Type updated successfully!";
        } else {
            $result_success = "No changes were made.";
        }

        $updated_query = "SELECT * FROM tbl_leave_types where id=$get_id";
        $updated_leave = $connection->query($updated_query);
        $leave_types = $updated_leave->fetch_assoc();
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
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $leave_types['name']; ?>">
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
                                <input type="radio" id="active" name="status" value="1" <?php if ($leave_types['status'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?>> Active
                            </label>
                        </div>
                        <div>
                            <label for="deactive" class="status">
                                <input type="radio" id="deactive" name="status" value="0" <?php if ($leave_types['status'] == 0) {
                                                                                                echo 'checked';
                                                                                            } ?>> Deactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_edit_leave_types" class="btn btn-success">
                    <i class="fa-solid fa-edit"></i>
                    Update Leave Type
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>