<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch all employees data
$fetch_all_query = "SELECT * FROM tbl_users ORDER BY name ASC";
$result = $connection->query($fetch_all_query);
$employee_list = [];
while ($data = $result->fetch_assoc()) {
    $department_id = $data['department_id'];
    $data['department'] = $connection->query("SELECT * FROM tbl_departments where id=$department_id")->fetch_assoc()['name'];
    array_push($employee_list, $data);
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>List Employee</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Department</th>
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
                        <td><?php echo $employee['department']; ?></td>
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