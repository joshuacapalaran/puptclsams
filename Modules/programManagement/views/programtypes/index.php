<div class="container mt-3">
  <div class="row">
    <div class="col-6">


    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin/students')?>">Students</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/professors')?>">Professors</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/courses')?>">Courses</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/sections')?>">Sections</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/semesters')?>">Semesters</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/s_years')?>">School Year</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/subjects')?>">Subjects</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/categories')?>">Category</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/labs')?>">Laboratory</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/capacities')?>">Capacity</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/suffixes')?>">Suffixes </a></li>
        <!-- -->
        <!-- <li class="breadcrumb-item"><a href="<?=base_url('admin/programs')?>">Programs</a></li>
        <li class="breadcrumb-item"><a href="<?=base_url('admin/programtypes')?>">Program Types</a></li> -->
        <!-- <li class="breadcrumb-item active" aria-current="page">Sample</li> -->
      </ol>
    </nav>


      <h3>Program Types</h3>
    </div>
    <div class="col-6">
      <a class="btn btn-primary float-end" href="<?=base_url('admin/programtypes/add')?>"> Add </a>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Program Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $ctr = 1?>
            <?php if(empty($programtypes)): ?>
              <tr>
                <td colspan="3" class="text-center"> No Data Available </td>
              </tr>
            <?php else: ?>
              <?php foreach($programtypes as $programtype): ?>
                <tr>
                  <td><?=esc($ctr)?></td>
                  <td><?=esc($programtype['type'])?></td>
                  <td>
                    <a class="btn btn-primary" href="<?=base_url('admin/programtypes/edit/' . esc($programtype['id'], 'url'))?>"> Edit </a>
                    <a class="btn btn-danger" href="<?=base_url('admin/programtypes/delete/' . esc($programtype['id'], 'url'))?>"> Delete </a>
                  </td>
                </tr>
                <?php $ctr++?>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>