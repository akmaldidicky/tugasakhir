<div class="col-lg-8">
    <?= form_open_multipart('home/editprofile'); ?>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="email" id="email" value="<?= $user['email']; ?>" readonly>
        </div>
    </div>
    <div class="form-group row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" id="nama" value="<?= $user['nama']; ?>">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2">Gambar</div>
        <div class="col-sm-10">
            <div class="row">
                <div class="col-sm-3">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-group row justify-content-end">
    <div class="col-sm-11">
        <button type="submit" class="btn btn-primary mx-5">Edit</button>
    </div>
</div>
</form>

</div>