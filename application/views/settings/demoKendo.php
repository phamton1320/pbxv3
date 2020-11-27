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
    
<div id="example">
    Filter all fields:
    <input id='filter' class='k-textbox'/>
    <button id="timkiem">Search</button>
    <div id="grid"></div>

    <script>        
    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function getBoolean(str) {
        if("true".startsWith(str)){
        return true;
        } else if("false".startsWith(str)){
        return false;
        } else {
        return null;
        }          
    }

        $(document).ready(function () {
            var crudServiceBaseUrl = "<?php echo base_url().'SettingsController'; ?>";
            $("#grid").kendoGrid({
                dataSource: {
                    transport: {
                        read:  {
                            url: crudServiceBaseUrl + "/list_settings",
                            contentType: "application/json; charset=utf-8",
                            dataType: 'json',
                            type: "POST",
                        },
                    },
                    schema: {
                        data: "Data", // records are returned in the "data" field of the response
                        total: "Total", // total number of records is in the "total" field of the response
                        errors: "Errors",
                        model: {
                            fields: {
                                id:         { type: "string" },
                                name:       { type: "string" },
                                usercall:   { type: "string" },
                                tuchoi :    { type: "string" },
                            }
                        }
                    }
                },
                height: 550,
                pageable: {
                    //refresh: true,
                    pageSizes:true,
                    //buttonCount: 10
                },
                columns: [
                    { field:    "id"},
                    { field:    "name"},
                    { field:    "usercall"},
                    { field:    "tuchoi"}
                ]
            });

            // $('#filter').on('input', function (e) {
            //     var grid = $('#grid').data('kendoGrid');
            //     var columns = grid.columns;

            //     var filter = { logic: 'or', filters: [] };
            //     columns.forEach(function (x) {
            //         if (x.field) {
            //             var type = grid.dataSource.options.schema.model.fields[x.field].type;
            //             if (type == 'string') {
            //                 filter.filters.push({
            //                     field: x.field,
            //                     operator: 'contains',
            //                     value: e.target.value
            //                 })
            //             }
            //         }
            //     });
            //     grid.dataSource.filter(filter);
            // });

            function onSearch()
            {
                var q = $("#filter").val();
                var grid = $("#grid").data("kendoGrid");
                var columns = grid.columns;
                var filter = { logic: 'or', filters: [] };
                columns.forEach(function (x) {
                    if (x.field) {
                        var type = grid.dataSource.options.schema.model.fields[x.field].type;
                        if (type == 'string') {
                            filter.filters.push({
                                field: x.field,
                                operator: 'contains',
                                value: q // kq hien ra o day
                            })
                        }
                    }
                });
                grid.dataSource.filter(filter);
            }
            $("#timkiem").kendoButton({
                click:onSearch
            });
        });
    </script>
    </div>
</body>
</html>
