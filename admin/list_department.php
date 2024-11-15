<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch all departments data
$fetch_all_query = "SELECT * FROM tbl_departments ORDER BY name ASC";
$result = $connection->query($fetch_all_query);
$department_list = [];
while ($data = $result->fetch_assoc()) {
    array_push($department_list, $data);
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>List Department</h1>
    </div>
    <div class="body-panel">
        <table class="table tableb-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th class="bnt-actions-list">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($department_list as $key => $department) { ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $department['name']; ?></td>
                        <td><?php echo $department['description']; ?></td>
                        <td>
                            <?php if ($department['status'] == 1) { ?>
                                <span class="badge bg-success">Active</span>
                            <?php } else { ?>
                                <span class="badge bg-danger">Dective</span>
                            <?php } ?>
                        </td>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_department.php?id=<?php echo $department['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="show_department.php?id=<?php echo $department['id']; ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Show</span>
                                </a>
                                <form action="delete_department.php?id=<?php echo $department['id']; ?>" method="POST">
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