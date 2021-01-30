<div class="container">
    <div class="row d-flex justify-content-around">
        <a href="/users/add" class="btn btn-primary">Add User</a>
        <a href="#" class="btn btn-primary" id="search">Search</a>
        <a href="#" class="btn btn-primary" id="clear">Reset Fields</a>
    </div>
</div>
<div class="table-responsive">
    <h6>Found <?php echo count($users) ?> records</h6>
    <table class="table table-striped table-bordered" id="resultTable">
        <thead>
            <tr>
                <th><input type="checkbox" id="checkAll"></th>
                <th class="sort" data-column="id">Id</th>
                <th class="sort" data-column="first_name">First Name</th>
                <th class="sort" data-column="last_name">Last Name</th>
                <th class="sort" data-column="email">email</th>
                <th class="sort" data-column="create_date">Date Created</th>
                <th class="sort" data-column="update_date">Date Edited</th>
                <th>Action</th>
            </tr>
            <tr>
                <th>
                </th>
                <th>
                    <input type="number" name="id" id="id" class="search">
                </th>
                <th>
                    <input type="text" name="first_name" id="first_name" class="search">
                </th>
                <th>
                    <input type="text" name="last_name" id="last_name" class="search">
                </th>
                <th>
                    <input type="text" name="email" id="email" class="search">
                </th>
                <th>
                    <label for="create_date_from">From</label>
                    <input type="date" name="create_date_from" class="search" id="create_date_from">
                    <br>
                    <label for="create_date_to">To</label>
                    <input type="date" name="create_date_to" class="search" id="create_date_to">
                </th>
                <th>
                    <label for="update_date_from">From</label>
                    <input type="date" name="update_date_from" class="search" id="update_date_from">
                    <br>
                    <label for="update_date_to">To</label>
                    <input type="date" name="update_date_to" class="search" id="update_date_to">
                </th>
                <th></th>
            </tr>
        </thead>
        <tbody id="body">
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
        </tbody>
    </table>
</div>