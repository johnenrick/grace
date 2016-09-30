<script>
    var categoryList = {};
    $(document).ready(function(){
        load_component('Table_component',function(){
            var columnConfiguration = [{
                description : "Description",
                table_column : "video_category__description",
                default_sort : 1
            },{
                description : "Parent Category",
                table_column : "parent_video_category__description",
                default_sort : 1
            },{
                description : "Action"
            }];
            var filterConfiguration = [{
                    description : "Description",
                    table_column : "like__video_category__description",
                    type : "text"
            }];
            var resultConfiguration = {
                result_link : api_url("C_video_category/retrieveVideoCategory"),
                success : categoryList.listCategory,
                limit : 5
            };
            categoryList.tableCategory = new TableComponent($('.categoryListTable'), resultConfiguration, columnConfiguration, filterConfiguration);
        });
    });
    categoryList.listCategory = function(data){
        for(var x = 0; x < data.length; x++){
            var newEntry = $(".categoryManagement").find(".prototype .categoryEntry").clone();
            newEntry.find(".description").text(data[x]["description"]);
            newEntry.find(".parentCategory").text((data[x]["parent_ID"]*1) ? data[x]["parent_description"] : "N/A");
            categoryList.tableCategory.addEntry(newEntry);
        }
    };


</script>