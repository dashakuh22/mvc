<!-- Header HTML -->
<?php require_once file_build_path(ROOT, 'views', 'layouts', 'head.php'); ?>
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
                <?php include file_build_path(ROOT, 'views', 'layouts', 'viewForm.php'); ?>
                </tbody>
            </table>
            <div class="clearfix">
                <ul class="pagination">
                    <li class="page-item <?= $pagination->isStart() ?>">
                        <a href="/<?= $pagination->page_prev; ?>" class="page-link">Prev</a>
                    </li>
                    <li class="page-item active">
                        <a href="/<?= $pagination->page_cur; ?>" class="page-link"><?= $pagination->page_cur; ?></a>
                    </li>
                    <li class="page-item <?= $pagination->isEnd() ?>">
                        <a href="/<?= $pagination->page_next; ?>" class="page-link">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Add Modal HTML -->
<?php $user = new User(); include file_build_path(ROOT, 'views', 'layouts', 'editForm.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>