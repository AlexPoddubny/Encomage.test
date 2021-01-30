<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo $title ?></div>
                
                <div class="card-body">
                    <form action="/users/save" method="POST">
                        <input type="hidden" name="id" id="id"
                               value="<?php echo $user->id ?? ''?>">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                            
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="<?php echo $user->email ?? '' ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                            
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name"
                                       value="<?php echo $user->first_name ?? '' ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
                            
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name"
                                       value="<?php echo $user->last_name ?? ''?>">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-around">
                            <input type="button" onclick="history.back();"class="btn btn-light" value="Back">
                            <input type="submit" class="btn btn-primary" value="Save">
                            <input class="btn btn-primary" value="Save & Continue Edit" id="edit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>