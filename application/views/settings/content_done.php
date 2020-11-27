<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <!-- Dashboard Analytics Start -->
            <section id="dashboard-analytics">
                <div class="row">
                    <div class="col-12">
                         <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">TÌM KIẾM SIP</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="mt-1">Nhập <code>Tên Extension</code> và <code>Tên người gọi</code> Nhấp tìm kiếm.</p>
                                    <?php //echo form_open('SettingsController') ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" id='name_extention' class="form-control" placeholder="Tên Extention" required="" data-validation-required-message="Vui lòng nhập tên Extention" aria-invalid="false">
                                                    <div class="help-block"></div></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" id='user_call' class="form-control" placeholder="Tên Người Gọi" required="" data-validation-required-message="Vui lòng nhập tên người gọi" aria-invalid="false">
                                                    <div class="help-block"></div></div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="button" id="searchButton" onclick="searchButton()"  class="btn btn-primary waves-effect waves-light" value="Tìm Kiếm">
                                    <!-- </form> -->
                                    <div id="example">
                                        <hr>
                                        <div id="grid"></div>
                                        <script>
                                            var crudServiceBaseUrl = "<?php echo base_url().'SettingsController'; ?>",
                                            dataSearch = new kendo.data.DataSource({
                                                transport: {
                                                    read:  {
                                                        url:    "<?php echo base_url().'SettingsController/search'; ?>",
                                                        contentType: "application/json; charset=utf-8",
                                                        dataType: 'json',
                                                        type: "POST",
                                                        data: function() {
                                                            return {
                                                                name_extention  : $("#name_extention").val(),
                                                                user_call       : $("#user_call").val(),
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
                                                        url: crudServiceBaseUrl + "/Destroy",
                                                        contentType: "application/json; charset=utf-8",
                                                        dataType: "json",
                                                        type: "POST",
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
                                                            return kendo.stringify(options.models);
                                                        }
                                                        else {
                                                            return kendo.stringify(options);
                                                        }
                                                    }
                                                },
                                                
                                                serverPaging  : true,
                                                batch: true,
                                                pageSize: 20,
                                                schema: {
                                                    data: "data", // records are returned in the "data" field of the response
                                                    total: "total", // total number of records is in the "total" field of the response
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
                                        </script>
                                        <script>
                                            $(document).ready(function () {
                                                $("#grid").kendoGrid({
                                                    // dataSource: {
                                                    //     transport: {
                                                    //         read:  {
                                                    //             url: crudServiceBaseUrl + "/list_settings",
                                                    //             contentType: "application/json; charset=utf-8",
                                                    //             dataType: 'json',
                                                    //             type: "POST",
                                                    //         },
                                                    //         // parameterMap: function(options, operation) {
                                                    //         //     if (operation !== "read" && options.models) {
                                                    //         //         return {models: kendo.stringify(options.models)};
                                                    //         //     }
                                                    //         // }
                                                    //         parameterMap: function(options, operation) {
                                                    //             if (operation !== "read" && options.models) {
                                                    //                 //return {models: kendo.stringify(options.models)};
                                                    //                 console.log(kendo.stringify(options.models));
                                                    //                 return kendo.stringify(options.models);
                                                    //             }
                                                    //             else {
                                                    //                 return kendo.stringify(options);
                                                    //             }
                                                    //         }
                                                    //     },
                                                    //     serverPaging  : true,
                                                        
                                                    //     batch: true,
                                                    //     pageSize: 5,
                                                    //     schema: {
                                                    //         data: "data", // records are returned in the "data" field of the response
                                                    //         total: "total", // total number of records is in the "total" field of the response
                                                    //         errors: "errors",
                                                    //         model: {
                                                    //             id: "id",
                                                    //             fields: {
                                                    //                 //ProductID: { editable: false, nullable: true },
                                                    //                 name: { validation: { required: true } },
                                                    //                 usercall: { validation: { required: true } },
                                                    //                 tuchoi: { validation: { required: true } },
                                                    //                 chophep: { validation: { required: true } },
                                                    //                 ghiamcuocgoi: { validation: { required: true } },
                                                    //             }
                                                    //         }
                                                    //     }
                                                    // },
                                                    dataSource : [],
                                                    pageable: {
                                                        refresh: true,
                                                        pageSizes: true,
                                                        buttonCount: 5
                                                    },
                                                    height: 550,
                                                    toolbar: ["create"],
                                                    columns: [
                                                        { field:"name", title: "Tên Extension" },
                                                        { field: "usercall", title:"Tên người gọi", width: "120px" },
                                                        { field: "tuchoi", title:"Từ chối", width: "120px" },
                                                        { field:"chophep", title: "Cho phép" },
                                                        { field:"ghiamcuocgoi", title: "Ghi âm cuộc gọi" },
                                                        { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
                                                    editable: "popup"
                                                });
                                                var grid = $("#grid").data("kendoGrid");
                                                grid.setDataSource(dataSearch);

                                                
                                            });
                                            function searchButton() {
                                                dataSearch.read();
                                                $("#grid").data("kendoGrid").setDataSource(searchDataSource);
                                            }
                                            
                                            function customBoolEditor(container, options) {
                                                $('<input class="k-checkbox" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
                                            }
                                        </script>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>