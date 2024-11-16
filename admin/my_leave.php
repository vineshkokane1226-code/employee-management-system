<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch all leave types data
$loggedin_user_id = $_SESSION['id'];
$fetch_all_query = "SELECT * FROM tbl_leaves where requested_by=$loggedin_user_id";
$result = $connection->query($fetch_all_query);
$leaves_list = [];
while ($data = $result->fetch_assoc()) {
    $leave_type_id = $data['leave_type_id'];
    $data['leave_type_name'] = $connection->query("SELECT * FROM tbl_leave_types where id=$leave_type_id")->fetch_assoc()['name'];
    array_push($leaves_list, $data);
}
?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>My Leaves List</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Leave Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th class="bnt-actions-list">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaves_list as $key => $leave) { ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $leave['leave_type_name']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($leave['from_date'])); ?></td>
                        <td><?php echo date("M d, Y", strtotime($leave['to_date'])); ?></td>
                        <td>
                            <?php if ($leave['status'] == 'Approved') { ?>
                                <span class="badge bg-success">
                                    <?php echo $leave['status']; ?>
                                </span>
                            <?php } elseif ($leave['status'] == 'Rejected') { ?>
                                <span class="badge bg-danger">
                                    <?php echo $leave['status']; ?>
                                </span>
                            <?php } else { ?>
                                <span class="badge bg-warning">
                                    <?php echo $leave['status']; ?>
                                </span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($leave['status'] == 'Pending') { ?>
                                <div class="bnt-actions-link">
                                    <a href="edit_leave.php?id=<?php echo $leave['id']; ?>" class="btn btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </a>
                                </div>

                            <?php } else {  ?>
                                <div class="bnt-actions-link">
                                    <button disabled class="btn btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span>Edit</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>