<!-- Add -->
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row float-left ml-2">
                    <h4 class="modal-title float-left text-success" id="myModalLabel">
                        <i class="fas fa-plus fa-sm"></i> ADD NEW CANDIDATE
                    </h4>
                </div>
                <div class="row float-right mr-2"><button type="button" class="close float-right" data-dismiss="modal" aria-hidden="true">&times;</button></div>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row px-0 mb-3">
                            <div class="col-lg-3 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="first_name">First Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="first_name" name="first_name" type="text" required>
                                    <div class="invalid-feedback">
                                        Please choose a valid first name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="middle_name">Middle Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="middle_name" name="middle_name" type="text">
                                    <div class="invalid-feedback">
                                        Please input a valid middle name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="last_name">Last Name</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="last_name" name="last_name" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid last name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="suffix_name">Suffix</label>
                                </div>
                                <div class="col-12">
                                    <select name="suffix_name" class="form-control custom-readonly-input form-select custom-select" id="suffix_name" required>
                                       <option value="n/a" selected>N/A</option>
                                       <option value="jr">JR</option>
                                       <option value="sr">SR</option>
                                       <option value="iii">III</option>
                                       <option value="iv">IV</option>
                                       <option value="v">V</option>
                                       <option value="vi">VI</option>
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
                                    <label class="control-label modal-label my-auto" for="stage_name">Stage Name (Nickname)</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="stage_name" name="stage_name" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid stage name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="gender">Gender</label>
                                </div>
                                <div class="col-12">
                                    <select name="gender" class="form-control custom-readonly-input form-select custom-select" id="gender" required>
                                       <option value="" selected disabled>Select a gender</option>
                                       <option value="MALE">MALE</option>
                                       <option value="FEMALE">FEMALE</option>
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
                                    <label class="control-label modal-label my-auto" for="purok">Purok</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="purok" name="purok" type="number" required>
                                    <div class="invalid-feedback">
                                        Please input a valid purok number.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="barangay">Barangay</label>
                                </div>
                                <div class="col-12">
                                    <select name="barangay" class="form-control custom-readonly-input form-select custom-select" id="barangay" required>
                                         <option value="" disabled selected>Select a barangay</option>
                                         <option value="Bancal">Bancal</option>
                                         <option value="Bangan">Bangan</option>
                                         <option value="Batonlapoc">Batonlapoc</option>
                                         <option value="Belbel">Belbel</option>
                                         <option value="Beneg">Beneg</option>
                                         <option value="Binuclutan">Binuclutan</option>
                                         <option value="Burgos">Burgos</option>
                                         <option value="Cabatuan">Cabatuan</option>
                                         <option value="Capayawan">Capayawan</option>
                                         <option value="Carael">Carael</option>
                                         <option value="Danacbunga">Danacbunga</option>
                                         <option value="Maguisguis">Maguisguis</option>
                                         <option value="Malomboy">Malomboy</option>
                                         <option value="Mambog">Mambog</option>
                                         <option value="Moraza">Moraza</option>
                                         <option value="Nacolcol">Nacolcol</option>
                                         <option value="Owaog-Nibloc">Owaog-Nibloc</option>
                                         <option value="Paco (poblacion)">Paco (poblacion)</option>
                                         <option value="Palis">Palis</option>
                                         <option value="Panan">Panan</option>
                                         <option value="Parel">Parel</option>
                                         <option value="Paudpod">Paudpod</option>
                                         <option value="Poonbato">Poonbato</option>
                                         <option value="Porac">Porac</option>
                                         <option value="San Isidro">San Isidro</option>
                                         <option value="San Juan">San Juan</option>
                                         <option value="San Miguel">San Miguel</option>
                                         <option value="Santiago">Santiago</option>
                                         <option value="Tampo (poblacion)">Tampo (poblacion)</option>
                                         <option value="Taugtog">Taugtog</option>
                                         <option value="Villar">Villar</option>
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
                                    <label class="control-label modal-label my-auto" for="birthdate">Birthdate</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="birthdate" name="birthdate" type="date" required>
                                    <div class="invalid-feedback">
                                        Please input a valid birthdate.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="civil_status">Civil Status</label>
                                </div>
                                <div class="col-12">
                                    <select name="civil_status" class="form-control custom-readonly-input form-select custom-select" id="civil_status" required>
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
                                    <label class="control-label modal-label my-auto" for="occupation">Occupation</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="occupation" name="occupation" type="text" required>
                                    <div class="invalid-feedback">
                                        Please input a valid occupation.
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 form-group mb-3">
                                <div class="col-12 d-flex">
                                    <label class="control-label modal-label my-auto" for="contact_number">Contact Number</label>
                                </div>
                                <div class="col-12">
                                    <input class="form-control custom-readonly-input" id="contact_number" name="contact_number" type="number" required>
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
                    <button type="submit" name="edit" class="btn btn-success col-12 col-sm-3" id="addCandidate">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
