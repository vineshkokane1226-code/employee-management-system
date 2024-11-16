<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch signle attendence data
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_attendences where id= $get_id";
$result = $connection->query($fetch_query);
if ($result->num_rows > 0) {
    $attendence = $result->fetch_assoc();
    $employee_id = $attendence['employee_id'];
    $attendence['employee'] = $connection->query("SELECT * FROM tbl_users where id=$employee_id")->fetch_assoc()['name'];
} else {
    header("location: list_employee.php");
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Attendence Details</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">ID <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['id']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Name <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['employee']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Date <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($attendence['date'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Check in Time <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['check_in_time']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Late Time <span style="float: right;">:</span></th>
                        <td>
                            <?php if (!empty($attendence['late_time'])) { ?>
                                <span style="display:block;color:red; font-size:14px">
                                    - <?php echo $attendence['late_time']; ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Check Out Time <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['check_out_time']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Over Time <span style="float: right;">:</span></th>
                        <td>
                            <?php if (!empty($attendence['over_time'])) { ?>
                                <span style="display:block;color:green; font-size:14px">
                                    + <?php echo $attendence['over_time']; ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Total Working Hours <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['total_working_hours']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Status <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['status']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Remarks <span style="float: right;">:</span></th>
                        <td><?php echo $attendence['remarks']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Created At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($attendence['created_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Updated At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($attendence['updated_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Actions <span style="float: right;">:</span></th>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_attendence.php?id=<?php echo $attendence['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <form action="delete_attendence.php?id=<?php echo $attendence['id']; ?>" method="POST">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                        </td>
                    </tr>
                </thead>
        </table>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>