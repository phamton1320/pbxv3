<!DOCTYPE html>
<html>
<head>
    <!-- BEGIN: Kendo-->
    <base href="https://demos.telerik.com/kendo-ui/grid/editing-popup">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.1118/styles/kendo.default-v2.min.css" />

    <script src="https://kendo.cdn.telerik.com/2020.3.1118/js/jquery.min.js"></script>
    
    
    <script src="https://kendo.cdn.telerik.com/2020.3.1118/js/kendo.all.min.js"></script>
    
    
    <!-- END: Kendo-->
</head>
<body>
    <div id="example">
        <form action="" method="post">
            <input type="text" id='name_extention'>
        </form>
        <input type="button" id="searchButton" onclick="searchButton()" value="Search">
        <div id="grid"></div>
        <script>
        $(document).ready(function () {
            $("#grid").kendoGrid({
                dataSource: [],
                pageable: true,
                height: 550,
                toolbar: ["create"],
                columns: [
                    { field:"name", title: "Name Extention" },
                    { field: "usercall", title:"User Call"},
                    { field: "ghiamcuocgoi", title:"Status"},
                    { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
                editable: "popup",
                
            });
            //searchDataSource.read();
            $("#grid").data("kendoGrid").setDataSource(searchDataSource);
        });
            // Biến tạo DataSource
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

                create: {
                    url: "<?php echo base_url().'SettingsController/Create' ;?>",
                    contentType: "application/json; charset=utf-8",
                    dataType: 'json',
                    type: "POST",
                    complete:function(e){
                        $("#grid").data("kendoGrid").dataSource.read();
                    }
                },
                // parameterMap : function (options, operation) {
                //     console.log(kendo.stringify(options));
                //     return kendo.stringify(options);
                // },
                parameterMap: function(options, operation) {
                    if (operation !== "read" && options.models) {
                        return {models: kendo.stringify(options.models)};
                    }else{
                        return {models: kendo.stringify(options.models)};
                        //return kendo.stringify(options);
                    }
                }
            },
            batch : true,
            serverPaging  : true,
            pageSize      : 6,
            // pageable: {
            //     refresh: true,
            //     pageSizes: true,
            //     buttonCount: 5
            // },
            
            schema : {
                data  : "data",
                total : "total",
                model : {
                    id: "id",
                    fields: [
                        {
                            editable: false,
                            nullable: true
                        },
                        {
                            field : "name",
                            type  : "string",
                            validation: { required: true }
                        },
                        {
                            field : "usercall",
                            type  : "string",
                            validation: { required: true }
                        },
                        {
                            field : "ghiamcuocgoi",
                            type  : "string",
                            validation: { required: true }
                        }
                    ],
                },
            },
        });
        // dataSource.fetch(function() {
        //     var product = dataSource.at(0);
        //     product.set("UnitPrice", 20); // auto-syncs and makes request to https://demos.telerik.com/kendo-ui/service/products/update
        // });
        function searchButton() {
            searchDataSource.read();
            // $("#grid").data("kendoGrid").setDataSource(searchDataSource);
        }
        function customBoolEditor(container, options) {
            $('<input class="k-checkbox" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
        }
    </script>
    </div>
</body>
</html>