<!-- /.container-fluid -->
<p class="text-dark mx-4">Semua URL dibawah ini dapat anda akses dengan menggunakan API KEY (dapat dilihat pada <a href="<?= base_url('home/profile'); ?>">My Profile</a>). Data-data yang anda inginkan akan dikirim dalam bentuk JSON. </p>
<h6 class="mx-4">*Note : Contoh pada gambar masih menggunakan alamat lama, ganti "localhost/server" dengan "103.9.22.227"</h6>
<div class="mx-3 mb-3">
    <h3><span class="badge bg-secondary text-light mt-3" id="mestakung">http://103.9.22.227/api/mestakung</span></h3>
    <div class="col-lg-6">
    </div>
    <!-- Basic Card GET -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestakungget">Method : GET</h6>
        </div>
        <div class="card-body">
            <h5>&#8226; GET All Your Sensor Value</h5>
            <p class="mx-3">Dengan URL diatas anda akan mendapatkan semua data nilai sensor berdasarkan key device nya.</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestakungget.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->
    <!-- Basic Card POST -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestakungpost">Method : POST</h6>
        </div>
        <div class="card-body">
            <h5>&#8226; Register Your Device</h5>
            <p class="mx-3">Anda dapat mendaftarkan perangkat anda dengan URL ini. Beberapa parameter harus anda masukan diantaranya id_user, chip_id, nama_device, nama_header dan key_device. Dapat dilihat pada gambar dibawah.</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestakungpost.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->
    <!-- Basic Card PUT -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestakungput">Method : PUT</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;UPDATE Your Name Device</h5>
            <p class="mx-3">Device yang telah terdaftar dapat anda update namanya. Anda dapat mengupdate device berdasarkan chip id nya. 2 parameter dibutuhkan untuk method ini yaitu nama_device(nama baru) dan chip_id.</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestakungput.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->
    <!-- Basic Card DELETE -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestakungdelete">Method : DELETE</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;DELETE Your Device</h5>
            <p class="mx-3">Device yang telah terdaftar dapat anda hapus. Device akan dihapus berdasarkan chip id nya.</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestakungdelete.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->

</div>

<div class="mx-3">
    <h3><span class="badge bg-secondary text-light" id="mestakungrealtime">http://103.9.22.227/api/mestakung/realtime</span></h3>
    <div class="col-lg-6">
    </div>
    <!-- Basic Card GET -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestakungrealtimeget">Method : GET</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;GET your latest data</h5>
            <p class="mx-3">Dengan URL diatas anda akan mendapatkan Data terakhir dari nilai sensor perangkat anda, cukup menambahkan parameter"key_device".</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestakungrealtimeget.jpg'); ?>">
        </div>
    </div>
</div>
<div class="mx-3">
    <h3><span class="badge bg-secondary text-light" id="mestakungw">http://103.9.22.227/api/mestakung/w</span></h3>
    <div class="col-lg-6">
    </div>
    <!-- Basic Card GET -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestakungwget">Method : GET</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;GET your limit data</h5>
            <p class="mx-3">Dengan URL diatas anda akan mendapatkan Data dengan limit dari nilai sensor perangkat anda, cukup menambahkan parameter"key_device", "urutan" dan "limit".</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestakungwget.jpg'); ?>">
        </div>
    </div>
</div>


<div class="mx-3 mt-5">
    <h3><span class="badge bg-secondary text-light" id="mesta">http://103.9.22.227/api/mesta</span></h3>

