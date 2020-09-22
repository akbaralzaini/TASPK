<script src="../assets/js/jquery-1.12.2.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/propeller.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>

<script type="text/javascript" src="../assets/components/select2/js/select2.full.js"></script>

<script type="text/javascript" src="../assets/components/select2/js/pmd-select2.js"></script>

<?php if (empty($_GET['c'])) { ?>
    <script>
        $("select").select2({
            theme: "bootstrap",
            minimumResultsForSearch: Infinity,
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

        $(".data-table-title").html('<h2 class="pmd-card-title-text">Daftar Peserta belum terkonfirmasi</h2>');
        $(".custom-select-action").html('<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>');

        $('#terkonfirmasi').DataTable({
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
            dom: "<'pmd-card-title'<'data-table-title terkonfirmasi'><'search-paper pmd-textfield'f>>" +
                "<'custom-select-info'<'custom-select-item'><'custom-select-action'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'pmd-card-footer' <'pmd-datatable-pagination' l i p>>",
        });

        $('.custom-select-info').hide();

        $('#terkonfirmasi tbody').on('click', 'tr', function() {
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

        $(".data-table-title.terkonfirmasi").html('<h2 class="pmd-card-title-text">Daftar Peserta terkonfirmasi</h2>');
        $(".custom-select-action").html('<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>');

        $('#final').DataTable({
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
            dom: "<'pmd-card-title'<'data-table-title final'><'search-paper pmd-textfield'f>>" +
                "<'custom-select-info'<'custom-select-item'><'custom-select-action'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'pmd-card-footer' <'pmd-datatable-pagination' l i p>>",
        });

        $('.custom-select-info').hide();

        $('#final tbody').on('click', 'tr', function() {
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

        $(".data-table-title.final").html('<h2 class="pmd-card-title-text">Daftar Peserta Lolos tahap final</h2>');
        $(".custom-select-action").html('<button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">delete</i></button><button class="btn btn-sm pmd-btn-fab pmd-btn-flat pmd-ripple-effect btn-primary" type="button"><i class="material-icons pmd-sm">more_vert</i></button>');
    </script>
<?php } ?>

<?php if (isset($_GET['c']) && base64_decode($_GET['c']) == 'daftar_kriteria') { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".direct-expand").click(function() {
                $(".direct-child-table").slideToggle(300);
                $(this).toggleClass("child-table-collapse");
            });
        });
    </script>

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

    <script>
        $('.tipe').on('change', function() {
            var id = $(this).attr('id');
            var types = this.value;

            if (types == 2) {
                $('#koloms' + id).append('<button onclick="tambah(' + id + ')" type="button" class="btn btn-sm pmd-btn-fab pmd-btn-flat btn-primary"><i class="material-icons">add</i></button>');
            } else {
                $('#koloms' + id).empty();
            }
        });

        function tambah(id) {
            $('#penilaian' + id).after('<tr>' +
                '<th colspan="2">' +
                '<input type="text" name="pilihan[]" class="form-control" required>' +
                '</th>' +
                '<th>' +
                '<input type="number" name="nilai[]" class="form-control" required>' +
                '</th>' +
                '</tr>');
        }
    </script>
<?php } ?>
</body>

</html>