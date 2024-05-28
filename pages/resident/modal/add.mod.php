<div class="modal fade" id="addModal">
  <form id="form" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Residents</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-4">
                        <label class="form-label" for="firstName">First name</label>
                        <input name="txt_add_resident_fname" class="form-control" type="text" id="firstName"
                          placeholder="Your first name" autofocus>
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="middleName">Middle name</label>
                        <input name="txt_add_resident_mname" class="form-control" type="text" id="middleName"
                          placeholder="Your middle name">
                      </div>
                      <div class="col-4">
                        <label class="form-label" for="lastName">Last name</label>
                        <input name="txt_add_resident_lname" class="form-control" type="text" id="lastName"
                          placeholder="Your last name">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label" for="addBirthDate">Birthdate</label>
                        <input name="txt_add_resident_birth_date" id="addBirthDate" class="form-control" type="text"
                          data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy"
                          placeholder="mm/dd/yyyy" data-mask>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Gender</label>
                        <select name="txt_add_resident_gender" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select your gender</option>
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
                        <input name="txt_add_resident_household_num" class="form-control" type="number" min="1"
                          placeholder="Please enter a household #">
                      </div>
                      <div class="col-6">
                        <label class="control-label">Total Household Member</label>
                        <input name="txt_add_resident_total_household_mem" class="form-control" type="number"
                          placeholder="Please enter a total household mem">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Civil Status</label>
                    <select name="txt_add_resident_civil_stat" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your civil status</option>
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
                        <select name="txt_add_resident_blood_type" id="addBloodTypeSelect" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select blood type</option>
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
                        <input type="text" name="txt_add_resident_blood_type" id="addBloodTypeSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your blood type" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Rent a House</label>
                    <select name="txt_add_resident_renter" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select the housing status</option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Religion</label>
                        <select name="txt_add_resident_religion" id="addReligionSelect" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select your religion</option>
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
                        <input type="text" name="txt_add_resident_religion" id="addReligionSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your religion" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Nationality</label>
                    <input name="txt_add_resident_nationality" class="form-control" type="text"
                      placeholder="Please select your nationality">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Women of Reproductive Age (15-49)</label>
                    <select name="txt_add_resident_wra" id="addFamilyPlanningMethod" class="form-control select2"
                      data-minimum-results-for-search="Infinity" disabled>
                      <option selected disabled>Please select family planning method</option>
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
                    <select name="txt_add_resident_educational_attain" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your educational attainment</option>
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
                    <select name="txt_add_resident_type_of_garbage_dispos" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select types of garbage disposal</option>
                      <option value="burying">Burying</option>
                      <option value="composting">Composting</option>
                      <option value="collection system">Collection system</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Interviewed by</label>
                    <input type="text" name="txt_add_resident_interview_by" class="form-control"
                      placeholder="Please enter the name of your interviewer">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <input name="txt_add_resident_email_add" class="form-control" type="email"
                      placeholder="Please enter your valid and active email">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Username</label>
                    <input name="txt_add_resident_uname" id="add_username" class="form-control" type="text"
                      placeholder="Please enter your username">
                    <label id="add_user_msg"></label>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Birthplace</label>
                    <input name="txt_add_resident_birt_place" class="form-control" type="text"
                      placeholder="Please enter your birth place">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Purok</label>
                    <select name="txt_add_resident_purok" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your purok</option>
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
                        <select name="txt_add_resident_tribe" id="addTribeSelect" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select your tribe</option>
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
                        <input type="text" name="txt_add_resident_tribe" id="addTribeSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your tribe" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">IP's Member</label>
                    <select name="txt_add_resident_ips" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your ips</option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Health Status</label>
                        <select name="txt_add_resident_health_stat" id="addHealthStatusSelect"
                          class="form-control select2" data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select your health status</option>
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
                        <input type="text" name="txt_add_resident_health_stat" id="addHealthStatusSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your health status" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Length of Stay in Months</label><br>
                    <input name="txt_add_resident_length_of_stay" class="form-control" type="number" min="0"
                      placeholder="Length of Stay">
                  </div>
                  <div class="form-group">
                    <label class="control-label">Relationship to the Head of the Family</label>
                    <select name="txt_add_resident_relationship_to_head" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select your relationship</option>
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
                        <select name="txt_add_resident_occupation" id="addOccupationSelect" class="form-control select2"
                          data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select your occupation</option>
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
                        <input type="text" name="txt_add_resident_occupation" id="addOccupationSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your occupation" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Sources of Water Supply for Drinking</label>
                    <select name="txt_add_resident_sources_of_water_supp[]" class="form-control select2"
                      data-placeholder="Please select your sources of water supply" multiple>
                      <option value="community water system">Community water system</option>
                      <option value="developed spring">Developed spring</option>
                      <option value="protected well">Protected well</option>
                      <option value="truck/tanker peddler">Truck/tanker peddler</option>
                      <option value="bottled water">Bottled water</option>
                      <option value="undevelop spring">Undevelop spring</option>
                      <option value="unprotected well">Unprotected well</option>
                      <option value="rainwater">Rainwater</option>
                      <option value="stream or dam">Stream or dam</option>
                      <option value="river">River</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Types of Toilet</label>
                        <select name="txt_add_resident_types_of_toilet" id="addTypesOfToiletSelect"
                          class="form-control select2" data-minimum-results-for-search="Infinity">
                          <option selected disabled>Please select types of toilet</option>
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
                        <input type="text" name="txt_add_resident_types_of_toilet" id="addTypesOfToiletSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify types of toilet" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">With Blind Drainage</label>
                    <select name="txt_add_resident_blind_drainage" class="form-control select2"
                      data-minimum-results-for-search="Infinity">
                      <option selected disabled>Please select the status of blind drainage</option>
                      <option value="yes">Yes</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="image_file">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="txt_add_resident_image" type="file" class="custom-file-input" id="image_file">
                        <label class="custom-file-label" for="image_file">Please browse your image</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Mobile #</label>
                    <input name="txt_add_resident_mobile_num" type="text" id="txtAddResMobNum" class="form-control"
                      placeholder="Please enter your active mobile number" data-mask>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input name="txt_add_resident_upass" class="form-control" type="password"
                      placeholder="Please enter your password">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btn_add" id="btn_add">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>

