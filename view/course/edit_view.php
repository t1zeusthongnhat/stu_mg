<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Update Courses";
$errorUpdate  = $_SESSION['error_add_department'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update Courses
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
        <a class="btn btn-primary" href="index.php?c=course&m=index"> List Courses</a>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white"> Update Courses</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post"
                    action="index.php?c=course&m=handle-edit&id=<?= $info['id']; ?>">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="<?= $info['name']; ?>" />
                                <?php if(!empty($errorUpdate['name'])): ?>
                                <span class="text-danger"><?= $errorUpdate['name']; ?></span>
                                <?php endif; ?>
                                
                                <div class="form-group mb-3">
                                    <label>Department</label>
                                    <select class="form-control" name="department_id">
                                        <?php foreach ($department as $dept) { ?>
                                        <option value="<?php echo $dept['id']; ?>"
                                            <?php if ($dept['id'] == $info['department_id']) echo 'selected'; ?>>
                                            <?php echo $dept['name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?= $info['status'] == 1 ? 'selected' : null; ?>> Active</option>
                                    <option value="0" <?= $info['status'] == 0 ? 'selected' : null; ?>> Deactive
                                    </option>
                                </select>
                            </div>

                            <button class="btn btn-primary" type="submit" name="btnSave">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>