<!DOCTYPE html>
<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard analytics - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="<?php echo base_url() ?>app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/vendors/css/extensions/shepherd-theme-default.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>app-assets/css/plugins/tour/tour.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Kendo-->
    <link rel="stylesheet" href="<?php echo base_url() ?>styles/kendo.common.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>styles/kendo.default.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>styles/kendo.default.mobile.min.css" />
    <script src="<?php echo base_url() ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>js/kendo.all.min.js"></script>
    <!-- END: Kendo-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
    <!-- END: Custom CSS-->
</head>
<body>

    <form action="" id="form" method="post" style="padding-bottom: 30px">
        <input type="text" id="name_extention" name="name_extention" class="form-control col-sm-3" placeholder="Key Word" />
    </form>
    <input type="button" id="searchButton" name="searchButton" onclick="searchButton()" value="Xem" class="btn btn-primary" />
    <div id="grid"></div>
    <script>
            $(document).ready(function() {
                
                $("#grid").kendoGrid({
                    dataSource: [],
                    "columns": [
                        {
                            "field": "name",
                            "title": "Ten Extention",
                        },
                        {
                            "field": "usercall",
                            "title": "ten nguoi goi",
                        },
                        {
                            "field": "tuchoi",
                            "title": "tu choi",
                        },
                    ],
                    "pageable": true,
                    groupable: true
                });
                searchDataSource.read();
                $("#grid").data("kendoGrid").setDataSource(searchDataSource);
            });
    </script>
    
    <script>
        var searchDataSource = new kendo.data.DataSource({
        autoSync: true,
        transport: {
            read : {
                url           : "<?php echo base_url().'SettingsController/search'; ?>",
                contentType   : "application/json; charset=utf-8",
                type          : "POST",
                dataType      : 'json',   
                data: function() {
                    return {
                        name_extention  : $("#name_extention").val()
                    }
                },
            },
            parameterMap : function (data) {
                return kendo.stringify(data);
            },
        },
        batch : true,
        schema : {
            data  : "data",
            total : "total",
            model : {
                id: "id",
                fields: [
                    {
                        field : "name",
                        type  : "string",
                    },
                    {
                        field : "usercall",
                        type  : "string",
                    },
                    {
                        field : "tuchoi",
                        type  : "string",
                    }
                ],
            },
        },
        // parse: function(data) {
        //     $.each(data.data, function(key, value) {
        //         return value.name;
        //     });
        // },
        serverPaging  : true,
        pageSize      : 6,
        
    });
    function searchButton() {
        searchDataSource.read();
        // $("#grid").data("kendoGrid").setDataSource(searchDataSource);
    }
    </script>
</body>
</html>