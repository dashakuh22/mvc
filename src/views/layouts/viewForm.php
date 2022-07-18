<?php for ($i = 0; !empty($userList) && $i < count($userList); $i++) { ?>
    <tr>
        <td><?= $userList[$i]['name'] ?></td>
        <td><?= $userList[$i]['gender'] ?></td>
        <td><?= $userList[$i]['status'] ?></td>
        <td><?= $userList[$i]['email'] ?></td>
        <td>
            <!-- Edit Modal HTML -->
            <?php $action = "edit"; $value = "Save"; require ROOT . '/views/layouts/editForm.php'; ?>
            <a href="#editUserModal<?=$userList[$i]['id']?>" class="edit" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Edit">
                    &#xE254;
                </i>
            </a>
            <!-- Delete Modal HTML -->
            <?php require ROOT . '/views/layouts/deleteForm.php'; ?>
            <a href="#deleteUserModal<?=$userList[$i]['id']?>" class="delete" data-toggle="modal">
                <i class="material-icons" data-toggle="tooltip" title="Delete">
                    &#xE872;
                </i>
            </a>
        </td>
    </tr>
<?php } ?>