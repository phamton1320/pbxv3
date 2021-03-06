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
                                            <!-- <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" id='user_call' class="form-control" placeholder="Tên Người Gọi" required="" data-validation-required-message="Vui lòng nhập tên người gọi" aria-invalid="false">
                                                    <div class="help-block"></div></div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <input type="button" id="searchButton" name="searchButton" onclick="searchButton()" class="btn btn-primary waves-effect waves-light" value="Tìm Kiếm">
                                    <!-- </form> -->
                                    <!-- <div id="result">
                                        Nội dung ajax sẽ được load ở đây
                                    </div> -->
                                    <br/>
                                    <!-- <input type="text" value="" id="name_extention"/>
                                    <input type="button" name="clickme" id="clickme" value="Click Me"/> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bảng dữ liệu</h4>
                        </div>
                        <div class="card-content">
                        <div id="example">
                            <div id="grid_data" style="margin: 10px 10px 15px 10px;"></div>
                        </div>
                    </div>
                        <script>
                            $(document).ready(function() {
                
                                $("#grid_data").kendoGrid({
                                    dataSource: [],
                                    height: 550,
                                    toolbar: ["create","search"],
                                    
                                    //toolbar: ["search"],
                                    // pageable: {
                                    //     //refresh: true,
                                    //     pageSizes:true,
                                    //     //buttonCount: 10
                                    // },
                                    pageable: true,
                                    columns: [
                                        { field:"name", title: "Tên Extension" },
                                        { field: "usercall", title:"Tên người gọi", width: "120px" },
                                        { field: "tuchoi", title:"Từ chối", width: "120px" },
                                        { field:"chophep", title: "Cho phép" },
                                        { field:"ghiamcuocgoi", title: "Ghi âm cuộc gọi" },
                                        { command: ["edit", "destroy"], title: "&nbsp;", width: "250px" }],
                                    editable: "popup",
                                   
                                    groupable: true
                                });
                                searchDataSource.read();
                                $("#grid_data").data("kendoGrid").setDataSource(searchDataSource);
                            });
                             
                        </script>
                        <script>    
                            //var crudServiceBaseUrl = "<?php //echo base_url().'SettingsController'; ?>";
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
                                    update: {
                                        url: "<?php echo base_url().'SettingsController/Update'; ?>",
                                        contentType: "application/json; charset=utf-8",
                                        dataType: "json",
                                        type: "POST",
                                        complete:function(e){
                                            $("#grid_data").data("kendoGrid").dataSource.read();
                                        }
                                    },
                                    destroy: {
                                        url: "<?php echo base_url().'SettingsController/Destroy'; ?>",
                                        dataType: "jsonp"
                                    },
                                    create: {
                                        url: "<?php echo base_url().'SettingsController/Create'; ?>",
                                        contentType: "application/json; charset=utf-8",
                                        dataType: 'json',
                                        type: "POST",
                                        data: function() {
                                            return {
                                                name_extention  : $("#name_extention").val()
                                            }
                                        },
                                        
                                        complete:function(){
                                            $("#grid_data").data("kendoGrid").dataSource.read();
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
                                serverPaging: true,
                                batch: true,
                                pageSize: 5,
                                schema: {
                                    data: "data", // records are returned in the "data" field of the response
                                    total: "total", // total number of records is in the "total" field of the response
                                    errors: "errors",
                                    model: {
                                        id: "id",
                                        fields: {
                                            //ProductID: { editable: false, nullable: true },
                                            name        : { validation: { required: true } },
                                            usercall    : { validation: { required: true } },
                                            tuchoi      : { validation: { required: true } },
                                            chophep     : { validation: { required: true } },
                                            ghiamcuocgoi: { validation: { required: true } },
                                        }
                                    }
                                }
                            });

                            function searchButton() {
                                searchDataSource.read();
                                // $("#grid").data("kendoGrid").setDataSource(searchDataSource);
                            } 
                            
                            // function customBoolEditor(container, options) {
                            //     $('<input class="k-checkbox" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
                            // }

                            function onDataBound() {
                                var grid = this;

                                grid.element.off('dblclick');

                                grid.element.on('dblclick','tbody tr[data-uid]',function (e) {
                                    grid.editRow($(e.target).closest('tr'));
                                })
                            }
                            function customBoolEditor(container, options) {
                                $('<input class="k-checkbox" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
                                $('<label class="k-checkbox-label">​</label>').appendTo(container);
                            }
                        </script>
                    </div>
                    </div>
                    </div>

                    <style type="text/css">
                        .customer-photo {
                            display: inline-block;
                            width: 32px;
                            height: 32px;
                            border-radius: 50%;
                            background-size: 32px 35px;
                            background-position: center center;
                            vertical-align: middle;
                            line-height: 32px;
                            box-shadow: inset 0 0 1px #999, inset 0 0 10px rgba(0,0,0,.2);
                            margin-left: 5px;
                        }

                        .customer-name {
                            display: inline-block;
                            vertical-align: middle;
                            line-height: 32px;
                            padding-left: 3px;
                        }
                    </style>
                    

                        </div>
                    </div>
                </div>
            </section>
            <!-- Dashboard Analytics end -->

        </div>
    </div>
</div>