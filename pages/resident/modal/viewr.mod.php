<div class="modal fade" id="viewr<?php echo htmlspecialchars($row['id']) ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">View Resident</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-6 col-sm-12">
                  <input type="hidden" value="<?php echo htmlspecialchars($row['id']) ?>" name="hidden_id"
                    id="hidden_id">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-4">
                        <label class="form-label" for="firstName">First name</label>
                        <input class="form-control" type="text"
                          value="<?php echo htmlspecialchars($row['resident_fname']) ?>" readonly>
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="middleName">Middle name</label>
                        <input class="form-control" type="text"
                          value="<?php echo htmlspecialchars($row['resident_mname']) ?>" readonly>
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="lastName">Last name</label>
                        <input class="form-control" type="text"
                          value="<?php echo htmlspecialchars($row['resident_lname']) ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label" for="editBirthDate">Birthdate</label>
                        <input class="form-control" type="text" data-inputmask-alias="datetime"
                          data-inputmask-inputformat="mm/dd/yyyy" placeholder="mm/dd/yyyy"
                          value="<?php echo htmlspecialchars($row['resident_birth_date']) ?>" data-mask readonly>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Gender</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_gender']))) ?>
                          </option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Household #</label>
                        <input class="form-control" type="number"
                          value="<?php echo htmlspecialchars($row['resident_household_num']) ?>" readonly>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Total Household Member</label>
                        <input class="form-control" type="number"
                          value="<?php echo htmlspecialchars($row['resident_total_household_mem']) ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Civil Status</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_civil_status']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Blood Type</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected>
                            <?php echo strtoupper(htmlspecialchars($row['resident_blood_type'])) ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your blood type</label>
                        <input type="text" class="form-control cstm_crsr" placeholder="Please specify your blood type"
                          disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Rent a House</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_renter']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Religion</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_religion']))) ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your religion</label>
                        <input type="text" class="form-control cstm_crsr" placeholder="Please specify your gender"
                          disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nationality</label>
                    <input class="form-control" type="text"
                      value="<?php echo htmlspecialchars($row['resident_nationality']) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Women of Reproductive Age (15-49)</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_wra']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Educational Attainment</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_educational_attainment']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Type of Garbage Disposal</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_type_of_garbage_disposal']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Interviewed by</label>
                    <input type="text" class="form-control"
                      value="<?php echo htmlspecialchars($row['resident_interview_by']) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Mobile #</label>
                    <input type="text" class="form-control"
                      value="<?php echo htmlspecialchars($row['resident_mobile_num']) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input type="text" class="form-control"
                      value="<?php echo htmlspecialchars($row['resident_email_add']) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Username</label>
                    <input class="form-control" type="text"
                      value="<?php echo htmlspecialchars($row['resident_uname']) ?>" readonly>
                    <label></label>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Birthplace</label>
                    <input class="form-control" type="text"
                      value="<?php echo htmlspecialchars($row['resident_birth_place']) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Purok</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_purok']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Tribe</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_tribe']))) ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your tribe</label>
                        <input type="text" class="form-control cstm_crsr" placeholder="Please specify your tribe"
                          disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">IP’s Member</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_ips']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Health Status</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_health_status']))) ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your health status</label>
                        <input type="text" class="form-control cstm_crsr"
                          placeholder="Please specify your health status" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Length of Stay in Months</label>
                    <input class="form-control" type="number"
                      value="<?php echo htmlspecialchars($row['resident_length_of_stay']) ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Relationship to the Head of the Family</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_relationship_to_head']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Occupation</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_occupation']))) ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your occupation</label>
                        <input type="text" class="form-control cstm_crsr" placeholder="Please specify your occupation"
                          disabled>
                      </div>
                    </div>
                  </div>
                  <?php
                  $selectedSources = explode(', ', $row['resident_sources_of_water_supply']) ?>
                  <div class="form-group"><label class="control-label">Sources of Water Supply for
                      Drinking</label>
                    <select class="form-control select2" multiple
                      data-placeholder="Please select you sources of water supply" disabled>
                      <?php
                      $options = [
                        'Community water system',
                        'Developed spring',
                        'Protected well',
                        'Truck/tanker peddler',
                        'Bottled water',
                        'Undevelop spring',
                        'Unprotected well',
                        'Rainwater',
                        'Stream or dam',
                        'River'
                      ];
                      foreach ($options as $option) {
                        $optionLowercase = strtolower($option);
                        $selectedOption = in_array($optionLowercase, $selectedSources) ? 'selected' : '' ?>
                        <option <?php echo htmlspecialchars($selectedOption) ?>><?php echo htmlspecialchars($option) ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Types of Toilet</label>
                        <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_types_of_toilet']))) ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify the types of Toilet</label>
                        <input type="text" class="form-control cstm_crsr" placeholder="Please specify types of toilet"
                          disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">With Blind Drainage</label>
                    <select class="form-control select2" data-minimum-results-for-search="Infinity" disabled>
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_blind_drainage']))) ?>
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image_file">Image</label>
                    <div class="input-group d-flex align-items-center justify-content-between">
                      <image src="images/<?php echo htmlspecialchars(basename($row['resident_image'])) ?>"
                        class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </form>
</div>