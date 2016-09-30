<script>
    /*global systemApplication, systemUtility*/
    
    /*Adding an asset*/
    load_asset("jquery-confirm.min.css");
    load_asset("jquery-confirm.min.js");
    
    /*Module Object*/
    var SampleModule = function(){
        var sampleModule = this;//instance of the module
        var moduleBody = sampleModule.body = $("#sampleModule");
        load_component("sample_component", function(){
           new SampleComponent(moduleBody.find(".sampleModuleSampleComponent"));
        });
        load_component("sample_component", function(){
           new SampleComponent(moduleBody.find(".sampleModuleSampleComponent"));
        });
        load_component("sample_component", function(){
           new SampleComponent(moduleBody.find(".sampleModuleSampleComponent"));
        });
        /*Events*/
        
        /*Functions*/
        
        
        sampleModule.ready = function(){
            
        }
        
    };
        
    $(document).ready(function(){
        systemApplication.module.sampleModule = new SampleModule();
    });
</script>