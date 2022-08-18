<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/node_modules/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/node_modules/fontawesome-free-5.15.4-web/css/all.css">

    <!-- CSS selected dan pilih gambar -->
    <link rel="stylesheet" href="/assets/node_modules/chocolat/dist/css/chocolat.css">

    <link rel="stylesheet" href="/assets/node_modules/summernote/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/assets/node_modules/selectric/public/selectric.css">
    <link rel="stylesheet" href="/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

    <!-- CSS Libraries datatables -->
    <link rel="stylesheet" href="/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css">


    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            @include('admin.partials.navbar')
            @include('admin.partials.sidebar')

            <!-- Main Content -->
            @yield('container')


            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/assets/node_modules/jquery/jquery.min.js"></script>
    <script src="/assets/node_modules/cdnjs/popper.min.js"></script>
    <script src="/assets/node_modules/bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="/assets/node_modules/cdnjs/jquery.nicescroll.min.js"></script>
    <script src="/assets/node_modules/cdnjs/moment.min.js"></script>
    <script src="/assets/js/stisla.js"></script>



    <!-- JS Libraies -->
    <script src="/assets/node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="/assets/node_modules/selectric/public/jquery.selectric.min.js"></script>
    <script src="/assets/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <!-- JS Libraies datatables-->
    <script src="/assets/node_modules/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script>
    {{-- untuk gambar jadi besar --}}
    <script src="/assets/node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>


    <!-- Template JS File -->
    <script src="/assets/js/scripts.js"></script>
    <script src="/assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="/assets/js/page/features-post-create.js"></script>
    <script src="/assets/js/page/modules-datatables.js"></script>

    <script>
        $(document).ready(function() {
            $(".hapus").click(function(e) {
                e.preventDefault();
                const slug = $(this).val();
                const url = $("#url").val();
                $('#slug').text(slug);
                $('#formHapus').attr('action', url + slug)
                $('#delete').modal('show');
            });
        });
    </script>

    <script>
        $("document").ready(function() {
            //Get a reference to the new datatable
            var table = $('#table-1').DataTable();

            var statusIndex = 0;
            $("#table-1 th").each(function(i) {
                if ($($(this)).html() == "Status Aktif") {
                    statusIndex = i;
                    return false;
                }
            });

            // $("#table-1_filter.dataTables_filter").append($("#statusFilter"));

            //Use the built in datatables API to filter the existing rows by the status column
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var selectedItem = $('#statusFilter').val()
                    var status = data[statusIndex];
                    if (selectedItem === "" || status.includes(selectedItem)) {
                        return true;
                    }
                    return false;
                }
            );

            //Set the change event for the status Filter dropdown to redraw the datatable each time
            //a user selects a new filter.
            $("#statusFilter").change(function(e) {
                table.draw();
            });

            table.draw();
        });
    </script>

</body>

</html>
