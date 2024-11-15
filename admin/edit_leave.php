<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch single leave
$get_id = $_GET['id'];
$fetch_single_query = "SELECT * FROM tbl_leaves where id=$get_id";
$fetch_single_result = $connection->query($fetch_single_query);
if ($fetch_single_result->num_rows > 0) {
    $leave = $fetch_single_result->fetch_assoc();
} else {
    header("location: my_leave.php");
}

// fetch all leave types data
$fetch_all_query = "SELECT * FROM tbl_leave_types";
$result = $connection->query($fetch_all_query);
$leave_types_list = [];
while ($data = $result->fetch_assoc()) {
    array_push($leave_types_list, $data);
}

if (isset($_POST['btn_request_leave'])) {

    if (isset($_POST['leave_type_id']) && !empty($_POST['leave_type_id'])) {
        $leave_type_id = intval($_POST['leave_type_id']);
    } else {
        $error_leave_type_id = $leave['leave_type_id'];
    }

    if (isset($_POST['from_date']) && !empty($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    } else {
        $error_from_date = $leave['from_date'];
    }

    if (isset($_POST['to_date']) && !empty($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    } else {
        $error_to_date = $leave['to_date'];
    }

    $requested_by = $_SESSION['id'];

    if (
        isset($leave_type_id) &&
        isset($requested_by) &&
        isset($from_date) &&
        isset($to_date)
    ) {
        $update_query = "UPDATE tbl_leaves SET leave_type_id=$leave_type_id, requested_by=$requested_by, from_date='$from_date', to_date='$to_date' WHERE id=$get_id";
        $connection->query($update_query);
        if ($connection->affected_rows > 0) {
            $result_success = "Leave updated successfully!";
        } else {
            $result_success = "No changes were made.";
        }

        $updated_query = "SELECT * FROM tbl_leaves where id=$get_id";
        $updated_leave = $connection->query($updated_query);
        $leave = $updated_leave->fetch_assoc();
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Request Leave</h1>
    </div>
    <div class="body-panel">
        <?php if (isset($result_success)) { ?>
            <p class="alert alert-success">
                <?php echo $result_success; ?>
            </p>
        <?php } ?>
        <form action="" method="POST" class="add-employee-form">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Leave Type :</label>
                    </div>
                    <div class="col-sm-9">
                        <select name="leave_type_id" class="form-control">
                            <option value="">Leave Type</option>
                            <?php foreach ($leave_types_list as $leave_type) { ?>
                                <option value="<?php echo $leave_type['id']; ?>" <?php if ($leave_type['id'] == $leave['leave_type_id']) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                    <?php echo $leave_type['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>From Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="from_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($leave['from_date'])); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>To Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="to_date" class="form-control" value="<?php echo date('Y-m-d', strtotime($leave['to_date'])); ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_request_leave" class="btn btn-primary">
                    <i class="fa-solid fa-edit"></i>
                    Update Request Leave
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>