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
                                <h4 class="card-title">TÌM KIẾM QUEUES</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <p class="mt-1">Nhập <code>Name</code> và <code>Context</code> Nhấp tìm kiếm.</p>
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
                                        <div id="details"></div>
                                        <script>
                                            var crudServiceBaseUrl = "<?php echo base_url().'QueuesController'; ?>",
                                            dataSearch = new kendo.data.DataSource({
                                                transport: {
                                                    read:  {
                                                        url:    "<?php echo base_url().'QueuesController/search'; ?>",
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
                                                        url: "<?php echo base_url().'QueuesController/Create' ;?>",
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
                                                            name            : { validation: { required: true } },
                                                            context         : { validation: { required: true } },
                                                            description     : { validation: { required: true } },
                                                            autopause       : { validation: { required: true } },
                                                            retry           : { validation: { required: true } },
                                                            ghiamcuocgoi    : { validation: { required: true } },
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                        
                                        <!-- <span class="k-icon #: ghiamcuocgoi #"></span> -->
                                        <script id="name-template" type="text/x-kendo-template">
                                            <span class="k-icon #: ghiamcuocgoi #"></span>
                                           
                                        </script>
                                        <!-- #: id # -->
                                        <script>
                                            var wnd,
                                                detailsTemplate;
                                                
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
                                                    columns: [
                                                        { field:    "name",             title:  "Name" },
                                                        { field:    "context",          title:  "Context", width: "120px" },
                                                        { field:    "description",      title:  "Description", width: "120px" },
                                                        { field:    "autopause",        title:  "Auto Pause" },
                                                        { field:    "retry",            title:  "Retry" },
                                                        { field:    "ghiamcuocgoi",     title:  "Ghi âm cuộc gọi",template: kendo.template($("#name-template").html())},
                                                        // {command : [{name:"edit"},{name:"destroy"},{template: '<a href="agent/" class="k-button link">Views</a>'}]},
                                                        
                                                        { command: ["edit", "destroy"], title: "Action", width: "200px" },
                                                        
                                                        { field:"", title:"Views", template: '<a href="agent/#= id #" class="k-button link">Views</a>' },

                                                        //Start ShowDetails
                                                        // { command:{text: "Xem",click: showDetails},title: " ", width: "80px"}
                                                        //end ShowDetails
                                                    ],
                                                    editable: "popup"
                                                });
                                                //Start ShowDetails
                                                // wnd = $("#details")
                                                //     .kendoWindow({
                                                //         title: "Customer Details",2y
                                                //         modal: true,
                                                //         visible: false,
                                                //         resizable: false,
                                                //         width: 300
                                                //     }).data("kendoWindow");
                                                
                                                //detailsLink = kendo.template($("#template").html());

                                                // detailsTemplate = kendo.template($("#template").html());
                                                // console.log(detailsTemplate);
                                                // //end ShowDetails
                                                // Set data tu bien datasearch vao
                                                var grid = $("#grid").data("kendoGrid");
                                                    grid.setDataSource(dataSearch);
                                                    
                                            });
                                            //Start ShowDetails
                                            function showDetails(e) {
                                                $("#details").html(detailsTemplate({}));
                                                // e.preventDefault();

                                                // var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
                                                // wnd.content(detailsTemplate(dataItem));
                                                //wnd.center().open();
                                            }
                                            //end ShowDetails
                                            function searchButton() {
                                                dataSearch.read();
                                                $("#grid").data("kendoGrid").setDataSource(searchDataSource);
                                            }
                                            
                                            function customBoolEditor(container, options) {
                                                $('<input class="k-checkbox" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
                                            }
                                        </script>
                                        <script type="text/x-kendo-template" id="template">
                                            <div id="details-container">
                                                <a href="http://localhost/pbxv3/queuescontroller/#= id #" class="k-button">
                                                <span class="k-icon k-i-copy"></span> Views
                                                </a>
                                                <h2>#= id #</h2>
                                                <h2>#= name #</h2>
                                                <h2>#= context #</h2>
                                                <h2>#= description #</h2>
                                                <h2>#= autopause #</h2>
                                            </div>
                                        </script>
                                        
                                        <style type="text/css">
                                            #details-container
                                            {
                                                padding: 10px;
                                            }

                                            #details-container h2
                                            {
                                                margin: 0;
                                            }
                                        </style>
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