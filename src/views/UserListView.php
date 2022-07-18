<!-- Header HTML -->
<?php require_once ROOT . '/views/layouts/head.php'; ?>
<body>
<div class="container">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-xs-6">
                        <h2>Manage <b>Users</b></h2>
                    </div>
                    <div class="col-xs-6">
                        <a href="#addUserModal" class="btn btn-success" data-toggle="modal">
                            <i class="material-icons">&#xE147;</i><span>Add New User</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>First and Last Name</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <!-- View List HTML -->
                <?php include ROOT . '/views/layouts/viewForm.php'; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Add Modal HTML -->
<?php $action = "add"; $value = "Add"; include ROOT . '/views/layouts/editForm.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>