<script>
  $(document).ready(function () {
    $('#txtAddResMobNum').on('input', function () {
      var enteredNumber = $(this).val();

      // check if the entered number has reached the desired length
      if (enteredNumber.length === 11) {
        // check if the entered number starts with '0'
        if (enteredNumber.startsWith('0')) {
          // remove the '0' and add '63' at the beginning
          var formattedNumber = '+63' + enteredNumber.slice(1);
          // update the input field with the formatted number
          $(this).val(formattedNumber);
          // apply input mask manually
          $(this).inputmask('9999999999999', {
            placeholder: '',
            definitions: {
              '9': {
                validator: "[0-9+]",
                cardinality: 1
              }
            }
          });
        }
      } else if (enteredNumber.length < 11) {
        // check if the entered number starts with '63'
        if (enteredNumber.startsWith('+63')) {
          // remove the '63' and add '0' at the beginning
          var formattedNumber = '0' + enteredNumber.slice(3);
          // update the input field with the formatted number
          $(this).val(formattedNumber);
        }
      }
    });
  });

  $(document).ready(function () {
    function addHandleSpecifiedInput(addDropdownId, addSpecifiedId) {
      // add an event listener to the select element
      $(addDropdownId).change(function () {
        // get the selected value
        var addSelectedValue = $(this).val();
        // get the corresponding input field for specifying
        var addSpecifiedInput = $(addSpecifiedId);

        // if the selected value is "Others, please specify"
        // enable the input
        // otherwise disable it
        addSpecifiedInput.prop(
          "disabled",
          addSelectedValue.toLowerCase() !== "others"
        );

        // add or remove a class based on the disabled status
        if (addSpecifiedInput.prop("disabled")) {
          addSpecifiedInput.addClass("cstm_crsr");
        } else {
          addSpecifiedInput.removeClass("cstm_crsr");
        }

        // clear the value of the input field
        addSpecifiedInput.val("");
      });
    }

    // handle specified inputs for each set of dropdown and specified input
    addHandleSpecifiedInput("#addOccupationSelect", "#addOccupationSpecified");
    addHandleSpecifiedInput("#addTypesOfToiletSelect", "#addTypesOfToiletSpecified");
    addHandleSpecifiedInput("#addHealthStatusSelect", "#addHealthStatusSpecified");
    addHandleSpecifiedInput("#addTribeSelect", "#addTribeSpecified");
    addHandleSpecifiedInput("#addBloodTypeSelect", "#addBloodTypeSpecified");
    addHandleSpecifiedInput("#addReligionSelect", "#addReligionSpecified");
  });

  // it checks whether the WRA is below 15 or above 49 based on the users birthdate
  $(document).ready(function () {
    // use class selector for the select element
    const addFamilyPlanningMethod = $('#addFamilyPlanningMethod');
    // function to handle birthdate change
    function addHandleBirthDateChange() {
      // get the selected birthdate
      const addBirthDateString = $('#addBirthDate').val();
      // check if the birthdate is not filled or is incomplete
      if (!addBirthDateString || addBirthDateString.length <= 8) {
        // disable the select element and set a default value
        addFamilyPlanningMethod.prop('disabled', true);
        addFamilyPlanningMethod.val('default').trigger('change'); // trigger change event
        if (!addFamilyPlanningMethod.find('option[value="default"]').length) {
          const addDefaultOption = $('<option>', {
            value: 'default',
            text: 'Please select family planning method',
            disabled: true,
            selected: true
          });
          addFamilyPlanningMethod.prepend(addDefaultOption);
        }
      } else {
        // parse the date manually
        const parts = addBirthDateString.split('/');
        const addBirthDate = new Date(parts[2], parts[0] - 1, parts[1]);
        // calculate the age
        const today = new Date();
        const age = today.getFullYear() - addBirthDate.getFullYear();
        // check if the age is between 15 and 49
        if (age >= 15 && age <= 49) {
          // enable the select element and remove the default option
          addFamilyPlanningMethod.prop('disabled', false);
          addFamilyPlanningMethod.find('option[value="default"]').remove();
        } else {
          // disable the select element
          // set a default value
          // add a default option
          addFamilyPlanningMethod.prop('disabled', true);
          addFamilyPlanningMethod.val('default').trigger('change'); // trigger change event
          if (!addFamilyPlanningMethod.find('option[value="default"]').length) {
            const addDefaultOption = $('<option>', {
              value: 'default',
              text: 'Please select family planning method',
              disabled: true,
              selected: true
            });
            addFamilyPlanningMethod.prepend(addDefaultOption);
          }
        }
      }
    }
    // trigger the input event on page load
    addHandleBirthDateChange();
    // use class selector for the birthdate input and bind the event handler
    $('#addBirthDate').on('input', addHandleBirthDateChange);
  });

  $(function () {
    // set default validator options
    $.validator.setDefaults({
      submitHandler: function () {
        const form = document.getElementById('form');
        form.submit();
      }
    });

    // initialize validation for the form
    $('#form').validate({
      rules: {
        // define validation rules for each field
        txt_add_resident_lname: {
          required: true,
          minlength: 3,
          maxlength: 50
        },
        txt_add_resident_fname: {
          required: true,
          minlength: 3,
          maxlength: 50
        },
        txt_add_resident_mname: {
          required: true
        },
        txt_add_resident_birth_date: {
          required: true
        },
        txt_add_resident_gender: {
          required: true
        },
        txt_add_resident_household_num: {
          required: true
        },
        txt_add_resident_total_household_mem: {
          required: true,
          maxlength: 2
        },
        txt_add_resident_civil_stat: {
          required: true
        },
        txt_add_resident_blood_type: {
          required: true
        },
        txt_add_resident_renter: {
          required: true
        },
        txt_add_resident_religion: {
          required: true
        },
        txt_add_resident_nationality: {
          required: true,
          minlength: 3,
          maxlength: 50
        },
        txt_add_resident_wra: {
          required: true
        },
        txt_add_resident_educational_attain: {
          required: true
        },
        txt_add_resident_type_of_garbage_dispos: {
          required: true
        },
        txt_add_resident_interview_by: {
          required: true,
          minlength: 3,
          maxlength: 100
        },
        txt_add_resident_email_add: {
          required: true,
          email: true
        },
        txt_add_resident_uname: {
          required: true,
          minlength: 3,
          maxlength: 50
        },
        txt_add_resident_birt_place: {
          required: true,
          minlength: 3,
          maxlength: 100
        },
        txt_add_resident_purok: {
          required: true
        },
        txt_add_resident_tribe: {
          required: true
        },
        txt_add_resident_ips: {
          required: true
        },
        txt_add_resident_health_stat: {
          required: true
        },
        txt_add_resident_length_of_stay: {
          required: true
        },
        txt_add_resident_relationship_to_head: {
          required: true
        },
        txt_add_resident_occupation: {
          required: true
        },
        'txt_add_resident_sources_of_water_supp[]': {
          required: true
        },
        txt_add_resident_types_of_toilet: {
          required: true
        },
        txt_add_resident_blind_drainage: {
          required: true
        },
        txt_add_resident_image: {
          required: true
        },
        txt_add_resident_mobile_num: {
          required: true
        },
        txt_add_resident_upass: {
          required: true
        },
      },

      messages: {
        // define error messages for each field
        txt_add_resident_lname: {
          required: "Please enter a last name",
          minlength: "Minlength of 3 characters",
          maxlength: "Maxlength of 50 characters"
        },
        txt_add_resident_fname: {
          required: "Please enter a first name",
          minlength: "Minlength of 3 characters",
          maxlength: "Maxlength of 50 characters"
        },
        txt_add_resident_mname: {
          required: "Please enter a n/a if n/a"
        },
        txt_add_resident_birth_date: {
          required: "Please enter a birth date"
        },
        txt_add_resident_gender: {
          required: "Please select a gender"
        },
        txt_add_resident_household_num: {
          required: "Please enter a household number"
        },
        txt_add_resident_total_household_mem: {
          required: "Please enter a total household member",
          maxlength: "Maxlength of 2 numbers"
        },
        txt_add_resident_civil_stat: {
          required: "Please select a civil status"
        },
        txt_add_resident_blood_type: {
          required: "Please select a blood type"
        },
        txt_add_resident_renter: {
          required: "Please select a housing status"
        },
        txt_add_resident_religion: {
          required: "Please select a religion"
        },
        txt_add_resident_nationality: {
          required: "Please enter a nationality",
          minlength: "Minlength of 3 characters",
          maxlength: "Maxlength of 50 characters"
        },
        txt_add_resident_wra: {
          required: "Please select a women of reproductive age"
        },
        txt_add_resident_educational_attain: {
          required: "Please select an educational attainment"
        },
        txt_add_resident_type_of_garbage_dispos: {
          required: "Please select a type of garbage disposal"
        },
        txt_add_resident_interview_by: {
          required: "Please enter an interviewer",
          minlength: "Minlength of 3 characters",
          maxlength: "Maxlength of 100 characters"
        },
        txt_add_resident_email_add: {
          required: "Please enter an email",
          email: "Please enter a valid email"
        },
        txt_add_resident_uname: {
          required: "Please enter a username",
          minlength: "Minlength of 3 characters",
          maxlength: "Maxlength of 50 characters"
        },
        txt_add_resident_birt_place: {
          required: "Please enter a birth place",
          minlength: "Minlength of 3 characters",
          maxlength: "Maxlength of 100 characters"
        },
        txt_add_resident_purok: {
          required: "Please select a purok"
        },
        txt_add_resident_tribe: {
          required: "Please select a tribe"
        },
        txt_add_resident_ips: {
          required: "Please select an ips"
        },
        txt_add_resident_health_stat: {
          required: "Please select a health status"
        },
        txt_add_resident_length_of_stay: {
          required: "Please enter a length of stay"
        },
        txt_add_resident_relationship_to_head: {
          required: "Please select a relationship to head of the family"
        },
        txt_add_resident_occupation: {
          required: "Please select an occupation"
        },
        'txt_add_resident_sources_of_water_supp[]': {
          required: "Please select a source of water supply"
        },
        txt_add_resident_types_of_toilet: {
          required: "Please select a types of toilet"
        },
        txt_add_resident_blind_drainage: {
          required: "Please select a types of blind drainage"
        },
        txt_add_resident_image: {
          required: "Please select an image"
        },
        txt_add_resident_mobile_num: {
          required: "Please enter a mobile number"
        },
        txt_add_resident_upass: {
          required: "Please enter a password"
        },
      },

      errorElement: 'label',
      errorPlacement: function (error, element) {
        if ($(element).attr("type") === "file") {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element.closest('.custom-file'));
        } else if ($(element).hasClass('select2')) {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element.next('.select2-container'));
        } else {
          error.addClass('invalid-feedback').css('color', '#ff6272').insertAfter(element);
        }
      },

      highlight: function (element, errorClass, validClass) {
        if ($(element).attr("type") === "file") {
          $(element).addClass('is-invalid').removeClass('is-valid');
        } else if ($(element).hasClass('select2')) {
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
          $(element).next('.select2-container').find('.select2-selection').addClass('is-invalid');
        } else {
          $(element).addClass('is-invalid').removeClass('is-valid');
          $(element).closest('.form-group').removeClass('has-success').addClass('has-danger');
        }
        $(element).siblings('.valid-feedback').css('color', '#ff6272');
      },

      unhighlight: function (element, errorClass, validClass) {
        if ($(element).attr("type") === "file") {
          $(element).removeClass('is-invalid');
        } else if ($(element).hasClass('select2')) {
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
          $(element).next('.select2-container').find('.select2-selection').removeClass('is-invalid').addClass('is-valid');
        } else {
          $(element).removeClass('is-invalid');
          $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
        }
        $(element).siblings('.valid-feedback').css('color', '#3eee67');
      },

      success: function (label, element) {
        label.removeClass('invalid-feedback').addClass('valid-feedback').text('Looks good');
        $(element).addClass('is-valid').removeClass('is-invalid');
        $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
        label.css('color', '#3eee67');
      },
    });

    // listen for changes in the select2 input and trigger validation
    $('#addModal').find('.select2').on('change', function () {
      $(this).valid(); // trigger validation for the select2 input
    });
  });
</script>