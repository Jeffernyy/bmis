<div class="modal fade" id="editModal<?php echo $row['id'] ?>">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header align-items-center">
          <h4 class="modal-title">Edit Blotter</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="container-fluid">
              <div class="row">
                <div class="col-12 col-md-6 col-sm-12">
                  <input type="hidden" value="<?php echo $row['id'] ?>" name="hidden_id" id="hidden_id">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Complainant<span class="badge badge-danger ml-2">NOT
                            EDITED</span></label>
                        <select class="form-control select2" disabled>
                          <option selected>
                            <?php echo $row['rname_complainant'] ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your complainant</label>
                        <input type="text" name="txt_cmplnnt_id" class="form-control cstm_crsr editComplainantSpecified"
                          placeholder="Please specify your complainant" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Age<span class="badge badge-danger ml-2">NOT EDITED</span></label>
                        <input class="form-control" type="number" value="<?php echo $row['blotter_complainant_age'] ?>"
                          readonly>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Contact #<span
                            class="badge badge-success ml-2">COMPLAINANT</span></label>
                        <input name="txt_edit_blotter_complainant_contact_num" class="form-control" type="number"
                          value="<?php echo $row['blotter_complainant_contact_num'] ?>"
                          placeholder="Please enter contact num" autofocus>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Address<span
                        class="badge badge-success ml-2">COMPLAINANT</span></label>
                    <input name="txt_edit_blotter_complainant_address" class="form-control" type="text"
                      value="<?php echo $row['blotter_complainant_address'] ?>"
                      placeholder="Please enter complete present address">
                  </div>
                </div>
                <div class="col-12 col-md-6 col-sm-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Respondent<span class="badge badge-danger ml-2">NOT
                            EDITED</span></label>
                        <select class="form-control select2" disabled>
                          <option selected>
                            <?php echo $row['rname_respondent'] ?>
                          </option>
                        </select>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Specify your respondent</label>
                        <input type="text" name="txt_cmplnee_id" class="form-control cstm_crsr editRespondentSpecified"
                          placeholder="Please specify your respondent" disabled>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-6">
                        <label class="control-label">Age<span class="badge badge-danger ml-2">NOT EDITED</span></label>
                        <input name="txt_cmplnee_age" class="form-control" id="editComplaineeAgeID' . $row['id'] . '"
                          type="number" value="<?php echo $row['blotter_respondent_age'] ?>" readonly>
                      </div>
                      <div class="col-6">
                        <label class="control-label">Contact #<span
                            class="badge badge-success ml-2">RESPONDENT</span></label>
                        <input name="txt_edit_blotter_respondent_contact_num" class="form-control" type="number"
                          value="<?php echo $row['blotter_respondent_contact_num'] ?>"
                          placeholder="Please enter contact num">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label">Address<span class="badge badge-success ml-2">RESPONDENT</span></label>
                    <input name="txt_edit_blotter_respondent_address" class="form-control" type="text"
                      value="<?php echo $row['blotter_respondent_address'] ?>"
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
                    <textarea name="txt_edit_blotter_first_complaint" class="form-control"
                      placeholder="Start typing here ..."><?php echo $row['blotter_first_complaint'] ?></textarea>
                  </div>
                  <div class="form-group mb-4">
                    <label class="control-label d-flex align-items-center justify-content-center">THEREFORE,
                      I/WE pray that the following relief/s be granted to me/us in accordance with law and/or
                      equality:</label>
                    <textarea name="txt_edit_blotter_second_complaint" class="form-control"
                      placeholder="Start typing here ..."><?php echo $row['blotter_second_complaint'] ?></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-12 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Action</label>
                          <select name="txt_edit_blotter_action" class="form-control select2"
                            data-minimum-results-for-search="Infinity">
                            <option selected>
                              <?php echo ucwords(strtolower($row['blotter_action_taken'])) ?>
                            </option>
                            <option value="first offense">First Offense</option>
                            <option value="second offense">Second Offense</option>
                            <option value="kulong">Kulong</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Status</label>
                          <select name="txt_edit_blotter_status" class="form-control select2"
                            data-minimum-results-for-search="Infinity">
                            <option selected>
                              <?php echo ucfirst(strtolower($row['blotter_status'])) ?>
                            </option>
                            <option value="solved">Solved</option>
                            <option value="unsolved">Unsolved</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-12 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">Incidence</label>
                          <input name="txt_edit_blotter_location" class="form-control" type="text"
                            value="<?php echo $row['blotter_location_of_incident'] ?>"
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
                          <input name="txt_edit_blotter_case_num" class="form-control" type="text"
                            value="<?php echo $row['blotter_case_num'] ?>"
                            placeholder="Please enter barangay case number">
                        </div>
                      </div>
                      <div class="col-12 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label class="control-label">For</label>
                          <input name="txt_edit_blotter_for" class="form-control" type="text"
                            value="<?php echo $row['blotter_for'] ?>" placeholder="Please enter for">
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
          <button type="submit" class="btn btn-primary" name="btn_edit">Save changes</button>
        </div>
      </div>
    </div>
  </form>
</div>