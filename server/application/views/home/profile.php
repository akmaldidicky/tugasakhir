<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class=" card mb-3 lg-12">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['nama']; ?></h5>
                    <p class="card-text">Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $user['email']; ?></p>
                    <p class="card-text">ID &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= $user['id']; ?></p>
                    <p class="card-text">API key&nbsp;&nbsp; :<?= $user['key']; ?><a href="<?= base_url('home/resetkey') ?>"><span class=" badge bg-danger text-light mx-4">RESET</span></a></p>
                    <p class="card-text"><small class="text-muted">Bergabung sejak <?= date("d M Y", strtotime($user['time_created'])); ?></small></p>
                </div>
            </div>
        </div>
    </div>
</div>
<h4><a href="<?= base_url('home/editprofile') ?>"><span class=" badge bg-primary text-light mx-4">Edit Profile</span></a></h4>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->