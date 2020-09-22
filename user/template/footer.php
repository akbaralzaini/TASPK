<script src="../assets/js/jquery-1.12.2.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/propeller.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>

<script type="text/javascript" src="../assets/components/select2/js/select2.full.js"></script>

<script type="text/javascript" src="../assets/components/select2/js/pmd-select2.js"></script>

<script type="text/javascript" language="javascript" src="../assets/components/datetimepicker/js/moment-with-locales.js"></script>
<script type="text/javascript" language="javascript" src="../assets/components/datetimepicker/js/bootstrap-datetimepicker.js"></script>

<?php if (isset($_GET['c']) && base64_decode($_GET['c']) == 'formulir') { ?>
    <script>
        $('#datetimepicker-default').datetimepicker({
            format: 'YYYY-MM-DD'
        });
    </script>
<?php } ?>

<?php if (isset($_GET['c']) && base64_decode($_GET['c']) == 'formulir_pend_pres') { ?>
    <script>
        $('.thn').datetimepicker({
            viewMode: 'years',
            format: 'YYYY'
        });
    </script>
<?php } ?>

<?php if (isset($_GET['c']) && base64_decode($_GET['c']) == 'daftar_peserta') { ?>
    <script>
        $('#example-checkbox').DataTable({
            responsive: false,
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            bFilter: true,
            bLengthChange: true,
            pagingType: "simple",
            "paging": true,
            "searching": true,
            "language": {
                "info": " _START_ - _END_ of _TOTAL_ ",
                "sLengthMenu": "<span class='custom-select-title'>Rows per page:</span> <span class='custom-select'> _MENU_ </span>",
                "sSearch": "",
                "sSearchPlaceholder": "Search",
                "paginate": {
                    "sNext": " ",
                    "sPrevious": " "
                },
            },
            dom: "<'pmd-card-title'<'data-table-title'><'search-paper pmd-textfield'f>>" +
                "<'custom-select-info'<'custom-select-item'><'custom-select-action'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'pmd-card-footer' <'pmd-datatable-pagination' l i p>>",
        });

        $('.custom-select-info').hide();

        $('#example-checkbox tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                var rowinfo = $(this).closest('.dataTables_wrapper').find('.select-info').text();
                $(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text(rowinfo);
                if ($(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text() != null) {
                    $(this).closest('.dataTables_wrapper').find('.custom-select-info').show();
                    //show delet button
                } else {
                    $(this).closest('.dataTables_wrapper').find('.custom-select-info').hide();
                }
            } else {
                var rowinfo = $(this).closest('.dataTables_wrapper').find('.select-info').text();
                $(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text(rowinfo);
            }
            if ($('#example-checkbox').find('.selected').length == 0) {
                $(this).closest('.dataTables_wrapper').find('.custom-select-info').hide();
            }
        });

        $(".data-table-title").html('<h2 class="pmd-card-title-text">Daftar Putra & Putri</h2>');
        $(".custom-select-action").html('<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>');
    </script>
<?php } ?>

<?php if (isset($_GET['c']) && base64_decode($_GET['c']) == 'daftar_tahap') { ?>
    <script>
        $('#example-checkbox').DataTable({
            responsive: false,
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            bFilter: true,
            bLengthChange: true,
            pagingType: "simple",
            "paging": true,
            "searching": true,
            "language": {
                "info": " _START_ - _END_ of _TOTAL_ ",
                "sLengthMenu": "<span class='custom-select-title'>Rows per page:</span> <span class='custom-select'> _MENU_ </span>",
                "sSearch": "",
                "sSearchPlaceholder": "Search",
                "paginate": {
                    "sNext": " ",
                    "sPrevious": " "
                },
            },
            dom: "<'pmd-card-title'<'data-table-title'><'search-paper pmd-textfield'f>>" +
                "<'custom-select-info'<'custom-select-item'><'custom-select-action'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'pmd-card-footer' <'pmd-datatable-pagination' l i p>>",
        });

        $('.custom-select-info').hide();

        $('#example-checkbox tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                var rowinfo = $(this).closest('.dataTables_wrapper').find('.select-info').text();
                $(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text(rowinfo);
                if ($(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text() != null) {
                    $(this).closest('.dataTables_wrapper').find('.custom-select-info').show();
                    //show delet button
                } else {
                    $(this).closest('.dataTables_wrapper').find('.custom-select-info').hide();
                }
            } else {
                var rowinfo = $(this).closest('.dataTables_wrapper').find('.select-info').text();
                $(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text(rowinfo);
            }
            if ($('#example-checkbox').find('.selected').length == 0) {
                $(this).closest('.dataTables_wrapper').find('.custom-select-info').hide();
            }
        });

        $(".data-table-title").html('<h2 class="pmd-card-title-text">Daftar Tahapan</h2>');
        $(".custom-select-action").html('<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>');
    </script>
<?php } ?>

<?php if (isset($_GET['c']) && base64_decode($_GET['c']) == 'daftar_kriteria') { ?>
    <script>
        $('#example-checkbox').DataTable({
            responsive: false,
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            bFilter: true,
            bLengthChange: true,
            pagingType: "simple",
            "paging": true,
            "searching": true,
            "language": {
                "info": " _START_ - _END_ of _TOTAL_ ",
                "sLengthMenu": "<span class='custom-select-title'>Rows per page:</span> <span class='custom-select'> _MENU_ </span>",
                "sSearch": "",
                "sSearchPlaceholder": "Search",
                "paginate": {
                    "sNext": " ",
                    "sPrevious": " "
                },
            },
            dom: "<'pmd-card-title'<'data-table-title'><'search-paper pmd-textfield'f>>" +
                "<'custom-select-info'<'custom-select-item'><'custom-select-action'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'pmd-card-footer' <'pmd-datatable-pagination' l i p>>",
        });

        $('.custom-select-info').hide();

        $('#example-checkbox tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                var rowinfo = $(this).closest('.dataTables_wrapper').find('.select-info').text();
                $(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text(rowinfo);
                if ($(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text() != null) {
                    $(this).closest('.dataTables_wrapper').find('.custom-select-info').show();
                    //show delet button
                } else {
                    $(this).closest('.dataTables_wrapper').find('.custom-select-info').hide();
                }
            } else {
                var rowinfo = $(this).closest('.dataTables_wrapper').find('.select-info').text();
                $(this).closest('.dataTables_wrapper').find('.custom-select-info .custom-select-item').text(rowinfo);
            }
            if ($('#example-checkbox').find('.selected').length == 0) {
                $(this).closest('.dataTables_wrapper').find('.custom-select-info').hide();
            }
        });

        $(".data-table-title").html('<h2 class="pmd-card-title-text">Daftar Kriteria</h2>');
        $(".custom-select-action").html('<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>');

        $("select").select2({
            theme: "bootstrap",
            minimumResultsForSearch: Infinity,
        });
    </script>
<?php } ?>
</body>

</html>