<div class="modal fade" id="addModal">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Add Blotter</h4>
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
                      <div class="col-6">
                        <label class="control-label">Complainant</label>
                        <select name="txt_add_blotter_complainant_res_id" id="complainantSelect"
                          class="form-control select2" onchange="addComplainantAge()" autofocus>
                          <option selected disabled>Please select complainant</option>
                          <?php
                          $qry = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as blotter_res_name FROM tblresident");
                          while ($row = mysqli_fetch_array($qry)) {
                            echo '<option value="' . $row['id'] . '">' . $row['blotter_res_name'] . '</option>';
                          } ?>
                          <option value="others">others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your complainant</label>
                        <input type="text" name="txt_add_blotter_complainant_res_id" id="complainantSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your complainant" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Age<span
                            class="badge badge-warning ml-2">COMPLAINANT</span></label>
                        <input name="txt_add_blotter_complainant_age" class="form-control complainantAgeID"
                          type="number" placeholder="Please enter age" readonly>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Mobile #<span
                            class="badge badge-warning ml-2">COMPLAINANT</span></label>
                        <input name="txt_add_blotter_complainant_contact_num" type="text" id="txtAddCompMobNum"
                          class="form-control" placeholder="Please enter your active mobile number" data-mask>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Address<span
                        class="badge badge-warning ml-2">COMPLAINANT</span></label>
                    <input name="txt_add_blotter_complainant_address" class="form-control" type="text"
                      placeholder="Please enter complete present address">
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Respondent</label>
                        <select name="txt_add_blotter_respondent_id" id="respondentSelect" class="form-control select2"
                          onchange="addComplaineeAge()">
                          <option selected disabled>Please select respondent</option>
                          <?php
                          $qry = mysqli_query($con, "SELECT *,CONCAT(resident_fname, IF(resident_mname = 'n/a', '', CONCAT(' ', resident_mname)), ' ', resident_lname) as res_name FROM tblresident");
                          while ($row = mysqli_fetch_array($qry)) {
                            echo '<option value="' . $row['id'] . '">' . $row['res_name'] . '</option>';
                          } ?>
                          <option value="others">others, please specify</option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your respondent</label>
                        <input type="text" name="txt_add_blotter_respondent_id" id="respondentSpecified"
                          class="form-control cstm_crsr" placeholder="Please specify your respondent" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Age<span class="badge badge-warning ml-2">RESPONDENT</span></label>
                        <input name="txt_add_blotter_respondent_age" class="form-control respondentAgeID" type="number"
                          placeholder="Please enter age" readonly>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Mobile #<span
                            class="badge badge-warning ml-2">RESPONDENT</span></label>
                        <input name="txt_add_blotter_respondent_contact_num" type="text" id="txtAddRespMobNum"
                          class="form-control" placeholder="Please enter your active mobile number" data-mask>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Address<span class="badge badge-warning ml-2">RESPONDENT</span></label>
                    <input name="txt_add_blotter_respondent_address" class="form-control" type="text"
                      placeholder="Please enter complete present address">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group my-3">
                    <br>
                    <label
                      class="control-label d-flex align-items-center justify-content-center text-uppercase text-bold h3">C&nbsp;&nbsp;&nbsp;o&nbsp;&nbsp;&nbsp;m&nbsp;&nbsp;&nbsp;p&nbsp;&nbsp;&nbsp;l&nbsp;&nbsp;&nbsp;a&nbsp;&nbsp;&nbsp;i&nbsp;&nbsp;&nbsp;n&nbsp;&nbsp;&nbsp;t</label>
                    <br>
                    <label class="control-label d-flex align-items-center justify-content-center">I/WE
                      hereby complain against above name respondent/s for violating my/our rights and interest in the
                      following manner:</label>
                    <textarea name="txt_add_blotter_first_complaint" class="form-control"
                      placeholder="Start typing here ..."></textarea>
                  </div>
                  <div class="form-group mb-4">
                    <label class="control-label d-flex align-items-center justify-content-center">THEREFORE,
                      I/WE pray that the following relief/s be granted to me/us in accordance with law and/or
                      equality:</label>
                    <textarea name="txt_add_blotter_second_complaint" class="form-control"
                      placeholder="Start typing here ..."></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-12 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Action</label>
                          <select name="txt_add_blotter_action" class="form-control select2"
                            data-minimum-results-for-search="Infinity">
                            <option selected disabled>Please select actions</option>
                            <option value="first offense">First Offense</option>
                            <option value="second offense">Second Offense</option>
                            <option value="kulong">Kulong</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Status</label>
                          <select name="txt_add_blotter_status" class="form-control select2"
                            data-minimum-results-for-search="Infinity">
                            <option selected disabled>Please select status</option>
                            <option value="solved">Solved</option>
                            <option value="unsolved">Unsolved</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Incidence</label>
                          <input name="txt_add_blotter_location" class="form-control" type="text"
                            placeholder="Please enter the location of incidence">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-12 col-md-6 col-sm-12">
                      </div>
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Blotter case no</label>
                          <input name="txt_add_blotter_case_num" class="form-control" type="text"
                            placeholder="Please enter barangay case number">
                        </div>
                      </div>
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">For</label>
                          <input name="txt_add_blotter_for" class="form-control" type="text"
                            placeholder="Please enter for">
                        </div>
                      </div>
                    </div>
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
    $('#txtAddCompMobNum, #txtAddRespMobNum').on('input', function () {
      var enteredNumber = $(this).val();

      // check if the entered number has reached the desired length
      if (enteredNumber.length === 11) {
        // check if the entered number starts with '0'
        if (enteredNumber.startsWith('0')) {
          // remove the '0' and add '63' at the beginning
          var formattedNumber = '63' + enteredNumber.slice(1);
          // update the input field with the formatted number
          $(this).val(formattedNumber);
          // apply input mask manually
          $(this).inputmask('999999999999', { placeholder: '' });
        }
      } else if (enteredNumber.length < 11) {
        // check if the entered number starts with '63'
        if (enteredNumber.startsWith('63')) {
          // remove the '63' and add '0' at the beginning
          var formattedNumber = '0' + enteredNumber.slice(2);
          // update the input field with the formatted number
          $(this).val(formattedNumber);
        }
      }
    });
  });

  function addComplainantAge() {
    var complainantSelect = document.getElementById("complainantSelect");
    var complainantAgeId = document.querySelector(".complainantAgeID");

    if (complainantSelect.value === "others") {
      complainantAgeId.value = "";
      complainantAgeId.removeAttribute("readonly");
    } else {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = JSON.parse(xhr.responseText);
          complainantAgeId.value = response.complainantAge;
          complainantAgeId.setAttribute("readonly", true);
        }
      };
      xhr.open("GET", "../../ajax/blotter.ajax.php?complainantId=" + complainantSelect.value, true);
      xhr.send();
    }
  }

  function addComplaineeAge() {
    var respondentSelect = document.getElementById("respondentSelect");
    var respondentAgeId = document.querySelector(".respondentAgeID");

    if (respondentSelect.value === "others") {
      respondentAgeId.value = "";
      respondentAgeId.removeAttribute("readonly");
    } else {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          var response = JSON.parse(xhr.responseText);
          respondentAgeId.value = response.respondentAge;
          respondentAgeId.setAttribute("readonly", true);
        }
      };
      xhr.open("GET", "../../ajax/blotter.ajax.php?respondentId=" + respondentSelect.value, true);
      xhr.send();
    }
  }

  $(document).ready(function () {
    function addHandleSpecifiedInput(addDropdownId, addSpecifiedId) {
      // Add an event listener to the select element
      $(addDropdownId).change(function () {
        // Get the selected value
        var addSelectedValue = $(this).val();
        // Get the corresponding input field for specifying
        var addSpecifiedInput = $(addSpecifiedId);

        // If the selected value is "Others, please specify", enable the input; otherwise, disable it
        addSpecifiedInput.prop(
          "disabled",
          addSelectedValue.toLowerCase() !== "others"
        );

        // Add or remove a class based on the disabled status
        if (addSpecifiedInput.prop("disabled")) {
          addSpecifiedInput.addClass("cstm_crsr");
        } else {
          addSpecifiedInput.removeClass("cstm_crsr");
        }

        // Clear the value of the input field
        addSpecifiedInput.val("");
      });
    }

    // Handle specified inputs for each set of dropdown and specified input
    addHandleSpecifiedInput("#complainantSelect", "#complainantSpecified");
    addHandleSpecifiedInput("#respondentSelect", "#respondentSpecified");
  });
</script>