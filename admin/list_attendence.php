<?php
// import header
include_once("includes/header.php");

// import sidebar
include_once("includes/sidebar.php");

// fetch all attendences data
$attendence_result = $connection->query("SELECT * FROM tbl_attendences");
$attendence_list = [];
while ($data = $attendence_result->fetch_assoc()) {
    $attendence_id = $data['employee_id'];
    $data['employee'] = $connection->query("SELECT * FROM tbl_users where id=$attendence_id")->fetch_assoc()['name'];
    array_push($attendence_list, $data);
}

// fetch all employees data
$user_result = $connection->query("SELECT * FROM tbl_users");
$employee_list = [];
while ($data = $user_result->fetch_assoc()) {
    array_push($employee_list, $data);
}


?>
<div class="admin-main">
    <div class="heading-panel">
        <h1>List Attendence</h1>
    </div>
    <div class="body-panel">
        <form action="" method="POST" class="search-filter-form">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <label for="date">Employee</label>
                    <select name="employee_id" class="form-control">
                        <option value="">Select Employee</option>
                        <?php foreach ($employee_list as $employee) { ?>
                            <option value="<?php echo $employee['id']; ?>">
                                <?php echo $employee['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-sm-6 col-md-3">
                    <label for="byDate">By Date</label>
                    <input type="date" id="byDate" name="date" class="form-control">
                </div>
                <div class="col-sm-6 col-md-3">
                    <label for="byMonth">By Month</label>
                    <select name="month" id="byMonth" class="form-control">
                        <option value="">Select Month</option>
                        <option value="January">January</option>
                        <option value="Febuary">Febuary</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="col-sm-6 col-md-3">
                    <label for="byYear">By Year</label>
                    <select name="year" id="byYear" class="form-control">
                        <option value="">Select Year</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_submit">Search</button>
        </form>
        <hr>
        <table class="table tableb-bordered">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Check in Time</th>
                    <th>Check Out Time</th>
                    <th>Total Working Hours</th>
                    <th>Status</th>
                    <th class="bnt-actions-list">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attendence_list as $key => $attendence) { ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $attendence['employee']; ?></td>
                        <td><?php echo date("M d, Y", strtotime($attendence['date'])); ?></td>
                        <td>
                            <?php echo $attendence['check_in_time']; ?>
                            <?php if (!empty($attendence['late_time'])) { ?>
                                <span style="display:block;color:red; font-size:14px">
                                    - <?php echo $attendence['late_time']; ?>
                                </span>
                            <?php } ?>
                        </td>
                        <td>
                            <?php echo $attendence['check_out_time']; ?>
                            <?php if (!empty($attendence['over_time'])) { ?>
                                <span style="display:block;color:green; font-size:14px">
                                    + <?php echo $attendence['over_time']; ?>
                                </span>
                            <?php } ?>
                        </td>
                        <td><?php echo $attendence['total_working_hours']; ?></td>
                        <td><?php echo $attendence['status']; ?></td>
                        <td>
                            <div class="bnt-actions-link">
                                <a href="edit_attendence.php?id=<?php echo $attendence['id']; ?>" class="btn btn-success">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <span>Edit</span>
                                </a>
                                <a href="show_attendence.php?id=<?php echo $attendence['id']; ?>" class="btn btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                    <span>Show</span>
                                </a>
                                <form action="delete_attendence.php?id=<?php echo $attendence['id']; ?>" method="POST">
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