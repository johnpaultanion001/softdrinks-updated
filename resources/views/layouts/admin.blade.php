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
    }
    .form-control[readonly] {
    background-color: white;
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
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'excel',
                className: 'btn-default btn-sm mt-1 mb-1',
                text: excelButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                extend: 'pdf',
                className: 'btn-default btn-sm mt-1 mb-1',
                text: pdfButtonTrans,
                exportOptions: {
                    columns: ':visible'
                }
                },
                {
                    extend: 'print',
                    className: 'btn-default btn-sm mt-1 mb-1',
                    titleAttr: 'Click this print',
                    text: printButtonTrans,
                    exportOptions: {
                    columns: ':visible'
                    },
                        customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '1px' )
                            .prepend(
                                '<img src="data:image/jpeg;base64,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" alt="Logo"  style="position:absolute; top:30%; left:20%; opacity: 0.1; width: 620px;" />'
                            );
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' , 'margin-top' , '20%' , 'width' , '100%');
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
