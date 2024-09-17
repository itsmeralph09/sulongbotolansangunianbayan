<!-- View Vote Modal -->
<div class="modal fade" id="view_vote_<?= $poll_id ?>" tabindex="-1" role="dialog" aria-labelledby="viewVoteModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="viewVoteModalLabel">
                        <i class="fa-solid fa-eye mr-1"></i> VIEW VOTE
                    </h4>
                </div>
                <div class="row float-right mr-2">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <h6>Poll Title: <span class="text-primary"><?= $poll_title ?></span></h6>
                        </div>
                        <div class="col-12">
                            <h6>Poll Description: <span class="text-primary"><?= $poll_description ?></span></h6>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-2">
                        <div class="col-12">
                            <h6>Your Vote</h6>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <section class="radio-selection my-4">
                                <?php
                                    // Fetch and display poll options with the user's selected option
                                    $fetch_options = "SELECT * FROM poll_options_tbl WHERE poll_id = '$poll_id' AND deleted = 0";
                                    $result = mysqli_query($con, $fetch_options);
                                    
                                    // Fetch the user's vote
                                    $fetch_user_vote = "SELECT poll_option_id FROM poll_vote_tbl WHERE poll_id = '$poll_id' AND user_id = '$user_id' AND deleted = 0";
                                    $user_vote_result = mysqli_query($con, $fetch_user_vote);
                                    $user_vote = mysqli_fetch_assoc($user_vote_result)['poll_option_id'];
                                    
                                    $optionIndex = 1; // To keep track of the option number
                                    while ($option = mysqli_fetch_array($result)) {
                                        $isChecked = ($option['poll_option_id'] == $user_vote) ? 'checked' : '';
                                        $radioId = 'view_control_' . $poll_id . '_' . $optionIndex;
                                        echo '<div class="radio-option">
                                                <input type="radio" id="' . $radioId . '" name="poll_option_' . $poll_id . '" value="' . $option['poll_option_id'] . '" ' . $isChecked . ' disabled />
                                                <label for="' . $radioId . '" class="radio-label">
                                                    <h4 class="radio-title">(Option ' . $optionIndex . ')</h4>
                                                    <p class="radio-description">' . htmlspecialchars($option['poll_option']) . '</p>
                                                </label>
                                              </div>';
                                        $optionIndex++; // Increment the option index for the next option
                                    }
                                ?>
                            </section>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="modal-footer col-12 px-4">
                <button type="button" class="btn btn-outline-secondary col-12 col-sm-3" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
