
<br><div class="card bg-light ">
  <div class="card-body">
    <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="row">
            <div class="col-md-12">
              <h3><?= $function_title?></h3>
              <!-- <?php if(empty($user_detail['academic_program_id']) && empty($user_detail['area_id']) && empty($user_detail['department_id'])): ?>
              <a type="button" class="btn btn-info" data-toggle="modal" data-target="#userCredential">
                  <i class="far fa-plus-square"></i> User Credentials
              </a>
            <?php else: ?>
              <span class="user-credentials">User Area</span>
              <span><b><?= empty($user_detail['area_code']) != true ? strtoupper($user_detail['area_code'].' - '.$user_detail['area_name']) : ucwords("Not belong to an Area") ?></b></span>
              <br>
              <span class="user-credentials">User Department</span>
              <span><b><?= empty($user_detail['department_name']) != true ? strtoupper($user_detail['department_name']) : ucwords("Not belong to a department") ?></b></span>
              <br>
              <span class="user-credentials">User's Academic Program</span>
              <span><b><?= empty($user_detail['program_name']) != true ? strtoupper($user_detail['program_name']): ucwords("Not belong to an Academic Program") ?></b></span>
              <?php endif; ?>
              <br>
                <?php if(!empty($user_detail['area_id']) || !empty($user_detail['department_id']) || !empty($user_detail['academic_program_id'])): ?>
                  <a type="button" class="float-right btn btn-info" data-toggle="modal" data-target="#userCredential">
                      <i class="far fa-minus-square"></i> Edit User Credentials
                  </a>
                <?php endif; ?> -->
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              <span class="field">Name</span>
              <span class="field-value"><?= ucfirst($user[0]['firstname']).' '.ucfirst($user[0]['lastname']) ?></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <span class="field">Username</span>
              <span class="field-value"><?= ucfirst($user[0]['username']) ?></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <span class="field">Email</span>
              <span class="field-value"><?= $user[0]['email'] ?></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <span class="field">Birthdate</span>
              <span class="field-value"><?= $user[0]['birthdate'] ?> (<?= floor((time() - strtotime($user[0]['birthdate'])) / 31556926) ?> yrs old) </span>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-3 offset-8">
              <?php
                user_edit_link('users','edit-user', $permissions, $user[0]['id']);
              ?>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="modal fade" id="userCredential" tabindex="-1" role="dialog" aria-labelledby="userCredentialLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="userCredentialLabel">
                <?php if(empty($user_detail['program_head_id']) && empty($user_detail['area_id']) && empty($user_detail['department_id'])): ?>
                  Add User Credentials
                <?php else: ?>
                  Edit User Credentials
                <?php endif; ?>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" id="user_credential_form">
                <div class="form-group">
                  <label for="area_id">Area</label>
                  <select name="area_id" id="area_id" class="form-control <?= isset($errors['area_id']) ? 'is-invalid':'is-valid' ?>">
                    <?php if(isset($user_detail['area_id'])): ?>
                      <option value="<?= $user_detail['area_id'] ?>"><?= strtoupper(name_on_system($user_detail['area_id'], $areas, 'areas')) ?></option>
                    <?php else: ?>
                      <option value="">Select Area</option>
                    <?php endif; ?>
                    <?php if(isset($areas) && count($areas) != 0): ?>
                      <?php foreach($areas as $area): ?>
                        <option value="<?= $area['id'] ?>"><?= strtoupper($area['area_code'].' - '.$area['area_name']) ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                   <?php if(isset($errors['area_id'])): ?>
                      <div class="invalid-feedback">
                        <?= $errors['area_id'] ?>
                      </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                  <label for="department_id">Department</label>
                  <select name="department_id" id="department_id" class="form-control <?= isset($errors['department_id']) ? 'is-invalid':'is-valid' ?>">
                    <?php if(isset($user_detail['department_id'])): ?>
                      <option value="<?= $user_detail['department_id'] ?>"><?= strtoupper(name_on_system($user_detail['department_id'], $departments, 'departments')) ?></option>
                    <?php else: ?>
                      <option value="">Select Department</option>
                    <?php endif; ?>
                    <?php if(isset($departments) && count($departments) != 0): ?>
                      <?php foreach($departments as $department): ?>
                        <option value="<?= $department['id'] ?>"><?= strtoupper($department['department_name']) ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                   <?php if(isset($errors['department_id'])): ?>
                      <div class="invalid-feedback">
                        <?= $errors['department_id'] ?>
                      </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                  <label for="academic_program_id">Academic Program</label>
                  <select name="academic_program_id" id="academic_program_id" class="form-control <?= isset($errors['academic_program_id']) ? 'is-invalid':'is-valid' ?>">
                    <?php if(isset($user_detail['academic_program_id'])): ?>
                      <option value="<?= $user_detail['academic_program_id'] ?>"><?= strtoupper(name_on_system($user_detail['academic_program_id'], $academic_programs, 'academic_programs')) ?></option>
                    <?php else: ?>
                      <option value="">Select Acedemic Program</option>
                    <?php endif; ?>
                    <?php if(isset($academic_programs) && count($academic_programs) != 0): ?>
                      <?php foreach($academic_programs as $academic_program): ?>
                        <option value="<?= $academic_program['id'] ?>"><?= strtoupper($academic_program['program_name']) ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                   <?php if(isset($errors['academic_program_id'])): ?>
                      <div class="invalid-feedback">
                        <?= $errors['academic_program_id'] ?>
                      </div>
                    <?php endif; ?>
                </div>
                <?php $uri = new \CodeIgniter\HTTP\URI($_SERVER['REQUEST_URI']); ?>
                <input type="hidden" name="user_id" id="user_id" value="<?= $uri->getSegment(4) ?>">
                <?php if(empty($user_detail['program_head_id']) && empty($user_detail['area_id']) && empty($user_detail['department_id'])): ?>
                  <input type="submit" name="user_credential_submit" id="user_credential_submit" class="btn btn-info" value="Save Credential">
                <?php else: ?>
                  <input type="hidden" name="user_credential_id" id="user_credential_id" class="btn btn-info" value="<?= $user_detail['id'] ?>">
                  <input type="submit" name="user_credential_edit" id="user_credential_edit" class="btn btn-info" value="Edit Credential">
                <?php endif; ?>
              </form>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-info">Save</button> -->
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
