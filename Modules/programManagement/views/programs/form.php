<div class="container">
  <h4><?= $edit ? 'Editing': 'Adding'?> Content Header </h4>
  <form action="<?= base_url('admin/programs')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post">
    <div class="row">
      <div class="col-md-12">
        <label class="form-label" for="program">Program</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="<?=isset($value['program']) ? esc($value['program']): ''?>" placeholder="Course" id="course" name="program">
        </div>
          <?php if(isset($errors['program'])):?>
            <p class="text-danger"><?=esc($errors['program'])?><p>
          <?php endif;?>

          <label class="form-label" for="abbreviation">Abbreviation</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="<?=isset($value['abbreviation']) ? esc($value['abbreviation']): ''?>" placeholder="BSIT, DICT and etc" id="abbreviation" name="abbreviation">
        </div>
          <?php if(isset($errors['abbreviation'])):?>
            <p class="text-danger"><?=esc($errors['abbreviation'])?><p>
          <?php endif;?>

          <label class="form-label" for="description">Description</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="<?=isset($value['description']) ? esc($value['description']): ''?>" placeholder="Description" id="description" name="description">
        </div>
          <?php if(isset($errors['description'])):?>
            <p class="text-danger"><?=esc($errors['description'])?><p>
          <?php endif;?>

          <label class="form-label" for="program_type">Program Type</label>
          <div class="input-group mb-3">
              <select class="form-select" aria-label="Default select example" name="program_type">
                <option value ='n' <?= !$edit ? "selected" : ''?>> Select Program Type</option>
                <?php foreach($programTypes as $programType):?>
                    <option value="<?=$programType['id'] ?>" <?= isset($errors['program_type']) || $edit ? 'selected' : ''?>><?=$programType['type'] ?></option>
                <?php endforeach; ?>
              </select>
          </div>
          <?php if(isset($errors['program_type'])):?>
            <p class="text-danger"><?=esc($errors['program_type'])?><p>
          <?php endif;?>

      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <button class="float-end btn btn-primary" type="submit"> Submit </button>
      </div>
    </div>
  </form>
</div>