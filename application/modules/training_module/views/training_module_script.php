<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
    load_asset("jquery-confirm.min.css");
    load_asset("jquery-confirm.min.js");
    
    /*Module Object*/
    var TrainingModule = function(){
        var trainingModule = this;//instance of the module
        var moduleBody = trainingModule.body = $("#trainingModule");
        load_sub_module("training_module/moduleManagementTab", function(data){
            moduleBody.find("#trainingModuleModuleTab").append(data);
            trainingModule.moduleManagement = new ModuleManagementTab();
            
        });
        load_sub_module("training_module/groupManagementTab", function(data){
            moduleBody.find("#trainingModuleGroupTab").append(data);
            trainingModule.groupManagement = new GroupManagementTab();
        });
        load_sub_module("training_module/trainingMaterialTab", function(data){
            moduleBody.find("#trainingModuleTrainingMaterialTab").append(data);
            trainingModule.trainingMaterial = new TrainingMaterialTab(trainingModule);
            trainingModule.trainingMaterial.ready();
        });
        
        
        trainingModule.ready = function(){
            
        }
    };
        
    $(document).ready(function(){
        systemApplication.module.trainingModule = new TrainingModule();
    });
</script>