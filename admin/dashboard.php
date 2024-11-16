<?php
// import header
include_once("includes/header.php");
// import sidebar
include_once("includes/sidebar.php");
?>

<?php if ($_SESSION['role'] == 'Employer') {

    $total_departments = $connection->query("SELECT * FROM tbl_departments")->num_rows;
    $total_pending_leaves = $connection->query("SELECT * FROM tbl_leaves where status='Pending'")->num_rows;
    // $total_leaves = $connection->query("SELECT * FROM tbl_leaves where status='Pending'")->num_rows;
    $total_employees = $connection->query("SELECT * FROM tbl_users");
    $employees_list = [];
    while ($data = $total_employees->fetch_assoc()) {
        array_push($employees_list, $data);
    }

?>

    <div class="admin-main">
        <div class="heading-panel">
            <h1>Dashbaord</h1>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-green">
                    <h4>Total <br>Employees</h4>
                    <div>
                        <span class="data-count text-green">
                            <?php echo $total_employees->num_rows; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-danger">
                    <h4>Total <br>Department</h4>
                    <div>
                        <span class="data-count text-danger">
                            <?php echo $total_departments; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-blue">
                    <h4>Annual <br>Holidays</h4>
                    <div>
                        <span class="data-count text-blue">

                            <?php echo $total_pending_leaves; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-yellow">
                    <h4>Pending <br>Leaves</h4>
                    <div>
                        <span class="data-count text-yellow">

                            <?php echo $total_pending_leaves; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="body-card-panel body-card-panel-table">
                    <h4>Total Employees</h4>
                    <table class="table tableb-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th class="bnt-actions-list">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees_list as $key => $employee) { ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $employee['name']; ?></td>
                                    <td><?php echo $employee['position']; ?></td>
                                    <td><?php echo $employee['gender']; ?></td>
                                    <td>
                                        <?php if ($employee['status'] == 1) { ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php } else { ?>
                                            <span class="badge bg-danger">Dective</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="bnt-actions-link">
                                            <a href="edit_employee.php?id=<?php echo $employee['id']; ?>" class="btn btn-success">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                <span>Edit</span>
                                            </a>
                                            <a href="show_employee.php?id=<?php echo $employee['id']; ?>" class="btn btn-primary">
                                                <i class="fa-solid fa-eye"></i>
                                                <span>Show</span>
                                            </a>
                                            <form action="delete_employee.php?id=<?php echo $employee['id']; ?>" method="POST">
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa-solid fa-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }  ?>
<?php if ($_SESSION['role'] == 'Employee') {
    $my_id = $_SESSION['id'];
    $total_leaves = $connection->query("SELECT * FROM tbl_leaves where requested_by=$my_id");
    $approved_leaves = $connection->query("SELECT * FROM tbl_leaves where requested_by=$my_id AND status='Approved'");
    $pending_leaves = $connection->query("SELECT * FROM tbl_leaves where requested_by=$my_id AND status='Pending'");
    $rejected_leaves = $connection->query("SELECT * FROM tbl_leaves where requested_by=$my_id AND status='Rejected'");
    $my_attendences = $connection->query("SELECT * FROM tbl_attendences where employee_id=$my_id");
    $my_attendences_list = [];
    while ($data = $my_attendences->fetch_assoc()) {
        $attendence_id = $data['employee_id'];
        $data['employee'] = $connection->query("SELECT * FROM tbl_users where id=$attendence_id")->fetch_assoc()['name'];
        array_push($my_attendences_list, $data);
    }
?>
    <div class="admin-main">
        <div class="heading-panel">
            <h1>Dashbaord</h1>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-blue">
                    <h4>My Total <br>Leaves</h4>
                    <div>
                        <span class="data-count text-blue">
                            <?php echo $total_leaves->num_rows; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-green">
                    <h4>Approved <br>Leaves</h4>
                    <div>
                        <span class="data-count text-green">
                            <?php echo $approved_leaves->num_rows; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-yellow">
                    <h4>Pending <br>Leaves</h4>
                    <div>
                        <span class="data-count text-yellow">

                            <?php echo $pending_leaves->num_rows; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="body-card-panel bg-danger">
                    <h4>Rejected <br>Leaves</h4>
                    <div>
                        <span class="data-count text-danger">

                            <?php echo $rejected_leaves->num_rows; ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="body-card-panel body-card-panel-table">
                    <h4>My Attendences</h4>
                    <table class="table tableb-bordered">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Check in Time</th>
                                <th>Check Out Time</th>
                                <th>Total Working Hours</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($my_attendences_list as $key => $attendence) { ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $attendence['employee']; ?></td>
                                    <td><?php echo date("M d, Y", strtotime($attendence['date'])); ?></td>
                                    <td>
                                        <?php echo $attendence['check_in_time']; ?>
                                        <?php if (!empty($attendence['late_time'])) { ?>
                                            <span style="display:block;color:red; font-size:14px">
                                                - <?php echo $attendence['late_time']; ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $attendence['check_out_time']; ?>
                                        <?php if (!empty($attendence['over_time'])) { ?>
                                            <span style="display:block;color:green; font-size:14px">
                                                + <?php echo $attendence['over_time']; ?>
                                            </span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $attendence['total_working_hours']; ?></td>
                                    <td><?php echo $attendence['status']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php }  ?>
<?php include_once("includes/footer.php"); ?>