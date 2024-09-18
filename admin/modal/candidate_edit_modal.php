<!-- Edit -->
<div class="modal fade" id="edit_<?= $candidate_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-primary" id="myModalLabel">
                        <i class="fas fa-pen-to-square fa-sm"></i> UPDATE CANDIDATE
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST" id="updateForm_<?= $candidate_id ?>">
                <div class="modal-body">
                    <div class="container-fluid">
                        <input type="hidden" name="candidate_id" value="<?= $candidate_id ?>" readonly>
                        <div class="row px-0 mb-3">
                            <div class="col-lg-3 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="first_name_<?= $candidate_id ?>">First Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="first_name_<?= $candidate_id ?>" name="first_name" type="text" value="<?= $first_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please choose a valid first name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="middle_name_<?= $candidate_id ?>">Middle Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="middle_name_<?= $candidate_id ?>" name="middle_name" type="text"  value="<?= $middle_name ?>" >
                                    <div class="invalid-feedback">
                                        Please input a valid middle name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="last_name_<?= $candidate_id ?>">Last Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="last_name_<?= $candidate_id ?>" name="last_name" type="text"  value="<?= $last_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid last name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="suffix_name_<?= $candidate_id ?>">Suffix</label>
                                </div>
                                <div class="col-12">
                                    <select name="suffix_name" class="form-control custom-readonly-input form-select custom-select" id="suffix_name_<?= $candidate_id ?>" required>
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
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="stage_name_<?= $candidate_id ?>">Stage Name (Nickname)</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="stage_name_<?= $candidate_id ?>" name="stage_name" type="text" value="<?= $stage_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid stage name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="gender_<?= $candidate_id ?>">Gender</label>
                                </div>
                                <div class="col-12">
                                    <select name="gender" class="form-control custom-readonly-input form-select custom-select" id="gender_<?= $candidate_id ?>" required>
                                       <option value="" selected disabled>Select a gender</option>
                                       <option value="MALE" <?php echo $gender == 'MALE' ? 'selected' : ''; ?>>MALE</option>
                                       <option value="FEMALE" <?php echo $gender == 'FEMALE' ? 'selected' : ''; ?>>FEMALE</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid gender.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-0 mb-3">
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="purok_<?= $candidate_id ?>">Purok</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="purok_<?= $candidate_id ?>" name="purok" type="number"  value="<?= $stage_name ?>" required>
                                    <div class="invalid-feedback">
                                        Please input a valid purok number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="barangay_<?= $candidate_id ?>">Barangay</label>
                                </div>
                                <div class="col-12">
                                    <select name="barangay" class="form-control custom-readonly-input form-select custom-select" id="barangay_<?= $candidate_id ?>" required>
                                        <option value="" disabled>Select a barangay</option>
                                        <option value="BANCAL" <?php echo $barangay == 'BANCAL' ? 'selected' : ''; ?>>Bancal</option>
                                        <option value="Bangan" <?php echo $barangay == 'Bangan' ? 'selected' : ''; ?>>Bangan</option>
                                        <option value="Batonlapoc" <?php echo $barangay == 'Batonlapoc' ? 'selected' : ''; ?>>Batonlapoc</option>
                                        <option value="Belbel" <?php echo $barangay == 'Belbel' ? 'selected' : ''; ?>>Belbel</option>
                                        <option value="Beneg" <?php echo $barangay == 'Beneg' ? 'selected' : ''; ?>>Beneg</option>
                                        <option value="Binuclutan" <?php echo $barangay == 'Binuclutan' ? 'selected' : ''; ?>>Binuclutan</option>
                                        <option value="Burgos" <?php echo $barangay == 'Burgos' ? 'selected' : ''; ?>>Burgos</option>
                                        <option value="Cabatuan" <?php echo $barangay == 'Cabatuan' ? 'selected' : ''; ?>>Cabatuan</option>
                                        <option value="Capayawan" <?php echo $barangay == 'Capayawan' ? 'selected' : ''; ?>>Capayawan</option>
                                        <option value="Carael" <?php echo $barangay == 'Carael' ? 'selected' : ''; ?>>Carael</option>
                                        <option value="Danacbunga" <?php echo $barangay == 'Danacbunga' ? 'selected' : ''; ?>>Danacbunga</option>
                                        <option value="Maguisguis" <?php echo $barangay == 'Maguisguis' ? 'selected' : ''; ?>>Maguisguis</option>
                                        <option value="Malomboy" <?php echo $barangay == 'Malomboy' ? 'selected' : ''; ?>>Malomboy</option>
                                        <option value="Mambog" <?php echo $barangay == 'Mambog' ? 'selected' : ''; ?>>Mambog</option>
                                        <option value="Moraza" <?php echo $barangay == 'Moraza' ? 'selected' : ''; ?>>Moraza</option>
                                        <option value="Nacolcol" <?php echo $barangay == 'Nacolcol' ? 'selected' : ''; ?>>Nacolcol</option>
                                        <option value="Owaog-Nibloc" <?php echo $barangay == 'Owaog-Nibloc' ? 'selected' : ''; ?>>Owaog-Nibloc</option>
                                        <option value="Paco (poblacion)" <?php echo $barangay == 'Paco (poblacion)' ? 'selected' : ''; ?>>Paco (poblacion)</option>
                                        <option value="Palis" <?php echo $barangay == 'Palis' ? 'selected' : ''; ?>>Palis</option>
                                        <option value="Panan" <?php echo $barangay == 'Panan' ? 'selected' : ''; ?>>Panan</option>
                                        <option value="Parel" <?php echo $barangay == 'Parel' ? 'selected' : ''; ?>>Parel</option>
                                        <option value="Paudpod" <?php echo $barangay == 'Paudpod' ? 'selected' : ''; ?>>Paudpod</option>
                                        <option value="Poonbato" <?php echo $barangay == 'Poonbato' ? 'selected' : ''; ?>>Poonbato</option>
                                        <option value="Porac" <?php echo $barangay == 'Porac' ? 'selected' : ''; ?>>Porac</option>
                                        <option value="San Isidro" <?php echo $barangay == 'San Isidro' ? 'selected' : ''; ?>>San Isidro</option>
                                        <option value="San Juan" <?php echo $barangay == 'San Juan' ? 'selected' : ''; ?>>San Juan</option>
                                        <option value="San Miguel" <?php echo $barangay == 'San Miguel' ? 'selected' : ''; ?>>San Miguel</option>
                                        <option value="Santiago" <?php echo $barangay == 'Santiago' ? 'selected' : ''; ?>>Santiago</option>
                                        <option value="Tampo (poblacion)" <?php echo $barangay == 'Tampo (poblacion)' ? 'selected' : ''; ?>>Tampo (poblacion)</option>
                                        <option value="Taugtog" <?php echo $barangay == 'Taugtog' ? 'selected' : ''; ?>>Taugtog</option>
                                        <option value="Villar" <?php echo $barangay == 'Villar' ? 'selected' : ''; ?>>Villar</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid barangay.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row px-0 mb-3">
                            <div class="col-sm-6 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="birthdate_<?= $candidate_id ?>">Birthdate</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="birthdate_<?= $candidate_id ?>" name="birthdate" type="date" required>
                                    <div class="invalid-feedback">
                                        Please input a valid birthdate.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="civil_status_<?= $candidate_id ?>">Civil Status</label>
                                </div>
                                <div class="col-12">
                                    <select name="civil_status" class="form-control custom-readonly-input form-select custom-select" id="civil_status_<?= $candidate_id ?>" required>
                                       <option value="" selected disabled>Select a civil status</option>
                                       <option value="SINGLE">SINGLE</option>
                                       <option value="MARRIED">MARRIED</option>
                                       <option value="WIDOWED">WIDOWED</option>
                                       <option value="DIVORCED">DIVORCED</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid civil status.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row px-0 mb-3">
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="occupation_<?= $candidate_id ?>">Occupation</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="occupation_<?= $candidate_id ?>" name="occupation" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid occupation.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="contact_number_<?= $candidate_id ?>">Contact Number</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="contact_number_<?= $candidate_id ?>" name="contact_number" type="number" required>
                                    <div class="invalid-feedback">
                                        Please input a valid contact number.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row px-0">
                            <div class="col-12 form-group">
                                <p class="px-2">Picture</p>
                                <div class="row mb-3 justify-content-center">
                                    <div class="col-6 d-flex justify-content-center align-items-center">
                                        <div class="image-preview-container" style="width: auto; height: auto; overflow: hidden;">
                                            <img class="img-fluid rounded" id="profilePreview" src="../pictures/profile.jpg" alt="Picture Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-12 text-center">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-control" id="profileUpload" name="profile" aria-describedby="inputuploadAddon" accept="image/png, image/gif, image/jpeg">
                                            <label class="custom-file-label" id="profileLabel" for="profileUpload">Choose an image</label>
                                        </div>
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
