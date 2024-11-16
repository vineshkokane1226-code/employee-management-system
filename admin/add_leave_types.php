<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

if (isset($_POST['btn_add_employee'])) {

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $error_name = "Name is required!";
    }

    $status = $_POST['status'];
    $created_by = $_SESSION['id'];

    if (
        isset($name) &&
        isset($created_by) &&
        isset($status)
    ) {
        $checkNameQuery = "SELECT * FROM tbl_leave_types where name='$name'";
        $result = $connection->query($checkNameQuery);

        if ($result->num_rows > 0) {
            $result_failed = "Leave Type already in exists!";
        } else {
            $password = md5($password);
            $sql = "INSERT INTO tbl_leave_types (name, created_by, status)  VALUES ('$name',  $created_by, $status)";
            $connection->query($sql);

            if ($connection->insert_id > 0) {
                $result_success = "New Leave Type added successfully!";
            }
        }
    }
}

?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>Add Leave Types</h1>
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
                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                    </div>
                </div>
                <?php if (isset($error_name)) { ?>
                    <p class='alert alert-danger'>
                        <?php echo $error_name; ?>
                    </p>
                <?php } ?>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3">
                        <label>Status :</label>
                    </div>
                    <div class="col-sm-9 status-container">
                        <div>
                            <label for="active" class="status">
                                <input type="radio" id="active" name="status" value="1" checked> Active
                            </label>
                        </div>
                        <div>
                            <label for="deactive" class="status">
                                <input type="radio" id="deactive" name="status" value="0"> Deactive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="btn_add_employee" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Add Leave Type
                </button>
            </div>
        </form>
    </div>
</div>
<?php include_once("includes/footer.php"); ?>