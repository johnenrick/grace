<script>
    /*global systemApplication, systemUtility, pad*/
    
    /*Adding an asset*/
    load_asset("module/group_management.css");
    /*Group Object*/
    var GroupManagementTab  = function(){
        var groupManagementTab = this;//instance of the module
        var moduleBody = groupManagementTab.body = $("#groupManagementTab");
        load_component("table_component", function(){
            var columnConfiguration = [{
                description : "ID",
                table_column : "training_module_group__ID",
                default_sort : 1
            },{
                description : "Module",
                table_column : "training_module__description",
                default_sort : 1
            },{
                description : "Instructor",
                table_column : "instructor_account_information__first_name__CONCAT__instructor_account_information__middle_name__CONCAT__instructor_account_information__last_name",
                default_sort : 1
            },{
                description : "Schedule",
                table_column : "training_module_group_schedule__start_time__CONCAT__training_module_group_schedule__end_time",
                default_sort : 1
            },{
                description : "Action"
            }];
            var filterConfiguration = {
                fieldFilter :[{
                        description : "Module",
                        table_column : "like__training_module__description",
                        type : "text"
                },{
                        description : "Instructor",
                        table_column : "like__instructor_account_information__first_name__CONCAT__instructor_account_information__middle_name__CONCAT__instructor_account_information__last_name",
                        type : "text"
                },{
                        description : "With Schedule",
                        table_column : "additional_data[training_module_group_schedule]",
                        type : "additional_data",
                        value : true
                },{
                        description : "With Schedule 2",
                        table_column : "with_training_module_group_schedule",
                        type : "additional_data",
                        value : true
                }]
            };
            var resultConfiguration = {
                result_link : api_url("c_training_module_group/retrieveTrainingModuleGroup"),
                success : listGroup,
                limit : 5
            };
            groupManagementTab.moduleTableList = new TableComponent(moduleBody.find('.moduleTableContainer'), resultConfiguration, columnConfiguration, filterConfiguration);
            groupManagementTab.moduleTableList.table.on("click", ".viewModuleGroupInformation", function(){
                var currentEntry  = $(this);
                groupManagementTab.moduleTableList.table.find(".viewModuleGroupInformation").attr("disabled", true);
                var trainingModuleRequest = listTrainingModule();
                trainingModuleRequest.success(function(){
                    var instructorRequest = listInstructor();
                    instructorRequest.success(function(){
                        viewModuleGroupInformation(currentEntry.parent().parent().attr("training_module_group_id"));
                    });
                });
                
            });
        });
        
        
        /*Group Information Modal*/
        moduleBody.find("#moduleGroupInformation form").ajaxForm({
            beforeSubmit : function(data, $form, options){
                clear_form_error(moduleBody.find("#moduleGroupInformation form"));
                data.push({
                    name : "modulename",
                    required : false,
                    type: "text",
                    value : moduleBody.find("#moduleGroupInformation form input[field_name=first_name]").val()+moduleBody.find("#moduleGroupInformation form input[field_name=middle_name]").val()+moduleBody.find("#moduleGroupInformation form input[field_name=last_name]").val()
                });
                if(!isNaN((new Date(moduleBody.find("#moduleGroupInformation form input[field_name=start_datetime_dummy]").val())).getTime())){
                    data.push({
                        name : (moduleBody.find("#moduleGroupInformation form input[name=ID]").val()*1) ? "updated_data[start_datetime]" : "start_datetime",
                        required : false,
                        type : "text",
                        value : (new Date(moduleBody.find("#moduleGroupInformation form input[field_name=start_datetime_dummy]").val())).getTime()/1000
                    });
                }
                if(!isNaN((new Date(moduleBody.find("#moduleGroupInformation form input[field_name=end_datetime_dummy]").val())).getTime())){
                    data.push({
                        name : (moduleBody.find("#moduleGroupInformation form input[name=ID]").val()*1) ? "updated_data[end_datetime]" : "end_datetime",
                        required : false,
                        type : "text",
                        value : (new Date(moduleBody.find("#moduleGroupInformation form input[field_name=end_datetime_dummy]").val())).getTime()/1000
                    });
                }
                var newScheduleCtr = 0;
                moduleBody.find("#moduleGroupInformation .groupScheduleTable tbody tr").each(function(){
                    var day = 0;
                    $(this).find("label.active").each(function(){
                        day += ($(this).find("input").val()*1);
                    });
                    var keyName = ($(this).attr("training_module_group_schedule_id")*1) ? "updated" : "new";
                    data.push({
                        name : (keyName+"_schedule["+newScheduleCtr+"][ID]"),
                        required : false,
                        type : "text",
                        value : $(this).attr("training_module_group_schedule_id")
                    });
                    data.push({
                        name : (keyName+"_schedule["+newScheduleCtr+"][day]"),
                        required : false,
                        type : "text",
                        value : day
                    });
                    data.push({
                        name : keyName+"_schedule["+newScheduleCtr+"][start_time]",
                        required : false,
                        type : "text",
                        value : $(this).find(".scheduleStartTime").val().replace(":","")
                    });
                    data.push({
                        name : keyName+"_schedule["+newScheduleCtr+"][end_time]",
                        required : false,
                        type : "text",
                        value : $(this).find(".scheduleEndTime").val().replace(":","")
                    });
                    data.push({
                        name : (keyName+"_schedule["+newScheduleCtr+"][training_module_group_ID]"),
                        required : false,
                        type : "text",
                        value : moduleBody.find("#moduleGroupInformation input[name=ID]").val()
                    });
                    newScheduleCtr++;
                });
                for(var x = 0; x < groupManagementTab.removedSchedule.length; x++){
                    data.push({
                        name : "deleted_schedule["+x+"]",
                        required : false,
                        type : "text",
                        value : groupManagementTab.removedSchedule[x]
                    });
                }
                
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){
                    moduleBody.find("#moduleGroupInformation form .modal-footer .label-success").show();
                    
                    viewModuleGroupInformation(moduleBody.find("#moduleGroupInformation form input[name=ID]").val()*1 ? moduleBody.find("#moduleGroupInformation form input[name=ID]").val() : response["data"]);
                    setTimeout(function(){
                        moduleBody.find("#moduleGroupInformation form .modal-footer .label-success").hide();
                    }, 1000);
                }else{
                    //formError
                    show_form_error(moduleBody.find("#moduleGroupInformation form"), response["error"]);
                }
                groupManagementTab.moduleTableList.retrieveEntry();
            }
        });
        moduleBody.find("#moduleGroupInformation .groupScheduleTable").on("change", ".moduleGroupScheduleRow label input", function(){
            $(':focus').blur();
        });
        moduleBody.find("#createGroup").click(function(){
            moduleBody.find("#moduleGroupInformation form").attr("action", api_url("C_training_module_group/createTrainingModuleGroup"));
            changeFieldName("create", moduleBody.find("#moduleGroupInformation form"));
            moduleBody.find("#moduleGroupInformation form").trigger("reset");
            moduleBody.find("#moduleGroupInformation").modal("show");
            moduleBody.find("#moduleGroupInformation form input[name=ID]").val(0);
            moduleBody.find("#moduleGroupInformation form .deleteGroup").hide();
            moduleBody.find("#moduleGroupInformation .groupScheduleTable tbody").empty();
            moduleBody.find("#moduleGroupInformation .anotherGroupSchedule").trigger("click");
            listTrainingModule();
            listInstructor();
        });
        moduleBody.find("#moduleGroupInformation").on('shown.bs.modal', function() {
            
            clear_form_error(moduleBody.find("#moduleGroupInformation form"));
            moduleBody.find("#moduleGroupInformation form .deleteConfirmation").hide();
            moduleBody.find("#moduleGroupInformation form .confirmDeletGroup").hide();
            moduleBody.find("#moduleGroupInformation form .cancelDeleteGroup").hide();
        });
        moduleBody.find("#moduleGroupInformation form .deleteGroup").click(function(){
            moduleBody.find("#moduleGroupInformation form .deleteGroup").hide();
            moduleBody.find("#moduleGroupInformation form .deleteConfirmation").show();
            moduleBody.find("#moduleGroupInformation form .confirmDeletGroup").show();
            moduleBody.find("#moduleGroupInformation form .cancelDeleteGroup").show();
            
        });
        moduleBody.find("#moduleGroupInformation form .cancelDeleteGroup").click(function(){
            moduleBody.find("#moduleGroupInformation form .deleteGroup").show();
            moduleBody.find("#moduleGroupInformation form .deleteConfirmation").hide();
            moduleBody.find("#moduleGroupInformation form .confirmDeletGroup").hide();
            moduleBody.find("#moduleGroupInformation form .cancelDeleteGroup").hide();
        });
        moduleBody.find("#moduleGroupInformation form .confirmDeletGroup").click(function(){
            moduleBody.find("#moduleGroupInformation form .deleteGroup").hide();
            moduleBody.find("#moduleGroupInformation form .deleteConfirmation").button("loading");
            moduleBody.find("#moduleGroupInformation form .confirmDeletGroup").hide();
            moduleBody.find("#moduleGroupInformation form .cancelDeleteGroup").hide();
            moduleBody.find("#moduleGroupInformation form").attr("action", api_url("c_training_module_group/deleteTrainingModuleGroup"));
            api_request("c_training_module_group/deleteTrainingModuleGroup", {ID :moduleBody.find("#moduleGroupInformation form input[name=ID]").val()}, function(response){
                moduleBody.find("#moduleGroupInformation form .deleteConfirmation").button("reset");
                if(!response["error"].length){
                    groupManagementTab.moduleTableList.table.find("tr[account_id="+moduleBody.find("#moduleGroupInformation form input[name=ID]").val()+"]").remove();
                    moduleBody.find("#moduleGroupInformation").modal("hide");
                }else{
                    moduleBody.find("#moduleGroupInformation form .cancelDeleteGroup").trigger("click");
                    show_form_error(moduleBody.find("#moduleGroupInformation form"), response["error"]);
                }
                groupManagementTab.moduleTableList.retrieveEntry();
            });
            
        });
        moduleBody.find("#moduleGroupInformation .anotherGroupSchedule").click(function(){
            var schedule = moduleBody.find(".prototype .moduleGroupScheduleRow").clone();
            moduleBody.find("#moduleGroupInformation .groupScheduleTable tbody").append(schedule);
        });
        groupManagementTab.removedSchedule = [];
        moduleBody.find("#moduleGroupInformation .groupScheduleTable").on("click", ".removeSchedule", function(){
            var currentRow = $(this).parent().parent();
            if(currentRow.attr("training_module_group_schedule_id")*1){
                groupManagementTab.removedSchedule.push(currentRow.attr("training_module_group_schedule_id")*1);
            }
            currentRow.remove();
        });
        function listTrainingModule(){
            moduleBody.find("#moduleGroupInformation select[field_name=training_module_ID]").empty();
            var request = api_request("C_training_module/retrieveTrainingModule", {}, function(response){
                if(!response["error"].length){
                    moduleBody.find("#moduleGroupInformation select[field_name=training_module_ID]").append("<option value='"+0+"'>Select Training Module</option>");
                    for(var x =0; x <response["data"].length;x++){
                        moduleBody.find("#moduleGroupInformation select[field_name=training_module_ID]").append("<option value='"+response["data"][x]["ID"]+"'>"+response["data"][x]["description"]+"</option>");
                    }
                }
            });
            return request;
        }
        function listInstructor(){
            moduleBody.find("#moduleGroupInformation select[field_name=instructor_account_ID]").empty();
            var request =  api_request("C_account/retrieveAccount", {condition :{ account_type_ID : 5}}, function(response){
                if(!response["error"].length){
                    moduleBody.find("#moduleGroupInformation select[field_name=instructor_account_ID]").append("<option value='"+0+"'>Select Instructor</option>");
                    for(var x =0; x <response["data"].length;x++){
                        moduleBody.find("#moduleGroupInformation select[field_name=instructor_account_ID]").append("<option value='"+response["data"][x]["ID"]+"'>"+response["data"][x]["last_name"]+", "+response["data"][x]["first_name"]+" "+response["data"][x]["middle_name"]+"</option>");
                    }
                }
            });
            return request;
        }
        /*FUNCTIONS*/
        var dayCodeSymbol = {
            1 : "Mon",
            2 : "Tue",
            4 : "Wed",
            8 : "Thu",
            16 : "Fri",
            32 : "Sat",
            64 : "Sun"
        };
        function listGroup(data){
            for(var x = 0; x < data.length; x++){
                var newRow = moduleBody.find(".prototype").find(".moduleGroup").clone();
                newRow.attr("training_module_group_id", data[x]["ID"]);
                newRow.find(".trainingModuleGroupID").text(data[x]["ID"]);
                newRow.find(".trainingModuleGroupDescription").text(data[x]["training_module_description"]);
                newRow.find(".trainingModuleGroupInstructorName").text(data[x]["instructor_account_information_first_name"]+" "+data[x]["instructor_account_information_middle_name"]+" "+data[x]["instructor_account_information_last_name"]);
                var scheduleList = data[x]["training_module_group_schedule"];
                if(scheduleList){
                    for(var sx = 0; sx < scheduleList.length;sx++){
                        var days = "";
                        var dayCode = reverseString(decToBin(scheduleList[sx]["day"]));
                        for(var y = 0; y < dayCode.length; y++){
                            if(dayCode[y]*1){
                                days += dayCodeSymbol[Math.pow(2,y)]+" ";
                            }
                        }
                        newRow.find(".trainingModuleGroupSchedule").append(convertAMPM(scheduleList[sx]["start_time"])+" - "+convertAMPM(scheduleList[sx]["end_time"])+" "+days+"<br>");
                    }
                }else{
                    newRow.find(".trainingModuleGroupSchedule").text("No Schedule");
                }
                groupManagementTab.moduleTableList.table.append(newRow);
            }
        }
        
        function viewModuleGroupInformation(trainingModuleGroupID){
            groupManagementTab.removedSchedule = [];
            moduleBody.find("#moduleGroupInformation form").attr("action", api_url("c_training_module_group/updateTrainingModuleGroup"));
            moduleBody.find("#moduleGroupInformation form").trigger("reset");
            moduleBody.find("#moduleGroupInformation .groupScheduleTable tbody").empty();
            api_request("c_training_module_group/retrieveTrainingModuleGroup", {ID : trainingModuleGroupID, with_training_module_group_schedule : true}, function(response){
                groupManagementTab.moduleTableList.table.find(".viewModuleGroupInformation").attr("disabled", false);
                if(!response["error"].length){
                    changeFieldName("update", moduleBody.find("#moduleGroupInformation form"));
                    moduleBody.find("#moduleGroupInformation form input[name=ID]").val(response["data"]["ID"]);
                    moduleBody.find("#moduleGroupInformation form select[field_name=training_module_ID]").val(response["data"]["training_module_ID"]);
                    moduleBody.find("#moduleGroupInformation form select[field_name=instructor_account_ID]").val(response["data"]["instructor_account_ID"]);
                    var startDatetime = new Date(response["data"]["start_datetime"]*1000);
                    moduleBody.find("#moduleGroupInformation form input[field_name=start_datetime_dummy]").val(startDatetime.getFullYear()+"-"+pad(startDatetime.getMonth()+1, 2)+"-"+pad(startDatetime.getDate(),2));
                    var endDatetime = new Date(response["data"]["end_datetime"]*1000);
                    moduleBody.find("#moduleGroupInformation form input[field_name=end_datetime_dummy]").val(endDatetime.getFullYear()+"-"+pad(endDatetime.getMonth()+1, 2)+"-"+pad(endDatetime.getDate(),2));
                    //schedule
                    var scheduleList = response["data"]["training_module_group_schedule"];
                    if(scheduleList){
                        for(var x = 0; x < scheduleList.length;x++){
                            var schedule = moduleBody.find(".prototype .moduleGroupScheduleRow").clone();
                            schedule.attr("training_module_group_schedule_id", scheduleList[x]["ID"])
                            schedule.find(".scheduleStartTime").val(pad(scheduleList[x]["start_time"],4).spliceInsert(2,0,":"));
                            schedule.find(".scheduleEndTime").val(pad(scheduleList[x]["end_time"],4).spliceInsert(2,0,":"));
                            var dayCode = reverseString(decToBin(scheduleList[x]["day"]));
                            for(var y = 0; y < dayCode.length; y++){
                                if(dayCode[y]*1){
                                    schedule.find("input[value="+Math.pow(2,y)+"]").prop("checked", true);
                                    schedule.find("input[value="+Math.pow(2,y)+"]").parent().addClass("active");
                                }
                            }
                            moduleBody.find("#moduleGroupInformation .groupScheduleTable tbody").append(schedule);
                        }
                    }
            
                    moduleBody.find("#moduleGroupInformation").modal("show");
                    moduleBody.find("#moduleGroupInformation form .deleteGroup").show();
                    groupManagementTab.moduleTableList.retrieveEntry();
                }
            });
        }
    };
    

</script>