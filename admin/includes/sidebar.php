<div class="admin-sidebar">
    <div class="admin-sidebar-panel">
        <h3>Admin<span>Panel</span></h3>
    </div>
    <div class="admin-sider-nav">
        <h3>
            <a href="dashboard.php">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
        </h3>
    </div>
    <?php if ($_SESSION['role'] == 'Employer') { ?>
        <div class="admin-sider-nav">
            <h4>
                <i class="fa-solid fa-users"></i>
                <span>Employee Manage</span>
                <i class="fa-solid fa-chevron-down"></i>
            </h4>
            <ul>
                <li>
                    <a href="add_employee.php">
                        <i class="fa-solid fa-plus"></i>
                        <span>Add Employee</span>
                    </a>
                </li>
                <li>
                    <a href="list_employee.php">
                        <i class="fa-solid fa-list"></i>
                        <span>List Employee</span>
                    </a>
                </li>
                <li>
                    <a href="search_employee.php">
                        <i class="fa-solid fa-search"></i>
                        <span>Search Employee</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="admin-sider-nav">
            <h4>
                <i class="fa-solid fa-face-smile"></i>
                <span>Leave Type Manage</span>
                <i class="fa-solid fa-chevron-down"></i>
            </h4>
            <ul>
                <li>
                    <a href="add_leave_types.php">
                        <i class="fa-solid fa-person-walking-arrow-right"></i>
                        <span>Add Leave Type</span>
                    </a>
                </li>
                <li>
                    <a href="list_leave_types.php">
                        <i class="fa-solid fa-hand-peace"></i>
                        <span>List Leave Types</span>
                    </a>
                </li>
            </ul>
        </div>
    <?php } ?>
    <div class="admin-sider-nav">
        <h4>
            <i class="fa-solid fa-face-smile"></i>
            <span>Leave Requested Manage</span>
            <i class="fa-solid fa-chevron-down"></i>
        </h4>
        <ul>
            <?php if ($_SESSION['role'] == 'Employee') { ?>
                <li>
                    <a href="add_leave.php">
                        <i class="fa-solid fa-hand-peace"></i>
                        <span>Request Leave</span>
                    </a>
                </li>
                <li>
                    <a href="my_leave.php">
                        <i class="fa-solid fa-list"></i>
                        <span>My Leaves</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($_SESSION['role'] == 'Employer') { ?>
                <li>
                    <a href="requested_leave.php">
                        <i class="fa-solid fa-hand-peace"></i>
                        <span>Requested Leave</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>