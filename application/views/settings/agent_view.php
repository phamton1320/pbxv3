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
                                <h4 class="card-title">TÌM KIẾM AGENT</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="mt-1">Nhập <code>Menber</code> và <code>Queues</code> Nhấp tìm kiếm.</p>
                                    <?php //echo form_open('SettingsController') ?>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" id='name' class="form-control" placeholder="Name" required="" data-validation-required-message="Vui lòng nhập tên Extention" aria-invalid="false">
                                                    <div class="help-block"></div></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <input type="text" id='context' class="form-control" placeholder="Context" required="" data-validation-required-message="Vui lòng nhập tên người gọi" aria-invalid="false">
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
                                            var crudServiceBaseUrl = "<?php echo base_url().'QueuesController'; ?>",
                                            dataSearch = new kendo.data.DataSource({
                                                transport: {
                                                    read:  {
                                                        url:    "<?php echo base_url().'QueuesController/list_agent'; ?>",
                                                        contentType: "application/json; charset=utf-8",
                                                        dataType: 'json',
                                                        type: "POST",
                                                        data: function() {
                                                            return {
                                                                name      : $("#name").val(),
                                                                context   : $("#context").val(),
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
                                                        url: "<?php echo base_url().'QueuesController/create_agent' ;?>",
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
                                                    model: {
                                                        id: "id",
                                                        fields: {
                                                            //ProductID: { editable: false, nullable: true },
                                                            name            : { validation: { required: true } },
                                                            member         : { validation: { required: true } },
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                        
                                        <script>
                                            var stt=1;
                                            $(document).ready(function () {
                                                $("#grid").kendoGrid({
                                                    dataSource : [],
                                                    pageable: {
                                                        refresh: true,
                                                        pageSizes: true,
                                                        buttonCount: 5
                                                    },
                                                    height: 550,
                                                    toolbar: ["create"],
                                                    sortable: true,
                                                    columns: [
                                                        { field:    "id",              title:  "STT",width: "40px" },
                                                        { field:    "member",        title:  "Member",width: "220px" },
                                                        { field:    "name",          title:  "Name Queues", width: "220px" },//{ field:    "ghiamcuocgoi",     title:  "Ghi âm cuộc gọi",template: kendo.template($("#name-template").html())},
                                                        { command: [{text: " UP", iconClass: "k-icon k-i-arrow-60-up", click:up_row},{text: " DOWN", click:down_row, iconClass: "k-icon k-i-arrow-60-down"}], title: "Action", width: "200px" },
                                                    ],
                                                    editable: "popup"
                                                });
                                                var grid = $("#grid").data("kendoGrid");
                                                    grid.setDataSource(dataSearch);
                                            });

                                            
                                            function up_row(e) {
                                                var tr      = $(this).closest('tr');
                                                var rowItem = this.dataItem($(e.currentTarget).closest("tr"));
                                                var id      = rowItem.id;
                                                window.location.href = crudServiceBaseUrl+'/agentUp/'+id;
                                            }

                                            function down_row(e) {
                                                var tr      = $(this).closest('tr');
                                                var rowItem = this.dataItem($(e.currentTarget).closest("tr"));
                                                var id      = rowItem.id;
                                                window.location.href = crudServiceBaseUrl+'/agentDown/'+id;
                                            }

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