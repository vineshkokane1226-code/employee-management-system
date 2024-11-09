<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// database connection
$connection = new mysqli("localhost", "root", "", "db_employeemanagement");
$total_leave_types = $connection->query("SELECT * FROM tbl_leave_types")->num_rows;
$total_leaves = $connection->query("SELECT * FROM tbl_leaves")->num_rows;
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
        <div class="col-sm-4">
            <div class="body-card-panel bg-green">
                <h4>Total Employees</h4>
                <div>
                    <span class="data-count text-green">
                        <?php echo $total_employees->num_rows; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="body-card-panel bg-yellow">
                <h4>Requested Leaves</h4>
                <div>
                    <span class="data-count text-yellow">
                        <?php echo $total_leaves; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="body-card-panel bg-blue">
                <h4>Leave Types</h4>
                <div>
                    <span class="data-count text-blue">
                        <?php echo $total_leave_types; ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="body-card-panel body-card-panel-table">
                <h4>Recent Employees</h4>
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
<?php include_once("includes/footer.php"); ?>