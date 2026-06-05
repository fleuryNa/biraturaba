<!DOCTYPE html>
<html lang="en">

<?= view('includes/backend/header_new') ?>

<body class="fixed-navbar">
    <div class="App-wrapper">

        <?= view('includes/backend/sidebarmenu_new') ?>
        <?= view('includes/backend/menu_new') ?>

        <div class="content-wrapper">
            <div class="content">

                <!-- PAGE -->
                <div class="page-heading">
                    <h1 class="page-title">Vidéos Home</h1>
                </div>

                <div class="ibox">
                    <div class="ibox-head d-flex justify-content-between">
                        <div class="ibox-title">Liste des vidéos</div>
                        <button class="btn btn-primary" onclick="openVideoModal()">Nouveau</button>
                    </div>

                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table id="videoTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Titre</th>
                                        <th>URL</th>
                                        <th>Image</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <?= view('includes/backend/footer_new') ?>
    </div>

    <!-- =========================
MODAL VIDEO
========================= -->
    <div class="modal fade" id="videoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Ajouter une vidéo</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <form id="videoForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_VIDEO" id="ID_VIDEO">

                        <div class="row">

                            <div class="col-md-6">
                                <label>Titre</label>
                                <input type="text" name="TITRE" id="TITRE" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>URL Video</label>
                                <input type="text" name="URL_VIDEO" id="URL_VIDEO" class="form-control">
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>Statut</label>
                                <select name="STATUT" id="STATUT" class="form-control">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                            <div class="col-md-6 mt-2">
                                <label>Image fond</label>
                                <input type="file" name="IMAGE_FOND" id="IMAGE_FOND" class="form-control">

                                <img id="previewImage"
                                    style="width:120px;margin-top:10px;display:none;border-radius:8px;">
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" onclick="saveVideo(event)">Enregistrer</button>
                </div>

            </div>
        </div>
    </div>

    <?= view('includes/backend/script_back_new') ?>

    <script>
    // =====================
    // LOAD DATATABLE
    // =====================
    $(document).ready(function() {
        loadVideos();
    });

    // Fonctions pour charger les données
    function loadVideos() {
        // alert('ok');
        $('#videoTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('videos/liste') ?>",
                type: "POST",
                data: {}
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Tous"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [5], // Action column
                "orderable": false
            }],
            dom: 'Bfrtlip',
            buttons: [{
                    extend: 'copy',
                    text: '<i class="bi bi-files"></i> Copier'
                },
                {
                    extend: 'csv',
                    text: '<i class="bi bi-file-earmark-spreadsheet"></i> CSV'
                },
                {
                    extend: 'excel',
                    text: '<i class="bi bi-file-earmark-excel"></i> Excel'
                },
                {
                    extend: 'pdf',
                    text: '<i class="bi bi-file-earmark-pdf"></i> PDF'
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i> Imprimer'
                }
            ]
        });
    }

    // =====================
    // OPEN MODAL
    // =====================
    function openVideoModal() {
        $('#videoForm')[0].reset();
        $('#ID_VIDEO').val('');
        $('#previewImage').hide();
        $('#modalTitle').text('Ajouter une vidéo');
        $('#videoModal').modal('show');
    }

    // =====================
    // SAVE (INSERT + UPDATE)
    // =====================
    function saveVideo(e) {
        e.preventDefault();

        let form = $('#videoForm')[0];
        let data = new FormData(form);

        $.ajax({
            url: "<?= base_url('videos/store') ?>",
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(res) {

                alert(res.message);

                if (res.success) {
                    $('#videoModal').modal('hide');
                    $('#videoTable').DataTable().ajax.reload();
                }
            }
        });
    }

    // =====================
    // EDIT
    // =====================
    function editVideo(id) {

        $.get("<?= base_url('videos/getOne/') ?>" + id, function(res) {

            if (res.success) {

                let d = res.data;

                $('#ID_VIDEO').val(d.ID_VIDEO);
                $('#TITRE').val(d.TITRE);
                $('#URL_VIDEO').val(d.URL_VIDEO);
                $('#STATUT').val(d.STATUT);

                if (d.IMAGE_FOND) {
                    $('#previewImage')
                        .attr('src', "<?= base_url('uploads/video/') ?>" + d.IMAGE_FOND)
                        .show();
                }

                $('#modalTitle').text('Modifier vidéo');
                $('#videoModal').modal('show');
            }
        });
    }

    // =====================
    // DELETE
    // =====================
    function deleteVideo(id) {

        if (!confirm("Supprimer cette vidéo ?")) return;

        $.post("<?= base_url('videos/delete') ?>", {
            ID_VIDEO: id
        }, function() {
            $('#videoTable').DataTable().ajax.reload();
        });
    }

    // =====================
    // PREVIEW IMAGE
    // =====================
    $('#IMAGE_FOND').on('change', function() {

        let file = this.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .show();
            };

            reader.readAsDataURL(file);
        }
    });
    </script>

</body>

</html>