<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch all attendences data
$fetch_all_query = "SELECT * FROM tbl_attendences";
$result = $connection->query($fetch_all_query);
$attendence_list = [];
while ($data = $result->fetch_assoc()) {
    $attendence_id = $data['employee_id'];
    $data['employee'] = $connection->query("SELECT * FROM tbl_users where id=$attendence_id")->fetch_assoc()['name'];
    array_push($attendence_list, $data);
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>List Attendence</h1>
    </div>
    <div class="body-panel">
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
                    <th class="bnt-actions-list">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendence_list as $key => $attendence) { ?>
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
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_attendence.php?id=<?php echo $attendence['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="show_attendence.php?id=<?php echo $attendence['id']; ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Show</span>
                                </a>
                                <form action="delete_attendence.php?id=<?php echo $attendence['id']; ?>" method="POST">
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
<?php include_once("includes/footer.php"); ?>