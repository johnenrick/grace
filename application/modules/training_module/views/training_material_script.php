<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
    
    /*Module Object*/
    var TrainingMaterialTab  = function(trainingModule){
        var trainingMaterialTab = this;//instance of the module
        var moduleBody = trainingMaterialTab.body = trainingModule.body.find("#trainingMaterialTab");
        load_component("table_component", function(){
            var columnConfiguration = [{
                description : "ID",
                table_column : "training_module__ID",
                default_sort : 1
            },{
                description : "Description",
                table_column : "training_material__description",
                default_sort : 1
            },{
                description : "Training Module",
                table_column : "training_module__description",
                default_sort : 1
            },{
                description : "Action"
            }];
            var filterConfiguration = {
                fieldFilter :[{
                        description : "Description",
                        table_column : "like__training_material__description",
                        type : "text"
                },{
                        description : "Training Module",
                        table_column : "like__training_module__description",
                        type : "text"
                }]
            };
            var resultConfiguration = {
                result_link : api_url("c_training_material/retrieveTrainingMaterial"),
                success : listModule,
                limit : 5
            };
            trainingMaterialTab.trainingMaterialTableList = new TableComponent(moduleBody.find('.trainingMaterialTableContainer'), resultConfiguration, columnConfiguration, filterConfiguration);
            trainingMaterialTab.trainingMaterialTableList.table.on("click", ".viewTrainingMaterialInformation", function(){
                
                viewTrainingMaterialInformation($(this).parent().parent().attr("training_material_id"));
            });
        });
        trainingMaterialTab.uploadForm = commonFormHandler(moduleBody.find("#trainingMaterialInformation form"), "c_training_material/createTrainingMaterial", "c_training_material/updateTrainingMaterial", "c_training_material/deleteTrainingMaterial");
        trainingMaterialTab.uploadForm.createForm(function(){
            trainingMaterialTab.uploadForm.formElement.find(".formActionButton button[action=cancel]").hide();
        });
        trainingMaterialTab.uploadForm.submitCreateSuccess = function(response){
            if(!response["error"].length){
                trainingMaterialTab.uploadForm.createForm(formCreateFormCallback);
                trainingMaterialTab.trainingMaterialTableList.retrieveEntry();
            }
        };
        trainingMaterialTab.uploadForm.submitDeleteSuccess = function(response){
            if(response["data"]){
                trainingMaterialTab.uploadForm.createForm(formCreateFormCallback);
                trainingMaterialTab.trainingMaterialTableList.retrieveEntry();
            }
        }
        trainingMaterialTab.uploadForm.submitUpdateSuccess = function(response){
            if(response["data"]){
                trainingMaterialTab.uploadForm.createForm(formCreateFormCallback);
                trainingMaterialTab.trainingMaterialTableList.retrieveEntry();
            }
            
        };
        /*Events*/
        trainingMaterialTab.uploadForm.formElement.find(".formActionButton button[action=cancel]").click(function(){
             trainingMaterialTab.uploadForm.createForm(formCreateFormCallback);
        });
        moduleBody.find("#trainingMaterialInformation #downloadMaterial").click(function(){
            
        });
        moduleBody.find("#trainingMaterialInformation select[field_name=training_module_ID]").change(function(){
            listTrainingModuleGroup();
        });
        /*Functions*/
        function listTrainingModule(){
            moduleBody.find("#trainingMaterialInformation select[field_name=training_module_ID]").empty();
            var request = api_request("c_training_module/retrieveTrainingModule", {}, function(response){
                if(!response["error"].length){
                    moduleBody.find("#trainingMaterialInformation select[field_name=training_module_ID]").append("<option value='"+0+"'>Select Training Module</option>");
                    for(var x =0; x <response["data"].length;x++){
                        moduleBody.find("#trainingMaterialInformation select[field_name=training_module_ID]").append("<option value='"+response["data"][x]["ID"]+"'>"+response["data"][x]["description"]+"</option>");
                    }
                }
            });
            return request;
        }
        
        
        /*FUNCTIONS*/
        function formCreateFormCallback(){
            trainingMaterialTab.uploadForm.formElement.find(".formActionButton button[action=cancel]").hide()
            trainingMaterialTab.uploadForm.formElement.find("#trainingMaterialFileUploadInput").parent().show();
            trainingMaterialTab.uploadForm.formElement.find("#downloadMaterial").parent().hide();   
            trainingMaterialTab.uploadForm.formElement.find(".formActionButton button[type=submit]").html('<i class="fa fa-upload" aria-hidden="true"></i> Upload File');
        }
        function listModule(data){
            for(var x = 0; x < data.length; x++){
                var newRow = moduleBody.find(".prototype").find(".trainingMaterialRow").clone();
                newRow.attr("training_material_id", data[x]["ID"]);
                newRow.find(".trainingMaterialID").text(data[x]["ID"]);
                newRow.find(".trainingMaterialDescription").text(data[x]["description"]);
                newRow.find(".trainingMaterialModuleDescription").text(data[x]["training_module_description"]);
                if(data[x]["uploader_account_ID"]*1 === user_id()){
                    newRow.find(".viewTrainingMaterialInformation").show();
                }else{
                    newRow.find(".downloadMaterial").show();
                    newRow.find(".downloadMaterial").attr("href", asset_url("user_upload/"+data[x]["uploader_account_ID"]+"/"+data[x]["file_uploaded_description"]));
                    newRow.find(".downloadMaterial").attr("download", data[x]["description"]);
                }
                trainingMaterialTab.trainingMaterialTableList.table.append(newRow);
            }
        }
        function viewTrainingMaterialInformation(trainingMaterial){
            trainingMaterialTab.uploadForm.updateForm(function(){
                trainingMaterialTab.uploadForm.formElement.find("#trainingMaterialFileUploadInput").parent().hide();
                trainingMaterialTab.uploadForm.formElement.find("#downloadMaterial").parent().show(); 
                 trainingMaterialTab.uploadForm.formElement.find(".formActionButton button[type=submit]").html('<i class="fa fa-save" aria-hidden="true"></i> Save');
            });
            api_request("c_training_material/retrieveTrainingMaterial", {ID : trainingMaterial}, function(response){
                trainingMaterialTab.trainingMaterialTableList.table.find(".viewTrainingMaterialInformation").attr("disabled", false);
                if(!response["error"].length){
                    changeFieldName("update", moduleBody.find("#trainingMaterialInformation form"));
                    moduleBody.find("#trainingMaterialInformation form input[name=ID]").val(response["data"]["ID"]);
                    moduleBody.find("#trainingMaterialInformation form #trainingMaterialFileUploadLabel").text(response["data"]["file_uploaded_description"]);
                    moduleBody.find("#trainingMaterialInformation form input[field_name=description]").val(response["data"]["description"]);
                    moduleBody.find("#trainingMaterialInformation form select[field_name=training_module_ID]").val(response["data"]["training_module_ID"]);
                    var trainingModuleGroupRequest = listTrainingModuleGroup();
                    trainingModuleGroupRequest.done(function(){
                        moduleBody.find("#trainingMaterialInformation form select[field_name=training_module_group_ID]").val(response["data"]["training_module_group_ID"]);
                    })
                    moduleBody.find("#trainingMaterialInformation form #downloadMaterial").attr("href", asset_url("user_upload/"+response["data"]["uploader_account_ID"]+"/"+response["data"]["file_uploaded_description"]));
                    moduleBody.find("#trainingMaterialInformation form #downloadMaterial").attr("download", response["data"]["description"]);
                }
            });
        }
        function listTrainingModuleGroup(){
            moduleBody.find("#trainingMaterialInformation select[field_name=training_module_group_ID]").empty();
            moduleBody.find("#trainingMaterialInformation select[field_name=training_module_group_ID]").append("<option value='"+0+"'>All</option>");
            var condition = {
                training_module_ID: moduleBody.find("#trainingMaterialInformation select[field_name=training_module_ID]").val()
            };
            var request = api_request("c_training_module_group/retrieveTrainingModuleGroup", { condition : condition}, function(response){
                console.log(condition);
                if(!response["error"].length){
                    for(var x =0; x <response["data"].length;x++){
                        moduleBody.find("#trainingMaterialInformation select[field_name=training_module_group_ID]").append("<option value='"+response["data"][x]["ID"]+"'>"+"Grp. "+response["data"][x]["ID"]+"</option>");
                    }
                }
            });
            return request;
        }
        trainingMaterialTab.ready = function(){
            listTrainingModule();
        };
    };
    

</script>