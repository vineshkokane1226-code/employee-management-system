<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch signle employee data
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_users where id= $get_id";
$result = $connection->query($fetch_query);
if ($result->num_rows > 0) {
    $employee = $result->fetch_assoc();
    $department_id = $employee['department_id'];
    $employee['department'] = $connection->query("SELECT * FROM tbl_departments where id=$department_id")->fetch_assoc()['name'];
} else {
    header("location: list_employee.php");
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Employee Details</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">ID <span style="float: right;">:</span></th>
                        <td><?php echo $employee['id']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Department <span style="float: right;">:</span></th>
                        <td><?php echo $employee['department']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Name <span style="float: right;">:</span></th>
                        <td><?php echo $employee['name']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Email <span style="float: right;">:</span></th>
                        <td><?php echo $employee['email']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Phone <span style="float: right;">:</span></th>
                        <td><?php echo $employee['phone']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Address <span style="float: right;">:</span></th>
                        <td><?php echo $employee['address']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Position <span style="float: right;">:</span></th>
                        <td><?php echo $employee['position']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Date of Birth <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($employee['date_of_birth'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Gender <span style="float: right;">:</span></th>
                        <td><?php echo $employee['gender']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Joint Date <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($employee['joint_date'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Leaved Date <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($employee['leaved_date'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Status <span style="float: right;">:</span></th>
                        <td>
                            <?php if ($employee['status'] == 1) { ?>
                                <span class="badge bg-success">Active</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Dective</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Created At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($employee['created_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Updated At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($employee['updated_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Actions <span style="float: right;">:</span></th>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_employee.php?id=<?php echo $employee['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <form action="delete_employee.php?id=<?php echo $employee['id']; ?>" method="POST">
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