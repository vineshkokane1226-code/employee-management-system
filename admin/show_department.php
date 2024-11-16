<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch signle departments data
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_departments where id= $get_id";
$result = $connection->query($fetch_query);
if ($result->num_rows > 0) {
    $department = $result->fetch_assoc();
    $created_id = $department['created_by'];
    $updated_id = $department['updated_by'];
    $department['created_by'] = $connection->query("SELECT * FROM tbl_users where id=$created_id")->fetch_assoc()['name'];
    $department['updated_by'] = $connection->query("SELECT * FROM tbl_users where id=$updated_id")->fetch_assoc()['name'];
} else {
    header("location: list_department.php");
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Department Details</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">ID <span style="float: right;">:</span></th>
                        <td><?php echo $department['id']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Name <span style="float: right;">:</span></th>
                        <td><?php echo $department['name']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Description <span style="float: right;">:</span></th>
                        <td><?php echo $department['description']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Status <span style="float: right;">:</span></th>
                        <td>
                            <?php if ($department['status'] == 1) { ?>
                                <span class="badge bg-success">Active</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Dective</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Created By <span style="float: right;">:</span></th>
                        <td><?php echo $department['created_by']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Updated By <span style="float: right;">:</span></th>
                        <td><?php echo $department['updated_by']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Created At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($department['created_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Updated At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($department['updated_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Actions <span style="float: right;">:</span></th>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_department.php?id=<?php echo $department['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <form action="delete_department.php?id=<?php echo $department['id']; ?>" method="POST">
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