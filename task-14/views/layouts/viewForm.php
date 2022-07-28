<?php include_once file_build_path(ROOT, 'models', 'User.php');
for ($i = 0; !empty($userList) && $i < sizeof($userList); $i++) {
    $user = new User($userList[$i]->name, $userList[$i]->gender,
        $userList[$i]->status, $userList[$i]->email,
        $userList[$i]->id); ?>
    <tr>
        <td><?= $user->name ?></td>
        <td><?= ucfirst($user->gender) ?></td>
        <td><?= ucfirst($user->status) ?></td>
        <td><?= $user->email ?></td>
        <td>
            <!-- Edit Modal HTML -->
            <?php include file_build_path(ROOT, 'views', 'layouts', 'editForm.php'); ?>
            <a href="#editUserModal<?= $user->id ?>" class="edit" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Edit">
                    &#xE254;
                </i>
            </a>
            <!-- Delete Modal HTML -->
            <?php include file_build_path(ROOT, 'views', 'layouts', 'deleteForm.php'); ?>
            <a href="#deleteUserModal<?= $user->id ?>" class="delete" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Delete">
                    &#xE872;
                </i>
            </a>
        </td>
    </tr>
<?php } ?>