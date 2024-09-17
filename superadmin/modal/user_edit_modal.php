<!-- Edit -->
<div class="modal fade" id="edit_<?= $user_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel">
                        <i class="fas fa-pen-to-square fa-sm"></i> UPDATE USER
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST" id="updateForm_<?= $user_id ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                    	<input type="hidden" name="user_id" value="<?= $user_id ?>" readonly>
                        <div class="row px-0 mb-3">
                            <div class="col-lg-3 col-md-6 col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="first_name">First Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="first_name" name="first_name" type="text" value="<?= $first_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please choose a valid first name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="middle_name">Middle Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="middle_name" name="middle_name" type="text" value="<?= $middle_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid middle name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="last_name">Last Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="last_name" name="last_name" type="text" value="<?= $last_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid last name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="suffix_name">Suffix</label>
                                </div>
                                <div class="col-12">
                                    <select name="suffix_name" class="form-control custom-readonly-input form-select custom-select" id="suffix_name" required>
                                       <option value="n/a" selected>N/A</option>
	                                    <option value="JR" <?php echo $suffix_name == 'JR' ? 'selected' : ''; ?>>JR</option>
	                                    <option value="SR" <?php echo $suffix_name == 'SR' ? 'selected' : ''; ?>>SR</option>
	                                    <option value="III" <?php echo $suffix_name == 'III' ? 'selected' : ''; ?>>III</option>
	                                    <option value="IV" <?php echo $suffix_name == 'IV' ? 'selected' : ''; ?>>IV</option>
	                                    <option value="V" <?php echo $suffix_name == 'V' ? 'selected' : ''; ?>>V</option>
	                                    <option value="V" <?php echo $suffix_name == 'VI' ? 'selected' : ''; ?>>VI</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose a name suffix.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row px-0 mb-3">
                            <div class="col-sm-6 col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="username">Username</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="username" name="username" type="text" value="<?= $username ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid username.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="email">Email</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="email" name="email" type="email" value="<?= $email ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid email.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-0 mb-3">
                            <div class="col-sm-9 col-12 form-group mb-3 px-0">
                                <div class="col-sm-4 d-flex">
                                    <label class="control-label modal-label my-auto" for="designation">Designation</label>
                                </div>
                                <div class="col-sm-8">
                                    <input class="form-control custom-readonly-input" id="designation" name="designation" type="text" value="<?= $designation ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid designation.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row px-0 mb-3">
                            <div class="col-sm-6 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="password">Password</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="password" name="password" type="text">
                                    <small class="text-info font-italic">Leave blank if do not want to change password.</small>
                                    <div class="invalid-feedback">
                                        Please input a valid password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="confirm_password">Confirm Password</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="confirm_password" name="confirm_password" type="text">
                                    <small class="text-info font-italic">Leave blank if do not want to change password.</small>
                                    <div class="invalid-feedback">
                                        Please confirm password.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                </div>
                <div class="modal-footer col-12 px-4">
                    <button type="button" class="btn btn-outline-secondary col-12 col-sm-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary col-12 col-sm-3" id="updateUser_<?= $user_id ?>">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