</div>
<!-- Basic Card GET -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="mestaget">Method : GET</h6>
    </div>
    <div class="card-body">
        <h5>&#8226; GET Your Aplication/Headaer and Device</h5>
        <p class="mx-3">Method GET pada URL ini berfungsi untuk mendapatkan data Aplikasi, header, variabel dan device yang anda miliki. Data tersebut anda dapatkan tanpa perlu parameter. <br><img src="<?= base_url('assets/img/getchipid.jpg'); ?>"></p>
        <h5>&#8226; GET Your Sensor Value</h5>
        <p class="mx-3">Method GET pada URL ini juga berfungsi untuk mendapatkan data nilai sensor anda berdasrkan "key_device" dalam rentang waktu yang telah ditentukan. Parameter yang anda butuhkan adalah "key_device", "urutan", "waktu_awal" dan "waktu_akhir". Mengurutkan data secara ascending dan descending dengan meenambahkan key/parameter "urutan" dengan velue "asc"/"desc". <br><img src="<?= base_url('assets/img/getchipid.jpg'); ?>"></p>

        <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestagetsensor.jpg'); ?>">
    </div>
</div>
<!-- end of card  -->
<!-- Basic Card POST -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="mestapost">Method : POST</h6>
    </div>
    <div class="card-body">
        <h5>&#8226; CREATE Your Header/Aplication</h5>
        <p class="mx-3">Anda dapat membuat header untuk perangkat anda dengan URL ini. Beberapa parameter harus anda masukan diantaranya id_user dan nama_header. Dapat dilihat pada gambar dibawah.</p>
        <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestapost.jpg'); ?>">
    </div>
</div>
<!-- end of card  -->
<!-- Basic Card PUT -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="mestaput">Method : PUT</h6>
    </div>
    <div class="card-body">
        <h5>&#8226;UPDATE Your Key Device</h5>
        <p class="mx-3">Device yang telah terdaftar dapat anda generate ulang (key device nya). Anda hanya perlu memasukan beberapa parameter yaitu "hip_id", "key_device" (key device baru) dan "id_user".</p>
        <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestaput.jpg'); ?>">
    </div>
</div>
<!-- end of card  -->
<!-- Basic Card DELETE -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" id="mestadelete">Method : DELETE</h6>
    </div>
    <div class="card-body">
        <h5>&#8226;DELETE Your Aplication/Header</h5>
        <p class="mx-3">Header yang telah anda buat dapat anda hapus. Header akan dihapus berdasarkan "nama_header" nya.</p>
        <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestadelete.jpg'); ?>">
    </div>
</div>
<!-- end of card  -->
<div class="mx-3">
    <h3><span class="badge bg-secondary text-light" id="mestav">http://103.9.22.227/api/mesta/v</span></h3>
    <div class="col-lg-6">
    </div>
    <!-- Basic Card GET -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestavget">Method : GET</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;GET Your Sensor Value</h5>
            <p class="mx-3">Method GET pada URL ini juga berfungsi untuk mendapatkan data nilai sensor anda berdasrkan "chip_id" dalam rentang waktu yang telah ditentukan. Parameter yang anda butuhkan adalah "chip_id", "urutan", "waktu_awal" dan "waktu_akhir". Mengurutkan data secara ascending dan descending dengan meenambahkan key/parameter "urutan" dengan velue "asc"/"desc".</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestavget.jpg'); ?>">
        </div>
    </div>
    <!-- Basic Card POST -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestadelete">Method : POST</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;CREATE Your Variable</h5>
            <p class="mx-3">Dengan URL ini anda dapat membuat variabel yang anda inginkan. Beberpa parameter yang harus ada yaitu "id_user", "nama_header" dan "variabel". </p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestavpost.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->
    <!-- Basic Card PUT -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestadelete">Method : PUT</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;UPDATE Your Variabe</h5>
            <p class="mx-3">Variabel yang telah anda buat dapat anda ubah. Variabel akan ubah berdasarkan "code_header" dan "nama_header" nya.</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestavput.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->
    <!-- Basic Card DELETE -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="mestadelete">Method : DELETE</h6>
        </div>
        <div class="card-body">
            <h5>&#8226;DELETE Your Variable</h5>
            <p class="mx-3">Variabel yang telah anda buat dapat anda hapus. Variabel akan dihapus berdasarkan "nama_header" nya.</p>
            <img style="display:block; margin:auto;" src="<?= base_url('assets/img/mestavdelete.jpg'); ?>">
        </div>
    </div>
    <!-- end of card  -->
</div>

</div>
<!-- End of Main Content -->
