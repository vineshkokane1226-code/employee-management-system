<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch signle leave_types data
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_leave_types where id= $get_id";
$result = $connection->query($fetch_query);
if ($result->num_rows > 0) {
    $leave_types = $result->fetch_assoc();
} else {
    header("location: list_leave_types.php");
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Leave Types Details</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">ID <span style="float: right;">:</span></th>
                        <td><?php echo $leave_types['id']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Name <span style="float: right;">:</span></th>
                        <td><?php echo $leave_types['name']; ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Status <span style="float: right;">:</span></th>
                        <td>
                            <?php if ($leave_types['status'] == 1) { ?>
                                <span class="badge bg-success">Active</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Dective</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Created At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($leave_types['created_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Updated At <span style="float: right;">:</span></th>
                        <td><?php echo date("M d, Y", strtotime($leave_types['updated_at'])); ?></td>
                    </tr>
                    <tr style="vertical-align: middle;">
                        <th style="width: 200px;">Actions <span style="float: right;">:</span></th>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_leave_types.php?id=<?php echo $leave_types['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <form action="delete_leave_types.php?id=<?php echo $leave_types['id']; ?>" method="POST">
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