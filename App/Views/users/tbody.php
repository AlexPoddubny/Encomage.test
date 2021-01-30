<?php foreach ($users as $user) { ?>
    <tr>
        <td><input type="checkbox"></td>
        <td><?php echo $user->id ?></td>
        <td><?php echo $user->first_name ?></td>
        <td><?php echo $user->last_name ?></td>
        <td><?php echo $user->email ?></td>
        <td><?php echo $user->create_date ?></td>
        <td><?php echo $user->update_date ?></td>
        <td><a href="/users/edit/<?php echo $user->id ?>">Edit</a></td>
    </tr>
<?php } ?>