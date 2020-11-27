<!DOCTYPE html>
<html>
<head>
    <base href="https://demos.telerik.com/kendo-ui/grid/editing-popup">
    <style>html { font-size: 14px; font-family: Arial, Helvetica, sans-serif; }</style>
    <title></title>
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2020.3.1118/styles/kendo.default-v2.min.css" />

    <script src="https://kendo.cdn.telerik.com/2020.3.1118/js/jquery.min.js"></script>
    
    
    <script src="https://kendo.cdn.telerik.com/2020.3.1118/js/kendo.all.min.js"></script>
    
</head>
<body>
    <div id="example">
        <form action="" method="post">
            <input type="text" id='name_extention'>
        </form>
        <input type="button" id="searchButton" onclick="searchButton()" value="Search">
        <div id="grid"></div>

    <script>
        var crudServiceBaseUrl = "<?php echo base_url().'SettingsController'; ?>";
                dataSource2 = new kendo.data.DataSource({
                    transport: {
                        read:  {
                            url:    "<?php echo base_url().'SettingsController/search'; ?>",
                            contentType: "application/json; charset=utf-8",
                            dataType: 'json',
                            type: "POST",
                            data: function() {
                                return {
                                    name_extention  : $("#name_extention").val()
                                }
                            },
                        },
                        update: {
                            url: crudServiceBaseUrl + "/Update",
                            contentType: "application/json; charset=utf-8",
                            dataType: "json",
                            type: "POST",
                            complete:function(e){
                                $("#grid").data("kendoGrid").dataSource.read();
                            }
                        },
                        destroy: {
                            url: crudServiceBaseUrl + "/Products/Destroy",
                            dataType: "jsonp"
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
                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                //return {models: kendo.stringify(options.models)};
                                console.log(kendo.stringify(options.models));
                                return kendo.stringify(options.models);
                            }
                            else {
                                return kendo.stringify(options);
                            }
                        }
                    },
                    pageSize: 100,
                    serverPaging: true,
                    batch: true,
                    schema: {
                        data: "data", // records are returned in the "data" field of the response
                        total: "dotal", // total number of records is in the "total" field of the response
                        errors: "errors",
                        model: {
                            id: "id",
                            fields: {
                                //ProductID: { editable: false, nullable: true },
                                name: { validation: { required: true } },
                                usercall: { validation: { required: true } },
                                tuchoi: { validation: { required: true } },
                                chophep: { validation: { required: true } },
                                ghiamcuocgoi: { validation: { required: true } },
                            }
                        }
                    }
                });
        $(document).ready(function () {
            $("#grid").kendoGrid({
                dataSource: {
                    transport: {
                        read:  {
                            url:    "<?php echo base_url().'SettingsController/list_settings'; ?>",
                            contentType: "application/json; charset=utf-8",
                            dataType: 'json',
                            type: "POST",
                        },
                        
                        parameterMap: function(options, operation) {
                            if (operation !== "read" && options.models) {
                                //return {models: kendo.stringify(options.models)};
                                console.log(kendo.stringify(options.models));
                                return kendo.stringify(options.models);
                            }
                            else {
                                return kendo.stringify(options);
                            }
                        }
                    },
                    pageSize: 5,
                    serverPaging: true,
                    batch: true,
                    schema: {
                        data: "data", // records are returned in the "data" field of the response
                        total: "dotal", // total number of records is in the "total" field of the response
                        errors: "errors",
                        model: {
                            id: "id",
                            fields: {
                                //ProductID: { editable: false, nullable: true },
                                name: { validation: { required: true } },
                                usercall: { validation: { required: true } },
                                tuchoi: { validation: { required: true } },
                                chophep: { validation: { required: true } },
                                ghiamcuocgoi: { validation: { required: true } },
                            }
                        }
                    }
                },
                toolbar: ["create","search"],
                height: 550,
                groupable: true,
                sortable: true,
                pageable: {
                    refresh: true,
                    pageSizes: true,
                    buttonCount: 5
                },
                columns: [
                    { field:"name", title: "Tên Extension" },
                    { field: "usercall", title:"Tên người gọi", width: "120px" },
                    { field: "tuchoi", title:"Từ chối", width: "120px" },
                    { field:"chophep", title: "Cho phép" },
                    { field:"ghiamcuocgoi", title: "Ghi âm cuộc gọi" },
                    { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
                editable: "popup",
            });
            
            var grid = $("#grid").data("kendoGrid");
                grid.setDataSource(dataSource2);
        });
        function searchButton() {
                    dataSource2.read();
                    //$("#grid").data("kendoGrid").setDataSource(dataSource2);
                }
        function customBoolEditor(container, options) {
            $('<input class="k-checkbox" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
        }
    </script>
</div>


    

</body>
</html>