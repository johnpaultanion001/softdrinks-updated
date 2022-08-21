<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('sub-title') | {{ trans('panel.site_title') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="https://n7.nextpng.com/sticker-png/649/178/sticker-png-cartoon-blog-graphics-red-j-hat-orange-copyright-cartoon.png"/>
   
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- css -->
    <link href="{{ asset('/assets/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/css/argon.css?v=1.2.0') }}" type="text/css" rel="stylesheet" />
   

    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    
    <!-- datatables -->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    
   
    
    @yield('third_party_stylesheets')
    @stack('page_css')

    <style>
    
    .chart-area {
        position: relative;
        height: 20rem;
        width: 100%;
    }
    
    .select2-container--default .select2-selection--single {
    background-color: #fff;
    border-radius: 4px;
    height: auto;
    }
    
    .modal-backdrop
    {
        opacity:0.5 !important;
    }
    .select2 {
        border: 1px solid #111;
        border-radius: 4px;
        color: #111;
       
    }
    .form-control{
        border: 1px solid #111;
        color: #111;
        font-weight: bold;
    }
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active
    {
    -webkit-box-shadow: 0 0 0 30px white inset !important;
    }
    .receipt-body{
        overflow: auto;
        max-height: 270px;
    }
    .box{
    width:600px;
    margin:0 auto;
   }
   .form-control[readonly] {
        background-color: whitesmoke;
        font-weight: bold;
        cursor: not-allowed;
    }

    
        
    
  
  
    </style>
</head>
    <body class="bg-default">
        <!-- sidebar -->
        @yield('sidebar')

            <div class="main-content" id="panel">
                <!-- Topnav -->
                    @yield('navbar')
                    <!-- Header -->
                    <!-- Header -->
                    <!-- Page content -->
                    @yield('content')
                    @yield('footer')
            </div>

            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
             </form>
        

      
        <script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/js-cookie/js.cookie.js') }}"></script>
        <script src="{{ asset('/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
       
        <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
        <script src="{{ asset('/assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
        <script src="{{ asset('/assets/js/argon.js?v=1.2.0') }}"></script>

  
       
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        
        <!-- datatables -->
        
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

        <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://unpkg.com/@coreui/coreui@2.1.16/dist/js/coreui.min.js"></script>
       
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
        
       


    <script>
        $(function() {
            let copyButtonTrans = 'COPY'
            let csvButtonTrans = 'CSV'
            let excelButtonTrans = 'EXCEL'
            let pdfButtonTrans = 'PDF'
            let printButtonTrans = 'PRINT'
            let colvisButtonTrans = 'VIEW'

            let languages = {
            'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn btn-sm mt-1 btn-default ' })
            $.extend(true, $.fn.dataTable.defaults, {
            language: {
                url: languages['{{ app()->getLocale() }}']
            },
            
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
                {
                extend: 'copy',
                className: 'btn-default btn-sm mt-1 mb-1 copies',
                text: copyButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'csv',
                className: 'btn-default btn-sm mt-1 mb-1',
                text: csvButtonTrans,
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'excel',
                className: 'btn-default btn-sm mt-1 mb-1',
                text: excelButtonTrans,
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'pdf',
                className: 'btn-default btn-sm mt-1 mb-1',
                text: pdfButtonTrans,
                footer: true,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'print',
                    className: 'btn-default btn-sm mt-1 mb-1',
                    text: printButtonTrans,
                    footer: true,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                extend: 'colvis',
                className: 'btn-default btn-sm mt-1 mb-1',
                text: colvisButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                
                }
            ]
            });
            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>
  
        @yield('script')
    </body>
</html>
