<div id="deleteUserModal<?=$user->id;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/user/delete/<?=$user->id;?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <?=$user->name;?>?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" class="btn btn-danger" value="Delete" name="buttonDelete">
                </div>
            </form>
        </div>
    </div>
</div>
