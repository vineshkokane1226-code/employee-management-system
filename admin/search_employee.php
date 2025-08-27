<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// search by joint between leaved date
if (isset($_POST['search_between_joint_leaved'])) {
    $joint_date = $_POST['joint_date'];
    $leaved_date = $_POST['leaved_date'];
    $fetch_query = "SELECT * FROM tbl_users WHERE joint_date >= '$joint_date' AND leaved_date <= '$leaved_date'";
    $result = $connection->query($fetch_query);
}

else {
    // fetch all employees data
    $fetch_all_query = "SELECT * FROM tbl_users ORDER BY name ASC";
    $result = $connection->query($fetch_all_query);
}

$employee_list = [];
while ($data = $result->fetch_assoc()) {
    array_push($employee_list, $data);
}
?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Search Employee <a href="search_employee.php" class="btn btn-primary">Clear Form</a></h1>
    </div>
    <div class="body-panel">
        <form action="" method="POST">
            <div class="from-group">
                <div class="row" style="display: flex; align-items:flex-end">
                    <div class="col-sm-4">
                        <label>Joint Date</label>
                        <input type="date" name="joint_date" class="form-control" required>
                    </div>
                    <div class="col-sm-4">
                        <label>Leaved Date</label>
                        <input type="date" name="leaved_date" class="form-control" required>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" name="search_between_joint_leaved" class="btn btn-primary">
                            <span>Search by Joint & Leaved</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="body-panel">
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
                <?php foreach ($employee_list as $key => $employee) { ?>
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
<?php include_once("includes/footer.php"); ?>