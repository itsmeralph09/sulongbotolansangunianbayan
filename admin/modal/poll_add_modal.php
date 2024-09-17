<!-- Add -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-success" id="myModalLabel">
                        <i class="fas fa-plus fa-sm"></i> ADD NEW POLL
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0 mb-3">
                            <div class="col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="poll_title">Poll Title</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="poll_title" name="poll_title" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid poll title.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-0 mb-3">
                            <div class="col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="poll_description">Poll Description</label>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control custom-readonly-input" id="poll_description" name="poll_description" type="text" required></textarea>
                                    <div class="invalid-feedback">
                                        Please input a valid poll description.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-0 mb-3">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-secondary" id="add-option-button">Add Option</button>
                            </div>
                        </div>
                        <div id="poll-options-container" class="row px-0 mb-3">
                            <div class="col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="poll_options_0">Poll Option 1</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control poll-option-input custom-readonly-input" id="poll_options_0" name="poll_options[]" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid poll option.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="poll_options_0">Poll Option 2</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control poll-option-input custom-readonly-input" id="poll_options_1" name="poll_options[]" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid poll option.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div> 
                </div>
                <div class="modal-footer col-12 px-4">
                    <button type="button" class="btn btn-outline-secondary col-12 col-sm-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-success col-12 col-sm-3" id="addPoll">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
