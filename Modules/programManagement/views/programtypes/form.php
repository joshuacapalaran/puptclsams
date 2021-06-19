<div class="container">
  <h4><?= $edit ? 'Editing': 'Adding'?> Content Header </h4>
  <form action="<?= base_url('admin/programtypes')?>/<?= $edit ? 'edit/'.esc($id): 'add'?>" method="post">
    <div class="row">
      <div class="col">
          <label class="form-label" for="type">Type</label>
        <div class="input-group mb-3">
          <input type="text" class="form-control" value="<?=isset($value['type']) ? esc($value['type']): ''?>" placeholder="Type" id="Type" name="type">
        </div>
          <?php if(isset($errors['type'])):?>
            <p class="text-danger"><?=esc($errors['type'])?><p>
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