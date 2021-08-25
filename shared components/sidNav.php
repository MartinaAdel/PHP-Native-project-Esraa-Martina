<?php
if (isset($_SESSION['user'])) {
    $userID =  $_SESSION['user']['ID'];
    $userName = $_SESSION['user']['Fname'] . ' ' . $_SESSION['user']['Lname'];
    $userEmail = $_SESSION['user']['email'];
    $userRole = $_SESSION['user']['roleID'];
} else {
    echo 'no';
}
?>


<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="/NTI/E-learning project/Mainassets/images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $userName ?></div>
                <div class="email"><?php echo $userEmail ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="/NTI/E-learning project/profile.php"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/NTI/E-learning project/logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <?php
                if ($userRole == 1) { ?>
                    <li class="header">Admin NAVIGATION</li>
                    <li class="active">
                        <a href="/NTI/E-learning project/Admins/Admins/index.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="/NTI/E-learning project/Admins/AdminRoles/index.php">
                            <i class="material-icons">supervisor_account</i>
                            <span>Roles</span>
                        </a>
                    </li>

                <?php } elseif ($userRole == 2) {

                ?>

                    <li class="header">Teacher NAVIGATION</li>
                    <li class="active">
                        <a href="/NTI/E-learning project/Teacher/track/index.php">
                            <i class="material-icons">library_books</i>
                            <span>Tracks</span>
                        </a>
                    </li>
                <?php } elseif ($userRole == 3) {

                ?>
                    <li class="header">Student NAVIGATION</li>
                    <li class="active">
                        <a href="/NTI/E-learning project/Teacher/track/index.php">
                            <i class="material-icons">library_books</i>
                            <span>My Tracks</span>
                        </a>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2021 <a href="javascript:void(0);">BIT by BIT - E-learning</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.5
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->

</section>