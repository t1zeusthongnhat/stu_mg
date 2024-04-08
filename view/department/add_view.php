<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Create Department";
$errorAdd = $_SESSION['error_add_department'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Create Department
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <a class="btn btn-primary btn-lg" href="index.php?c=department&m=add" >List Departments</a>
        <div class="card card-primary mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white">Add New Department</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=department&m=handle-add">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" id="" class="form-control">
                                <?php if(!empty($errorAdd['name'])): ?>
                                    <span class="text-danger"><?= $errorAdd['name']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name's Leader</label>
                                <input type="text" name="leader" id="" class="form-control">
                                <?php if(!empty($errorAdd['leader'])): ?>
                                    <span class="text-danger"><?= $errorAdd['leader']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Logo</label>
                                <input type="file" name="logo" class ="form-control" id="">
                                <?php if(!empty($errorAdd['logo'])): ?>
                                    <span class="text-danger"><?= $errorAdd['logo']; ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                       
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1"> Active</option>
                                    <option value="0"> Deactive</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 begin form-margin  " >
                                <label>Beginning Date</label>
                                <input type="date" class="form-control" id="" name ="beginning_date">
                            </div>
                            <button class ="btn btn-primary btn-lg btnA" type="submit" name ="btnSave">Save</button>
                            <button class ="btn btn-primary btn-lg btnA" type="submit" name ="btnBack">Back</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>