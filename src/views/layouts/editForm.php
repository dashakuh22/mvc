<div id="<?=$action?>UserModal<?=$action == 'add' ? '' : $userList[$i]['id'];?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/user/<?=$action;?><?=$action == 'add' ? '' : '/'.$userList[$i]['id'];?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><?=ucfirst($action);?> User</h4>
                    <button type="button" name="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>First and Last Name</label>
                        <input name="name" type="text" class="form-control" pattern="[A-Za-z]+ [A-Za-z]+"
                               value="<?=$action == 'add' ? '' : $userList[$i]['name'];?>" required>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option hidden><?=$action == 'add' ? '' : $userList[$i]['gender']?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option hidden><?=$action == 'add' ? '' : $userList[$i]['status']?></option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control"
                               value="<?=$action == 'add' ? '' : $userList[$i]['email']?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-info" value=<?=$value?>>
                </div>
            </form>
        </div>
    </div>
</div>
