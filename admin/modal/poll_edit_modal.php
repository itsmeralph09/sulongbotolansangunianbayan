<!-- Edit -->
<div class="modal fade" id="edit_<?= $poll_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel">
                        <i class="fas fa-pen-to-square fa-sm"></i> UPDATE POLL
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST" id="updateForm_<?= $poll_id ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="poll_id" value="<?= $poll_id ?>" readonly>
                        <div class="row px-0 mb-3">
                            <div class="col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="poll_title_<?= $poll_id ?>">Poll Title</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="poll_title_<?= $poll_id ?>" name="poll_title" value="<?= $poll_title ?>" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid poll title.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-0 mb-3">
                            <div class="col-12 form-group mb-3 px-0">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="poll_description_<?= $poll_id ?>">Poll Description</label>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control custom-readonly-input" id="poll_description_<?= $poll_id ?>" name="poll_description" type="text" required><?= $poll_description ?></textarea>
                                    <div class="invalid-feedback">
                                        Please input a valid poll description.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-0 mb-3">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-secondary" id="add-option-button_<?= $poll_id ?>">Add Option</button>
                            </div>
                        </div>
                        <div id="poll-options-container_<?= $poll_id ?>" class="row px-0 mb-3">
                            <?php
                                // Fetch and display poll options
                                $fetch_options = "SELECT * FROM poll_options_tbl WHERE poll_id = '$poll_id' AND deleted = 0";
                                $result = mysqli_query($con, $fetch_options);
                                $index = 0;
                                
                                while ($option = mysqli_fetch_array($result)) {
                                    echo '<div class="col-12 form-group mb-3 px-0 poll-option-group">
                                            <div class="col-12 d-flex">
                                                <label class="control-label modal-label my-auto" for="poll_options_'. $poll_id. '_' . $index . '">Poll Option ' . ($index + 1) . '</label>
                                            </div>
                                            <div class="col-12 d-flex">
                                                <input class="form-control poll-option-input_'.$poll_id.' custom-readonly-input" id="poll_options_'. $poll_id. '_' . $index . '" name="poll_options[]" value="' . htmlspecialchars($option['poll_option']) . '" type="text" required>
                                                <button type="button" class="btn btn-danger ml-2" id="remove-option-button_'.$poll_id. '_'. $index. '">Remove</button>
                                            </div>
                                        </div>';
                                    $index++;
                                }
                            ?>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer col-12 px-4">
                    <button type="button" class="btn btn-outline-secondary col-12 col-sm-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="edit" class="btn btn-primary col-12 col-sm-3" id="updatePoll_<?= $poll_id ?>">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
