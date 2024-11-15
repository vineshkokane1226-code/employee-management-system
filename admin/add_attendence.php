<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");

// fetch all employees data
$fetch_all_query = "SELECT * FROM tbl_users";
$result = $connection->query($fetch_all_query);
$employee_list = [];
while ($data = $result->fetch_assoc()) {
    array_push($employee_list, $data);
}

if (isset($_POST['btn_submit'])) {

    if (isset($_POST['employee_id']) && !empty($_POST['employee_id'])) {
        $employee_id = $_POST['employee_id'];
    } else {
        $error_employee_id = "Employee is required!";
    }

    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $error_date = "Date is required!";
    }

    if (isset($_POST['check_in_time']) && !empty($_POST['check_in_time'])) {
        $check_in_time = $_POST['check_in_time'];
    } else {
        $error_check_in_time = "Check in Time is required!";
    }

    if (isset($_POST['check_out_time']) && !empty($_POST['check_out_time'])) {
        $check_out_time = $_POST['check_out_time'];
    } else {
        $error_check_out_time = "Check Out Time is required!";
    }

    if (isset($_POST['gender']) && !empty($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $error_gender = "Gender is required!";
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = $_POST['status'];
    } else {
        $error_status = "Status is required!";
    }

    if (isset($_POST['remarks']) && !empty($_POST['remarks'])) {
        $remarks = $_POST['remarks'];
    } else {
        $error_remarks = "Remarks is required!";
    }

    if (
        isset($employee_id) &&
        isset($date) &&
        isset($check_in_time) &&
        isset($check_out_time) &&
        isset($status) &&
        isset($remarks)
    ) {

        $connection = new mysqli("localhost", "root", "", "db_employeemanagement");
        $checkUserQuery = "SELECT * FROM tbl_attendences where employee_id=$employee_id";
        $result = $connection->query($checkUserQuery);
        $employee = $result->fetch_assoc();

        $new_date = date("M d, Y", strtotime($date));
        $employee_date = date("M d, Y", strtotime($employee['date']));

        if ($employee_id == $employee['employee_id'] && $new_date == $employee_date) {
            $result_failed = "The attendance of this Employee is already inserted!";
        } else {
            $sql = "INSERT INTO tbl_attendences (employee_id,date,check_in_time,check_out_time,status,remarks) 
                    VALUES ($employee_id,'$date','$check_in_time','$check_out_time','$status','$status')";
            $connection->query($sql);

            if ($connection->insert_id > 0) {
                $result_success = "New attendance added successfully!";
            }
        }
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Add Attendence</h1>
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
                        <label>Employee Name :</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="employee_id" class="form-control">
                            <option value="">Select Employee</option>
                            <?php foreach ($employee_list as $employee) { ?>
                                <option value="<?php echo $employee['id']; ?>">
                                    <?php echo $employee['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php if (isset($error_employee_id)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_employee_id; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="date" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_date)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_date; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Check in Time :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="time" name="check_in_time" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_check_in_time)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_check_in_time; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Check out Time :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="time" name="check_out_time" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_check_out_time)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_check_out_time; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Status :</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Present">Present</option>
                            <option value="Absent">Absent</option>
                            <option value="On Leave">On Leave</option>
                            <option value="Partial Day">Partial Day</option>
                        </select>
                    </div>
                </div>
                <?php if (isset($error_status)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_status; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Remarks :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="remarks" class="form-control" placeholder="Enter Remarks">
                    </div>
                </div>
                <?php if (isset($error_remarks)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_remarks; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Add Employee
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>