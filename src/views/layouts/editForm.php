<div id="<?=$user->action?>UserModal<?=$user->id;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/user/<?=$user->action;?><?='/' . $user->id;?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><?=ucfirst($user->action);?> User</h4>
                    <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First and Last Name</label>
                        <input name="name" type="text" class="form-control" pattern="[A-Za-z]+ [A-Za-z]+"
                               value="<?=$user->name;?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option hidden></option>
                            <?php foreach ($user->gender_values as $gender): ?>
                                <option <?= $gender === $user->gender ? 'selected' : ''; ?>
                                    value="<?=$gender?>"><?=$gender?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option hidden></option>
                            <?php foreach ($user->status_values as $status): ?>
                                <option <?= $status === $user->status ? 'selected': ''; ?>
                                    value="<?=$status?>"><?=$status?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control"
                               value="<?=$user->email?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value=<?=ucfirst($user->action)?>>
                </div>
            </form>
        </div>
    </div>
</div>