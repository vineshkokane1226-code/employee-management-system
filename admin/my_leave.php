<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");

// fetch all leave types data
$loggedin_user_id = $_SESSION['id'];
$fetch_all_query = "SELECT * FROM tbl_leaves where requested_by=$loggedin_user_id";
$result = $connection->query($fetch_all_query);
$leaves_list = [];
while ($data = $result->fetch_assoc()) {
    $leave_type_id = $data['leave_type_id'];
    $data['leave_type_name'] = $connection->query("SELECT * FROM tbl_leave_types where id=$leave_type_id")->fetch_assoc()['name'];

    if (!empty($data['approved_by'])) {
        $user_id = $data['approved_by'];
        $data['approved_by'] = $connection->query("SELECT * FROM tbl_users where id=$user_id")->fetch_assoc()['name'];
    }

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
                    <th>Approved By</th>
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
                        <td><?php echo $leave['approved_by']; ?></td>
                        <td><?php echo $leave['leave_type_name']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($leave['from_date'])); ?></td>
                        <td><?php echo date("M d, Y", strtotime($leave['to_date'])); ?></td>
                        <td>
                            <span
                                class="badge bg-<?php
                                                if ($leave['status'] == 'Pending') {
                                                    echo "warning";
                                                }
                                                if ($leave['status'] == 'Approved') {
                                                    echo "success";
                                                }
                                                if ($leave['status'] == 'Rejected') {
                                                    echo "danger";
                                                } ?>">
                                <?php echo $leave['status']; ?>
                            </span>
                        </td>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_leave.php?id=<?php echo $leave['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>