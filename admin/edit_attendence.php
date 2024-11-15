<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// get id
$get_id = $_GET['id'];

// gets single attendance data
$fetch_query = "SELECT * FROM tbl_attendences where id= $get_id";
$fetch_result = $connection->query($fetch_query);
if ($fetch_result->num_rows > 0) {
    $attendence = $fetch_result->fetch_assoc();
} else {
    header("location: list_attendence.php");
}

// fetch all employee data
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
        $employee_id = $attendence['employee_id'];
    }

    if (isset($_POST['date']) && !empty($_POST['date'])) {
        $date = $_POST['date'];
    } else {
        $date = $attendence['date'];
    }

    if (isset($_POST['check_in_time']) && !empty($_POST['check_in_time'])) {
        $check_in_time = $_POST['check_in_time'];
    } else {
        $check_in_time = $attendence['check_in_time'];
    }

    if (isset($_POST['check_out_time']) && !empty($_POST['check_out_time'])) {
        $check_out_time = $_POST['check_out_time'];
    } else {
        $check_out_time = $attendence['check_out_time'];
    }

    if (isset($_POST['status']) && !empty($_POST['status'])) {
        $status = $_POST['status'];
    } else {
        $status =  $attendence['status'];
    }

    if (isset($_POST['remarks']) && !empty($_POST['remarks'])) {
        $remarks = $_POST['remarks'];
    } else {
        $remarks = $attendence['remarks'];
    }

    if (
        isset($employee_id) &&
        isset($date) &&
        isset($check_in_time) &&
        isset($check_out_time) &&
        isset($status) &&
        isset($remarks)
    ) {

        // Office work opening and closing times
        $officeStart = '9:00:00';
        $officeEnd = '17:00:00';

        // Convert times to DateTime objects
        $officeStartTime = new DateTime($officeStart);
        $officeEndTime = new DateTime($officeEnd);
        $checkInTime = new DateTime($check_in_time);
        $checkOutTime = new DateTime($check_out_time);

        // Calculate working hours
        $workingInterval = $checkInTime->diff($checkOutTime);
        $workingHours = $workingInterval->format('%h Hours %i Minutes');

        // Calculate late arriaval
        if ($checkInTime > $officeStartTime) {
            $lateInterval = $officeStartTime->diff($checkInTime);
            $lateTime = $lateInterval->format('%h Hours %i Minutes');
        }

        // Calculate overtime
        if ($checkOutTime > $officeEndTime) {
            $overTimeInterval = $officeEndTime->diff($checkOutTime);
            $overTime = $overTimeInterval->format('%h Hours %i Minutes');
        }

        $update_sql = "UPDATE tbl_attendences SET 
                        employee_id=$employee_id, 
                        date='$date', 
                        check_in_time='$check_in_time', 
                        check_out_time='$check_out_time', 
                        status='$status', 
                        remarks='$remarks', 
                        late_time='$lateTime', 
                        over_time='$overTime', 
                        total_working_hours='$workingHours' 
                        WHERE id= $get_id";

        $connection->query($update_sql);

        if ($connection->affected_rows > 0) {
            $result_success = "Update attendance successfully!";
        } else {
            $result_success = "No changes were made.";
        }
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Edit Attendence</h1>
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
                                <option value="<?php echo $employee['id']; ?>" <?php if ($employee['id'] == $attendence['employee_id']) {
                                                                                    echo "selected";
                                                                                } ?>>
                                    <?php echo $employee['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="date" class="form-control" value="<?php echo $attendence['date']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Check in Time :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="time" name="check_in_time" class="form-control" value="<?php echo $attendence['check_in_time']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Check out Time :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="time" name="check_out_time" class="form-control" value="<?php echo $attendence['check_out_time']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Status :</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="Present" <?php if ('Present' == $attendence['status']) {
                                                        echo "selected";
                                                    } ?>>Present</option>
                            <option value="Absent" <?php if ('Absent' == $attendence['status']) {
                                                        echo "selected";
                                                    } ?>>Absent</option>
                            <option value="On Leave" <?php if ('On Leave' == $attendence['status']) {
                                                            echo "selected";
                                                        } ?>>On Leave</option>
                            <option value="Partial Day" <?php if ('Partial Day' == $attendence['status']) {
                                                            echo "selected";
                                                        } ?>>Partial Day</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Remarks :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="remarks" class="form-control" placeholder="Enter Remarks" value="<?php echo $attendence['remarks']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_submit" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Update Employee
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>