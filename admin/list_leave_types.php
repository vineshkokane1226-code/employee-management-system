<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");

// fetch all leave types data
$fetch_all_query = "SELECT * FROM tbl_leave_types ORDER BY name ASC";
$result = $connection->query($fetch_all_query);
$leave_types_list = [];
while ($data = $result->fetch_assoc()) {
    array_push($leave_types_list, $data);
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>List Leave Types</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="bnt-actions-list">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leave_types_list as $key => $leave_types) { ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $leave_types['name']; ?></td>
                        <td>
                            <?php if ($leave_types['status'] == 1) { ?>
                                <span class="badge bg-success">Active</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Dective</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_leave_types.php?id=<?php echo $leave_types['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="show_leave_types.php?id=<?php echo $leave_types['id']; ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Show</span>
                                </a>
                                <form action="delete_leave_types.php?id=<?php echo $leave_types['id']; ?>" method="POST">
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