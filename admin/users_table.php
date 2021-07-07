<h2>Users List</h2>
<a href="?action=createNewUser">Create new user</a>
<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>ID</th>
            <th>User name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($account->userslist as $v){?>
        <tr>
            <td><?php echo $v['id']; ?></td>
            <td><?php echo $v['Username']; ?></td>
            <td><a href="admin.php?action=editUser&id=<?php echo $v['id']; ?>">Edit</a>
                <a onclick="DeleteUser(<?php echo $v['id']; ?>)" href="#">Delete</a>
            </td>
        </tr>
        <?php }?>

        </tbody>
    </table>
</div>
</main>
</div>
</div>