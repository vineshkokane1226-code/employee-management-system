<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");

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
        $error_leave_type_id = "Leave Type is required!";
    }

    if (isset($_POST['from_date']) && !empty($_POST['from_date'])) {
        $from_date = $_POST['from_date'];
    } else {
        $error_from_date = "From Date is required!";
    }

    if (isset($_POST['to_date']) && !empty($_POST['to_date'])) {
        $to_date = $_POST['to_date'];
    } else {
        $error_to_date = "To Date is required!";
    }

    $requested_by = $_SESSION['id'];
    $status = "Pending";

    if (
        isset($leave_type_id) &&
        isset($requested_by) &&
        isset($from_date) &&
        isset($to_date) &&
        isset($status)
    ) {
        $add_leave_query = "INSERT INTO tbl_leaves (leave_type_id, requested_by, from_date, to_date, status) 
                VALUES ($leave_type_id, $requested_by, '$from_date', '$to_date', '$status')";
        $connection->query($add_leave_query);


        if ($connection->insert_id > 0) {
            $result_success = "New leave added successfully!";
        }
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
                                <option value="<?php echo $leave_type['id']; ?>">
                                    <?php echo $leave_type['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php if (isset($error_leave_type_ids)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_leave_type_ids; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>From Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="from_date" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_from_date)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_from_date; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>To Date :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="date" name="to_date" class="form-control">
                    </div>
                </div>
                <?php if (isset($error_to_date)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_to_date; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_request_leave" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Request Leave
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>