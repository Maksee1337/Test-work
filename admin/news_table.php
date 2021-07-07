<h2>News List</h2>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Date</th>
            <th>Views</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($obj_News->NewsHeaders as $v){?>
        <tr>
            <td><?php echo $v['id']; ?></td>
            <td><?php echo urldecode(base64_decode($v['Title'])); ?></td>
            <td><?php echo $v['Author']; ?></td>
            <td><?php echo $v['DateTime']; ?></td>
            <td><?php echo $v['Views']; ?></td>
            <td><a href="admin.php?action=edit&id=<?php echo $v['id']; ?>">Edit</a>
                <a onclick="DeleteNews(<?php echo $v['id']; ?>)" href="#">Delete</a>
            </td>
        </tr>
        <?php }?>

        </tbody>
    </table>
</div>
</main>
</div>
</div>