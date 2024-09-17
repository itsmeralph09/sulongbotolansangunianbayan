<!-- Vote Modal -->
<div class="modal fade" id="vote_<?= $poll_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-success" id="myModalLabel">
                        <i class="fa-solid fa-hand-pointer mr-1"></i> VOTE
                    </h4>
                </div>
                <div class="row float-right mr-2">
                    <button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
            </div>
            <form method="POST" id="voteForm_<?= $poll_id ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="poll_id" value="<?= $poll_id ?>" readonly>
                        <input type="hidden" name="user_id" value="<?= $user_id ?>" readonly>
                        <div class="row">
                            <div class="col-12">
                                <h6>Poll Title: <span class="text-success"><?= $poll_title ?></span></h6>
                            </div>
                            <div class="col-12">
                                <h6>Poll Description: <span class="text-success"><?= $poll_description ?></span></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-12">
                                <h6>Poll Options</h6>
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <section class="radio-selection my-4">
                                    <?php
                                        // Fetch and display poll options
                                        $fetch_options = "SELECT * FROM poll_options_tbl WHERE poll_id = '$poll_id' AND deleted = 0";
                                        $result = mysqli_query($con, $fetch_options);
                                        $firstOption = false; // To check if it's the first option to set it as checked
                                        $optionIndex = 1; // To keep track of the option number
                                        while ($option = mysqli_fetch_array($result)) {
                                            echo '<div class="radio-option">
                                                    <input type="radio" id="control_' . $poll_id . '_' . $optionIndex . '" name="poll_option" value="' . $option['poll_option_id'] . '" ' . ($firstOption ? 'checked' : '') . ' />
                                                    <label for="control_' . $poll_id . '_' . $optionIndex . '" class="radio-label">
                                                        <h4 class="radio-title">(Option ' . $optionIndex . ')</h4>
                                                        <p class="radio-description">' . htmlspecialchars($option['poll_option']) . '</p>
                                                    </label>
                                                  </div>';
                                            $firstOption = false; // Set to false after the first iteration
                                            $optionIndex++; // Increment the option index for the next option
                                        }
                                    ?>
                                </section>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer col-12 px-4">
                    <button type="button" class="btn btn-outline-secondary col-12 col-sm-3" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="vote" class="btn btn-success col-12 col-sm-3" id="submitVote_<?= $poll_id ?>">Vote</button>
                </div>
            </form>
        </div>
    </div>
</div>
