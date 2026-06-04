<!DOCTYPE html>
<html lang="en">

<?= view('includes/backend/header_new') ?>

<body class="fixed-navbar">
    <!--begin::App Wrapper-->
    <div class="App-wrapper">

        <?= view('includes/backend/sidebarmenu_new') ?>
        <?= view('includes/backend/menu_new') ?>

        <div class="content-wrapper">
            <div class="content">
                <!-- PAGE HEADING -->
                <div class="page-heading">
                    <h1 class="page-title">Liste des partenaires</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html"><i class="la la-home font-20"></i></a>
                        </li>
                        <li class="breadcrumb-item">Partenaires</li>
                    </ol>
                </div>



                <div class="page-content fade-in-up">

                    <div class="ibox">

                        <div class="ibox-head d-flex justify-content-between align-items-center">
                            <div class="ibox-title">Partenaires</div>

                            <div>
                                <button class="lodge-primary" onclick="openAddTestimonialModal()">
                                    Nouveau
                                </button>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table id="testimonialTable" class="table table-bordered table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>Rôle</th>
                                            <th>Message</th>
                                            <th>Image</th>
                                            <th>Statut</th>
                                            <th>Date</th>
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
        </div>

        <?= view('includes/backend/footer_new') ?>

    </div>


    <div class="modal fade" id="staticTestimonial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticTestimonialLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticTestimonialLabel">
                        <strong id="modal-title">Ajouter un témoignage</strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="testimonialForm" enctype="multipart/form-data">

                        <input type="hidden" name="ID_TESTMONIAL" id="ID_TESTMONIAL">

                        <div class="row">

                            <!-- NAME -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom</label>
                                <input type="text" name="NAME" id="NAME" class="form-control"
                                    placeholder="Ex: Jean Dupont">
                            </div>

                            <!-- ROLE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rôle</label>
                                <input type="text" name="ROLE" id="ROLE" class="form-control"
                                    placeholder="Ex: Directeur, Client, CEO">
                            </div>

                            <!-- MESSAGE -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Message</label>
                                <textarea name="MESSAGE" id="MESSAGE" class="form-control" rows="4"
                                    placeholder="Écrire le témoignage..."></textarea>
                            </div>

                            <!-- STATUT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Statut</label>
                                <select name="STATUT" id="STATUT" class="form-control">
                                    <option value="1">Actif</option>
                                    <option value="0">Inactif</option>
                                </select>
                            </div>

                            <!-- IMAGE -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Photo / Avatar</label>
                                <input type="file" name="IMAGE_TESTIMONIAL" id="IMAGE_TESTIMONIAL" class="form-control"
                                    accept="image/*">

                                <!-- Preview -->
                                <div class="mt-2">
                                    <img id="previewImage" src=""
                                        style="display:none; width:90px; height:90px; object-fit:cover; border-radius:50%; border:1px solid #ddd;">
                                </div>
                            </div>

                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitTestimonialForm(event)">
                        <i class="bi bi-save"></i> Enregistrer
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- END App-wrapper -->

    <!-- SETTINGS / BACKDROPS -->
    <?= view('includes/backend/settings.php'); ?>
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>

    <?= view('includes/backend/script_back_new') ?>




    <script>
    // Attendre que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
        //default pill
        loadTestimonialsData()

    });

    // Fonctions pour charger les données
    function loadTestimonialsData() {
        // alert('ok');
        $('#testimonialTable').DataTable({
            "processing": true,
            "destroy": true,
            "serverSide": true,
            "order": [
                [4, 'desc']
            ], // Order by date
            "ajax": {
                url: "<?php echo base_url('testimonials/liste') ?>",
                type: "POST",
                data: {}
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "Tous"]
            ],
            pageLength: 10,
            "columnDefs": [{
                "targets": [7], // Action column
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
    </script>
    <script>
    // SAVE (INSERT + UPDATE)
    function submitTestimonialForm(e) {
        e.preventDefault();

        let form = $('#testimonialForm')[0];
        let data = new FormData(form);

        let id = $('#ID_TESTMONIAL').val();

        // Même endpoint pour insert + update
        let url = "<?= base_url('testimonials/store') ?>";

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            dataType: "json",

            success: function(res) {

                if (res.success) {

                    alert(res.message);

                    $('#staticTestimonial').modal('hide');

                    $('#testimonialTable').DataTable().ajax.reload();

                    resetTestimonialForm();

                } else {
                    alert(res.message);
                }
            }
        });
    }

    function resetTestimonialForm() {
        $('#testimonialForm')[0].reset();
        $('#ID_TESTMONIAL').val('');
        $('#previewIcon').attr('src', '');
        $('#modal-title').text('Ajouter un témoignage');
    }

    function openAddTestimonialModal() {
        resetTestimonialForm();
        $('#staticTestimonial').modal('show');
    }

    function editTestimonial(id) {
        $.ajax({
            url: "<?= base_url('testimonials/getOne/') ?>" + id,
            type: "GET",
            dataType: "json",
            success: function(res) {

                if (res.success) {

                    let d = res.data;

                    $('#ID_TESTMONIAL').val(d.ID_TESTMONIAL);
                    $('#NAME').val(d.NAME);
                    $('#ROLE').val(d.ROLE);
                    $('#MESSAGE').val(d.MESSAGE);
                    $('#STATUT').val(d.STATUT);

                    if (d.IMAGE_TESTIMONIAL) {
                        $('#previewImage').attr(
                            'src',
                            "<?= base_url('uploads/testimonials/') ?>" + d.IMAGE_TESTIMONIAL
                        );
                    }

                    $('#staticTestimonial').modal('show');
                }
            }
        });
    }
    // DELETE
    function deleteTestimonial(id) {

        if (!confirm("Supprimer ce témoignage ?")) return;

        $.ajax({
            url: "<?= base_url('testimonials/delete') ?>",
            type: "POST",
            data: {
                ID_TESTMONIAL: id
            },
            success: function() {
                $('#testimonialTable').DataTable().ajax.reload();
            }
        });
    }


    $('#IMAGE_TESTIMONIAL').on('change', function() {

        let file = this.files[0];

        if (file) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImage')
                    .attr('src', e.target.result)
                    .fadeIn();
            };

            reader.readAsDataURL(file);
        }
    });
    </script>



    <!-- Style supplémentaire pour corriger l'affichage -->
    <style>
    .App-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .content-wrapper {
        flex: 1;
        padding-bottom: 20px;
    }

    footer {
        margin-top: auto;
    }

    .table-responsive {
        overflow-x: auto;
    }

    /* Correction pour la hauteur du tableau */
    .dataTables_wrapper {
        overflow: auto;
    }

    /* Footer bien collé en bas */
    .App-wrapper>footer {
        margin-top: auto;
    }
    </style>

</body>

</html>