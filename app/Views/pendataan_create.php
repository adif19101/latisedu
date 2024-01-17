<?= $this->extend('layout/tabler_layout') ?>

<?= $this->section('header-button'); ?>
<div class="col-auto">
    <div class="btn-list">
        <a id="btn_save" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                <path d="M14 4l0 4l-6 0l0 -4"></path>
            </svg>
            Simpan
        </a>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<div class="page-body">
    <div class="container-xl">
        <form id="tambah_data_siswa">
            <div class="row row-cards">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="nama_lembaga" class="form-label">Lembaga Siswa</label>
                                <select class="form-select" name="nama_lembaga" id="nama_lembaga">
                                    <?php 
                                    foreach ($lembaga as $key => $value) {
                                        echo'<option value="'. $value['id'] .'">'.$value['nama_lembaga']. '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <input type="text" class="form-control" name="nis" id="nis" placeholder="NIS">
                            </div>
                            <div class="mb-3">
                                <label class="form-label required">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama_siswa" id="nama_siswa"
                                    placeholder="Nama Siswa">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input type="file" id="foto" name="foto">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </form>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {

    $("#tambah_data_siswa").validate({
        ignore: [],
        rules: {
            nama_lembaga: {
                required: true,
            },
            nis: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true,
            },
            foto: {
                required: true,
                extension: "jpg|png",
            },
        },
        // messages: {
        // },
        errorPlacement: function(error, element) {
            // Show error message normally
            error.insertAfter(element);
        },
        submitHandler: function(form) {
            var form_data = new FormData(form);

            $.ajax({
                url: "<?= base_url('pendataan/create') ?>",
                type: "POST",
                data: form_data,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire(
                            'Success',
                            response.message,
                            'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href =
                                    "<?= base_url('pendataan/new') ?>";
                            }
                        })
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
        }
    })

    $('#btn_save').on('click', function() {
        if ($('#tambah_data_siswa').valid()) {
            $('#tambah_data_siswa').submit();
        }
    });
});
</script>
<?= $this->endSection() ?>