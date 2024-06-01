<div class="modal fade" id="edit<?php echo htmlspecialchars($row['id']) ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Resident</h4>
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
                        <input name="txt_edit_resident_fname" class="form-control" type="text" id="firstName"
                          value="<?php echo htmlspecialchars($row['resident_fname']) ?>" autofocus>
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="middleName">Middle name</label>
                        <input name="txt_edit_resident_mname" class="form-control" type="text" id="middleName"
                          value="<?php echo htmlspecialchars($row['resident_mname']) ?>">
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="lastName">Last name</label>
                        <input name="txt_edit_resident_lname" class="form-control" type="text" id="lastName"
                          value="<?php echo htmlspecialchars($row['resident_lname']) ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label" for="editBirthDate">Birthdate</label>
                        <input name="txt_edit_resident_birth_date" class="form-control editBirthDate" type="text"
                          data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy"
                          placeholder="mm/dd/yyyy" value="<?php echo htmlspecialchars($row['resident_birth_date']) ?>"
                          data-mask data-user-id="<?php echo htmlspecialchars($row['id']) ?>">
                      </div>
                      <div class="col-6">
                        <label class="control-label">Gender</label>
                        <select name="txt_edit_resident_gender" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_gender']))) ?>
                          </option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Household #</label>
                        <input name="txt_edit_resident_household_num" class="form-control" type="number" min="1"
                          title="Please enter your household number"
                          value="<?php echo htmlspecialchars($row['resident_household_num']) ?>">
                      </div>
                      <div class="col-6">
                        <label class="control-label">Total Household Member</label>
                        <input name="txt_edit_resident_total_household_mem" class="form-control" type="number" min="1"
                          max="25" title="Please enter the total household member of your household"
                          value="<?php echo htmlspecialchars($row['resident_total_household_mem']) ?>">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Civil Status</label>
                    <select name="txt_edit_resident_civil_stat" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_civil_status']))) ?>
                      </option>
                      <option value="married">Married</option>
                      <option value="single">Single</option>
                      <option value="widow/widower">Widow/widower</option>
                      <option value="separated">Separated</option>
                      <option value="live-in">Live-in</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Blood Type</label>
                        <select name="txt_edit_resident_blood_type" class="form-control select2 editBloodTypeSelect"
                          data-minimum-results-for-search="Infinity">
                          <option selected>
                            <?php echo strtoupper(htmlspecialchars($row['resident_blood_type'])) ?>
                          </option>
                          <option value="a+">A+</option>
                          <option value="a-">A-</option>
                          <option value="b+">B+</option>
                          <option value="b-">B-</option>
                          <option value="ab+">AB+</option>
                          <option value="ab-">AB-</option>
                          <option value="o+">O+</option>
                          <option value="o-">O-</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your blood type</label>
                        <input type="text" name="txt_edit_resident_blood_type"
                          class="form-control cstm_crsr editBloodTypeSpecified"
                          placeholder="Please specify your blood type" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Rent a House</label>
                    <select name="txt_edit_resident_renter" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_renter']))) ?>
                      </option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Religion</label>
                        <select name="txt_edit_resident_religion" class="form-control select2 editReligionSelect"
                          data-minimum-results-for-search="Infinity">
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_religion']))) ?>
                          </option>
                          <option value="roman catholic">Roman catholic</option>
                          <option value="muslim">Muslim</option>
                          <option value="iglesia ni cristo">Iglesia ni cristo</option>
                          <option value="christianity">Christianity</option>
                          <option value="baptist">Baptist</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your religion</label>
                        <input type="text" name="txt_edit_resident_religion"
                          class="form-control cstm_crsr editReligionSpecified"
                          placeholder="Please specify your religion" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nationality</label>
                    <input name="txt_edit_resident_nationality" class="form-control" type="text"
                      value="<?php echo htmlspecialchars($row['resident_nationality']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Women of Reproductive Age (15-49)</label>
                    <select name="txt_edit_resident_wra" class="form-control select2 editFamilyPlanningMethod"
                      data-minimum-results-for-search="Infinity" title="Please, edit first the birth date to enable"
                      disabled data-user-id="<?php echo htmlspecialchars($row['id']) ?>">
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_wra']))) ?>
                      </option>
                      <option value="bilateral tubal ligation">Bilateral tubal ligation</option>
                      <option value="vasectomy">Vasectomy</option>
                      <option value="pills">Pills</option>
                      <option value="condom">Condom</option>
                      <option value="intra-uterine device">Intra-uterine device</option>
                      <option value="injectable">Injectable</option>
                      <option value="standard days method">Standard days method</option>
                      <option value="basal body temp">Basal body temp</option>
                      <option value="sympto thermal method">Sympto thermal method</option>
                      <option value="lactating amenorrhea">Lactating amenorrhea</option>
                      <option value="cervical mucus">Cervical mucus</option>
                      <option value="implant">Implant</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Educational Attainment</label>
                    <select name="txt_edit_resident_educational_attain" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_educational_attainment']))) ?>
                      </option>
                      <option value="no schooling completed">No schooling completed</option>
                      <option value="elementary level">Elementary level</option>
                      <option value="elementary graduate">Elementary graduate</option>
                      <option value="high school level">High school level</option>
                      <option value="high school graduate">High school graduate</option>
                      <option value="vocational">Vocational</option>
                      <option value="college level">College level</option>
                      <option value="college graduate">College graduate</option>
                      <option value="post graduate">Post graduate</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Type of Garbage Disposal</label>
                    <select name="txt_edit_resident_type_of_garbage_dispos" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_type_of_garbage_disposal']))) ?>
                      </option>
                      <option value="burying">Burying</option>
                      <option value="composting">Composting</option>
                      <option value="collection system">Collection system</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Interviewed by</label>
                    <input type="text" name="txt_edit_resident_interview_by" class="form-control"
                      value="<?php echo htmlspecialchars($row['resident_interview_by']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="txt_edit_resident_email_add" class="form-control" type="email"
                      value="<?php echo htmlspecialchars($row['resident_email_add']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Username</label>
                    <input name="txt_edit_resident_uname" class="form-control" type="text"
                      value="<?php echo htmlspecialchars($row['resident_uname']) ?>">
                    <label></label>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Birthplace</label>
                    <input name="txt_edit_resident_birt_place" class="form-control" type="text"
                      value="<?php echo htmlspecialchars($row['resident_birth_place']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Purok</label>
                    <select name="txt_edit_resident_purok" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_purok']))) ?>
                      </option>
                      <option value="alacta">Alacta</option>
                      <option value="alaska">Alaska</option>
                      <option value="alpine">Alpine</option>
                      <option value="bearbrand">Bearbrand</option>
                      <option value="carnation">Carnation</option>
                      <option value="liberty">Liberty</option>
                      <option value="nido">Nido</option>
                      <option value="sustagen">Sustagen</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Tribe</label>
                        <select name="txt_edit_resident_tribe" class="form-control select2 editTribeSelect"
                          data-minimum-results-for-search="Infinity">
                          <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_tribe']))) ?>
                          </option>
                          <option value="bisaya">Bisaya</option>
                          <option value="tagalog">Tagalog</option>
                          <option value="ilonggo">Ilonggo</option>
                          <option value="cebuano">Cebuano</option>
                          <option value="manobo">Manobo</option>
                          <option value="lumad">Lumad</option>
                          <option value="badjao">Badjao</option>
                          <option value="mandaya">Mandaya</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your tribe</label>
                        <input type="text" name="txt_edit_resident_tribe"
                          class="form-control cstm_crsr editTribeSpecified" placeholder="Please specify your tribe"
                          disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">IP’s Member</label>
                    <select name="txt_edit_resident_ips" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected><?php echo ucfirst(strtolower(htmlspecialchars($row['resident_ips']))) ?>
                      </option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Health Status</label>
                        <select name="txt_edit_resident_health_stat" class="form-control select2 editHealthStatusSelect"
                          data-minimum-results-for-search="Infinity">
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_health_status']))) ?>
                          </option>
                          <option value="hypertension">Hypertension</option>
                          <option value="diabetes mellitus">Diabetes mellitus</option>
                          <option value="tuberculosis">Tuberculosis</option>
                          <option value="cancer">Cancer</option>
                          <option value="mental illness">Mental illness</option>
                          <option value="persons with disability">Persons with disability</option>
                          <option value="smokers">Smokers</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your health status</label>
                        <input type="text" name="txt_edit_resident_health_stat"
                          class="form-control cstm_crsr editHealthStatusSpecified"
                          placeholder="Please specify your health status" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Length of Stay in Months</label><br>
                    <input name="txt_edit_resident_length_of_stay" class="form-control" type="number" min="0"
                      value="<?php echo htmlspecialchars($row['resident_length_of_stay']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Relationship to the Head of the Family</label>
                    <select name="txt_edit_resident_relationship_to_head" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_relationship_to_head']))) ?>
                      </option>
                      <option value="spouse">Spouse</option>
                      <option value="child">Child</option>
                      <option value="live-in partner">Live-in partner</option>
                      <option value="co-wife">Co-wife</option>
                      <option value="son-in-law">Son-in-law</option>
                      <option value="daughter-in-law">Daughter-in-law</option>
                      <option value="parent">Parent</option>
                      <option value="sibling">Sibling</option>
                      <option value="grandparent">Grandparent</option>
                      <option value="grandchild">Grandchild</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Occupation</label>
                        <select name="txt_edit_resident_occupation" class="form-control select2 editOccupationSelect"
                          data-minimum-results-for-search="Infinity">
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_occupation']))) ?>
                          </option>
                          <option value="government employee">Government employee</option>
                          <option value="private employee">Private employee</option>
                          <option value="farmer">Farmer</option>
                          <option value="fisherman">Fisherman</option>
                          <option value="housekeeper/housewife">Housekeeper/housewife</option>
                          <option value="laborer/construction worker">Laborer/construction worker</option>
                          <option value="vendor">Vendor</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your occupation</label>
                        <input type="text" name="txt_edit_resident_occupation"
                          class="form-control cstm_crsr editOccupationSpecified"
                          placeholder="Please specify your occupation" disabled>
                      </div>
                    </div>
                  </div>
                  <?php
                  $selectedSources = explode(', ', $row['resident_sources_of_water_supply']) ?>
                  <div class="form-group"><label class="control-label">Sources of Water Supply for
                      Drinking</label>
                    <select name="txt_edit_resident_sources_of_water_supp[]" class="form-control select2" multiple
                      data-placeholder="Please select you sources of water supply">
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
                        <option value="<?php echo htmlspecialchars($optionLowercase) ?>" <?php echo htmlspecialchars($selectedOption) ?>>
                          <?php echo htmlspecialchars($option) ?>
                        </option>
                        <?php
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Types of Toilet</label>
                        <select name="txt_edit_resident_types_of_toilet"
                          class="form-control select2 editTypesOfToiletSelect"
                          data-minimum-results-for-search="Infinity">
                          <option selected>
                            <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_types_of_toilet']))) ?>
                          </option>
                          <option value="water sealed/flush toilet">Water sealed/flush toilet</option>
                          <option value="closed pit privy">Closed pit privy</option>
                          <option value="open pit privy">Open pit privy</option>
                          <option value="communal toilet">Communal toilet</option>
                          <option value="drop/overhung">Drop/overhung</option>
                          <option value="field/body of water">Field/body of water</option>
                          <option value="others">Others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify the types of Toilet</label>
                        <input type="text" name="txt_edit_resident_types_of_toilet"
                          class="form-control cstm_crsr editTypesOfToiletSpecified"
                          placeholder="Please specify types of toilet" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">With Blind Drainage</label>
                    <select name="txt_edit_resident_blind_drainage" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected>
                        <?php echo ucfirst(strtolower(htmlspecialchars($row['resident_blind_drainage']))) ?>
                      </option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image_file">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="txt_edit_resident_image" type="file" class="custom-file-input" id="image_file"
                          value="<?php echo htmlspecialchars($row['resident_image']) ?>">
                        <label class="custom-file-label" for="image_file">Please browse your new image if needed</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Mobile #</label>
                    <input name="txt_edit_resident_mobile_num" type="text" id="txtEditResMobNum" class="form-control"
                      value="<?php echo htmlspecialchars($row['resident_mobile_num']) ?>">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input name="txt_edit_resident_upass" class="form-control" type="password"
                      placeholder="Please enter your new password if needed">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_edit">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  $(document).ready(function () {
    function editHandleSpecifiedInput(editDropdownClass, editSpecifiedClass) {
      // add an event listener to the select element with the specified class
      $(document).on('change', editDropdownClass, function () {
        // get the selected value
        var editSelectedValue = $(this).val();
        // get the corresponding input field for specifying using the specified class
        var editSpecifiedInput = $(this).closest('.row').find(editSpecifiedClass);
        // if the selected value is others
        // enable the input
        // otherwise
        // disable the input
        editSpecifiedInput.prop(
          "disabled",
          editSelectedValue.toLowerCase() !== "others"
        );
        // add or remove a class based on the disabled status
        if (editSpecifiedInput.prop("disabled")) {
          editSpecifiedInput.addClass("cstm_crsr");
        } else {
          editSpecifiedInput.removeClass("cstm_crsr");
        }
        // clear the value of the input field
        editSpecifiedInput.val("");
      });
    }
    // handle specified inputs for each set of dropdown and specified input using classes
    editHandleSpecifiedInput(".editOccupationSelect", ".editOccupationSpecified");
    editHandleSpecifiedInput(".editTypesOfToiletSelect", ".editTypesOfToiletSpecified");
    editHandleSpecifiedInput(".editHealthStatusSelect", ".editHealthStatusSpecified");
    editHandleSpecifiedInput(".editTribeSelect", ".editTribeSpecified");
    editHandleSpecifiedInput(".editBloodTypeSelect", ".editBloodTypeSpecified");
    editHandleSpecifiedInput(".editReligionSelect", ".editReligionSpecified");
  });

  // it checks whether the wra is below 15 or above 49 based on the users birthdate
  $(document).ready(function () {
    // function to handle birthdate change for a specific user
    function editHandleBirthDateChange(editBirthDateInput, editFamilyPlanningMethodSelect) {
      const editBirthDateString = editBirthDateInput.val();
      if (!editBirthDateString || editBirthDateString.length <= 8) {
        editFamilyPlanningMethodSelect.prop('disabled', true);
        editFamilyPlanningMethodSelect.val('default').trigger('change');
        if (!editFamilyPlanningMethodSelect.find('option[value="default"]').length) {
          const editDefaultOption = $('<option>', {
            value: 'default',
            text: 'Please select family planning method',
            disabled: true,
            selected: true,
          });
          editFamilyPlanningMethodSelect.prepend(editDefaultOption);
        }
      } else {
        const parts = editBirthDateString.split('/');
        const editBirthDate = new Date(parts[2], parts[0] - 1, parts[1]);
        const today = new Date();
        const age = today.getFullYear() - editBirthDate.getFullYear();
        if (age >= 15 && age <= 49) {
          editFamilyPlanningMethodSelect.prop('disabled', false);
          editFamilyPlanningMethodSelect.find('option[value="default"]').remove();
        } else {
          editFamilyPlanningMethodSelect.prop('disabled', true);
          editFamilyPlanningMethodSelect.val('default').trigger('change');
          if (!editFamilyPlanningMethodSelect.find('option[value="default"]').length) {
            const editDefaultOption = $('<option>', {
              value: 'default',
              text: 'Please select family planning method',
              disabled: true,
              selected: true,
            });
            editFamilyPlanningMethodSelect.prepend(editDefaultOption);
          }
        }
      }
    }

    // iterate over each user's birthdate input and family planning method select
    $('.editBirthDate').each(function () {
      const editBirthDateInput = $(this);
      const userId = editBirthDateInput.data('user-id'); // add a data attribute to store user id
      const editFamilyPlanningMethodSelect = $('.editFamilyPlanningMethod[data-user-id="' + userId + '"]');

      // trigger the input event for each user
      editBirthDateInput.on('input', function () {
        editHandleBirthDateChange(editBirthDateInput, editFamilyPlanningMethodSelect);
      });

      // trigger the input event manually to initialize the state
      editHandleBirthDateChange(editBirthDateInput, editFamilyPlanningMethodSelect);
    });
  });
</script>