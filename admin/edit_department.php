<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch single leave_types data
$get_id = $_GET['id'];
$fetch_query = "SELECT * FROM tbl_departments where id= $get_id";
$fetch_result = $connection->query($fetch_query);
if ($fetch_result->num_rows > 0) {
    $department = $fetch_result->fetch_assoc();
} else {
    header("location: list_department.php");
}


if (isset($_POST['btn_submit'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $name = $department['name'];
    }

    if (isset($_POST['description']) && !empty($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $description = $department['description'];
    }

    $status = $_POST['status'];
    $updated_by = $_SESSION['id'];

    if (
        isset($name) &&
        isset($description) &&
        isset($updated_by) &&
        isset($status)
    ) {
        if ($department['name'] != $name) {
            $update_query = "UPDATE tbl_departments SET name= '$name', description= '$description', updated_by= $updated_by,  status= $status WHERE id = $get_id";
        } else {
            $update_query = "UPDATE tbl_departments SET description= '$description', updated_by= $updated_by, status=$status WHERE id = $get_id";
        }

        $connection->query($update_query);

        if ($connection->affected_rows > 0) {
            $result_success = "Department updated successfully!";
        } else {
            $result_success = "No changes were made.";
        }

        $updated_query = "SELECT * FROM tbl_departments where id=$get_id";
        $updated_leave = $connection->query($updated_query);
        $department = $updated_leave->fetch_assoc();
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Edit Department</h1>
    </div>
    <div class="body-panel">
        <?php if (isset($result_success)) { ?>
            <p class="alert alert-success">
                <?php echo $result_success; ?>
            </p>
        <?php } ?>
        <?php if (isset($result_failed)) { ?>
            <p class="alert alert-danger">
                <?php echo $result_failed; ?>
            </p>
        <?php } ?>
        <form action="" method="POST" class="add-employee-form">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Name :</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" name="name" class="form-control" placeholder="Enter Name" value="<?php echo $department['name']; ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Name :</label>
                    </div>
                    <div class="col-sm-9">
                        <textarea name="description" class="form-control" placeholder="Enter Description"><?php echo $department['description']; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Status :</label>
                    </div>
                    <div class="col-sm-9 status-container">
                        <div>
                            <label for="active" class="status">
                                <input type="radio" id="active" name="status" value="1" <?php if ($department['status'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?>> Active
                            </label>
                        </div>
                        <div>
                            <label for="deactive" class="status">
                                <input type="radio" id="deactive" name="status" value="0" <?php if ($department['status'] == 0) {
                                                                                                echo 'checked';
                                                                                            } ?>> Deactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_submit" class="btn btn-success">
                    <i class="fa-solid fa-edit"></i>
                    Update Leave Type
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>