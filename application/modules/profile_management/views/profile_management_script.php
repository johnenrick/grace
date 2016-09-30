<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
    load_asset("jquery-confirm.min.css");
    load_asset("jquery-confirm.min.js");
    
    /*Module Object*/
    var ProfileManagement = function(){
        var profileManagement = this;//instance of the module
        var moduleBody = profileManagement.body = $("#profileManagement");
        profileManagement.profileInformationForm = commonFormHandler(moduleBody.find("#profileInformationForm"), null, "c_account/updateAccount", null);
        /*Events*/
        profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime_dummy]").change(function(){
            profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime]").val((new Date($(this).val())).getTime()/1000);
            var birthDatetime = new Date($(this).val());
            var currentDate = new Date();
            var age = currentDate.getFullYear() - birthDatetime.getFullYear()-1;
            if(currentDate.getMonth() >= birthDatetime.getMonth() && currentDate.getDate() >= birthDatetime.getDate()){
                age++;
            }
            profileManagement.profileInformationForm.formElement.find(" input[name=age]").val(age);
        });
        profileManagement.profileInformationForm.formElement.find(" input[name=age]").change(function(){
            var birthdate = new Date(profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime_dummy]").val());
            var currentDate = new Date();
            var birthYear = currentDate.getFullYear()-$(this).val()-1;
            if(currentDate.getMonth() >= birthdate.getMonth() && currentDate.getDate() >= birthdate.getDate()){
                birthYear++;
            }
            profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime_dummy]").val((birthYear)+"-"+pad(birthdate.getMonth()+1, 2)+"-"+pad(birthdate.getDate(),2));
            profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime_dummy]").trigger("change");
        });
        profileManagement.profileInformationForm.submitBeforeSubmit = function(data){
            /*Educational Background*/
                var newDegreeCtr = 0;
                profileManagement.profileInformationForm.formElement.find(".educationalBackgroundTable tbody tr").each(function(){
                    var keyName = ($(this).attr("educational_background_id")*1) ? "updated" : "new";
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][ID]"),
                        required : false,
                        type : "text",
                        value : $(this).attr("educational_background_id")
                    });
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][degree]"),
                        required : false,
                        type : "text",
                        value : $(this).find("input[name=degree]").val()
                    });
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][school]"),
                        required : false,
                        type : "text",
                        value : $(this).find("input[name=school]").val()
                    });
                    data.push({
                        name : (keyName+"_educational_background["+newDegreeCtr+"][academic_year]"),
                        required : false,
                        type : "text",
                        value : ((new Date($(this).find("input[name=academic_year]").val())).getTime()/1000)
                    });
                    newDegreeCtr++;
                });
                for(var x = 0; x < profileManagement.removedDegree.length; x++){
                    data.push({
                        name : "deleted_educational_background["+x+"]",
                        required : false,
                        type : "text",
                        value : profileManagement.removedDegree[x]
                    });
                }
                /*Personal Interest*/
                var newDegreeCtr = 0;
                profileManagement.profileInformationForm.formElement.find(".personalInterestTable tbody tr").each(function(){
                    var keyName = ($(this).attr("personal_interest_id")*1) ? "updated" : "new";
                    data.push({
                        name : (keyName+"_personal_interest["+newDegreeCtr+"][ID]"),
                        required : false,
                        type : "text",
                        value : $(this).attr("personal_interest_id")
                    });
                    data.push({
                        name : (keyName+"_personal_interest["+newDegreeCtr+"][description]"),
                        required : false,
                        type : "text",
                        value : $(this).find("input[name=description]").val()
                    });
                    newDegreeCtr++;
                });
                for(var x = 0; x < profileManagement.removedPersonalInterest.length; x++){
                    data.push({
                        name : "deleted_personal_interest["+x+"]",
                        required : false,
                        type : "text",
                        value : profileManagement.removedPersonalInterest[x]
                    });
                }
        }
        profileManagement.profileInformationForm.formElement.find(".addDegree").click(function(){
            var degree = moduleBody.find(".prototype .educationalBackgroundRow").clone();
            profileManagement.profileInformationForm.formElement.find(".educationalBackgroundTable tbody").append(degree);
        });
        profileManagement.removedDegree = [];
        profileManagement.profileInformationForm.formElement.find(".educationalBackgroundTable").on("click", ".removeDegree", function(){
            var currentRow = $(this).parent().parent();
            if(currentRow.attr("educational_background_id")*1){
                profileManagement.removedDegree.push(currentRow.attr("educational_background_id")*1);
            }
            console.log(profileManagement.removedDegree)
            currentRow.remove();
        }); 
        profileManagement.removedPersonalInterest = [];
        profileManagement.profileInformationForm.formElement.find(".addPersonalInterest").click(function(){
            var degree = moduleBody.find(".prototype .personalInterestRow").clone();
            profileManagement.profileInformationForm.formElement.find(".personalInterestTable tbody").append(degree);
        });
        profileManagement.removedPersonalInterest = [];
        profileManagement.profileInformationForm.formElement.find(".personalInterestTable").on("click", ".removePersonalInterest", function(){
            var currentRow = $(this).parent().parent();
            if(currentRow.attr("personal_interest_id")*1){
                profileManagement.removedPersonalInterest.push(currentRow.attr("personal_interest_id")*1);
            }
            console.log(profileManagement.removedPersonalInterest)
            currentRow.remove();
        }); 
        /*Function*/
        function viewUserInformation(){
            profileManagement.profileInformationForm.updateForm();
            api_request("c_account/retrieveAccount", {ID : user_id(), with_educational_background: true, with_personal_interest : true}, function(response){
                if(!response["error"].length){
                    profileManagement.profileInformationForm.formElement.find("input[name=ID]").val(response["data"]["ID"]);
                    profileManagement.profileInformationForm.formElement.find("span[field_name=account_type_description]").text(response["data"]["account_type_description"]);
                    profileManagement.profileInformationForm.formElement.find(" select[field_name=account_type_ID]").val(response["data"]["account_type_ID"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=first_name]").val(response["data"]["first_name"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=middle_name]").val(response["data"]["middle_name"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=last_name]").val(response["data"]["last_name"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=email_address]").val(response["data"]["email_address"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=address]").val(response["data"]["address"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=nationality]").val(response["data"]["nationality"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=profession]").val(response["data"]["profession"]);
                    var birthdate = new Date(response["data"]["birth_datetime"]*1000);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime_dummy]").val(birthdate.getFullYear()+"-"+pad(birthdate.getMonth()+1, 2)+"-"+pad(birthdate.getDate(),2));
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime]").val(response["data"]["birth_datetime"]);
                    profileManagement.profileInformationForm.formElement.find(" input[field_name=birth_datetime_dummy]").trigger("change")
                    var educationalBackgroundList = response["data"]["educational_background"];
                    if(educationalBackgroundList){
                        for(var x = 0; x < educationalBackgroundList.length;x++){
                            var educationalBackground = moduleBody.find(".prototype .educationalBackgroundRow").clone();
                            educationalBackground.attr("educational_background_id", educationalBackgroundList[x]["ID"]);
                            educationalBackground.find("input[name=degree]").val(educationalBackgroundList[x]["degree"]);
                            educationalBackground.find("input[name=school]").val(educationalBackgroundList[x]["school"]);
                            var academicYear = new Date(educationalBackgroundList[x]["academic_year"]*1000);
                            educationalBackground.find("input[name=academic_year]").val(academicYear.getFullYear()+"-"+pad(academicYear.getMonth()+1, 2)+"-"+pad(academicYear.getDate(),2));
                            profileManagement.profileInformationForm.formElement.find(".educationalBackgroundTable tbody").append(educationalBackground);
                        }
                    }
                    var personalInterestList = response["data"]["personal_interest"];
                    if(personalInterestList){
                        for(var x = 0; x < personalInterestList.length;x++){
                            var personalInterest = moduleBody.find(".prototype .personalInterestRow").clone();
                            personalInterest.attr("personal_interest_id", personalInterestList[x]["ID"]);
                            personalInterest.find("input[name=description]").val(personalInterestList[x]["description"]);
                            profileManagement.profileInformationForm.formElement.find(".personalInterestTable tbody").append(personalInterest);
                        }
                    }
                }
            });
        }
        profileManagement.ready = function(){
            viewUserInformation();
        };
    };
        
    $(document).ready(function(){
        systemApplication.module.profileManagement = new ProfileManagement();
    });
</script>