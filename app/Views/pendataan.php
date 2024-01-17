<?= $this->extend('layout/tabler_layout') ?>

<?= $this->section('content') ?>

<div class="page-body">
    <div class="container-xl">
        <div class="card mb-4">
            <div class="card-header row align-items-center justify-content-between">
                <h3 class="card-title col-auto">Pendataan</h3>
                <div class="col-auto">
                    <div class="btn-list">
                        <a href="<?= base_url('pendataan/new') ?>" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row row-cards">
                    <div class="mb-3">
                        <label class="form-label">Search</label>
                        <input type="text" class="form-control" name="search" id="search" placeholder="search">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Nama Lembaga</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($datatable as $key => $value) {
                                    echo '<tr>'.
                                        '<td>'.$value['nama_lembaga'].'</td>'.
                                        '<td>'.$value['nis'].'</td>'.
                                        '<td>'.$value['nama_siswa'].'</td>'.
                                        '<td>'.$value['email'].'</td>'.
                                        '<td>'.$value['foto'].'</td>'.
                                        '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {

    $("#search").on("change", function() {
        $.ajax({
                url: "<?= base_url('pendataan/searchTabel') ?>",
                type: "POST",
                data: $("#search").val(),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {
                        // TODO ganti isi tabel
                    } else {
                        Swal.fire(
                            'Error',
                            response.message,
                            'error'
                        )
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire(
                        'Error',
                        'Something Went Wrong!',
                        'error'
                    )
                }
            });
    });

});
</script>
<?= $this->endSection() ?>