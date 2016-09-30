<script>
    /*Adding an asset*/
    load_asset("jquery.form.min.js");
    load_asset("jquery.matchHeight-min.js");
    /*Component Object*/
    /***
     * A sample Component
     * @param {type} componentContainer an element selector where the instance of the component is placed
     * @returns {undefined}
     */
    var TableComponent = function (componentContainer, resultConfiguration, columnConfiguration, filterConfiguration) {
        var tableComponent = this;
        tableComponent.body = $("#pageComponentContainer .tableComponent").clone();//The HTML instance of the component. 
        tableComponent.body.prototype = tableComponent.body.find(".prototype");
        tableComponent.table = tableComponent.body.find(".tableEntry");
        componentContainer.append(tableComponent.body);
        //COLUMN
        if(typeof columnConfiguration !== "undefined"){
            var columnRow = document.createElement("TR");
            for(var ctr = 0; ctr < columnConfiguration.length; ctr++){
                var tableHead = tableComponent.body.prototype.find(".tableHead").clone();
                tableHead.find(".columnDescription").text(columnConfiguration[ctr]["description"]);
                if(typeof columnConfiguration[ctr]["table_column"] !== "undefined"){
                    tableHead.attr("table_column", columnConfiguration[ctr]["table_column"]);
                }else{
                    tableHead.attr("sort", "off");
                    tableHead.find(".fa-sort").hide();
                }
                //TODO default sort
//                if(typeof columnConfiguration[ctr]["default_sort"] !== "undefined"){
//                    tableHead.attr("sort", columnConfiguration[ctr]["default_sort"]);
//                }
                $(columnRow).append(tableHead);
                
            }
            tableComponent.body.find("table thead").append(columnRow);
            tableComponent.table.find("tfoot tr td").attr("colspan", columnConfiguration.length);
        }
        var sortList = [];
        tableComponent.table.find(".tableHead").click(function(){
            var currentColumn = $(this);
            switch($(this).attr("sort")){
                case "none":
                    currentColumn.attr("sort", "asc");
                    currentColumn.find(".fa-sort").hide();
                    currentColumn.find(".fa-sort-asc").show();
                    if(sortList.indexOf(currentColumn.attr("table_column")) === -1){
                        sortList.push(currentColumn.attr("table_column"));
                    }
                    break;
                case "asc":
                    currentColumn.attr("sort", "desc");
                    currentColumn.find(".fa-sort-asc").hide();
                    currentColumn.find(".fa-sort-desc").show();
                    if(sortList.indexOf(currentColumn.attr("table_column")) === -1){
                        sortList.push(currentColumn.attr("table_column"));
                    }
                    break;
                case "desc":
                    currentColumn.attr("sort", "none");
                    currentColumn.find(".fa-sort-desc").hide();
                    currentColumn.find(".fa-sort").show();
                    sortList.splice(sortList.indexOf(currentColumn.attr("table_column")), 1);
                    break;
            }
            tableComponent.retrieveEntry();
        });
        /*Pagination*/
        tableComponent.table.find("tfoot input[name=offset]").change(function(){
            tableComponent.retrieveEntry();
        });
        tableComponent.table.find("tfoot .previousPage").click(function(){
            var offset = tableComponent.table.find("tfoot input[name=offset]").val()*1;
            if(offset > 1){
                tableComponent.table.find("tfoot input[name=offset]").val(offset - 1);
            }
            tableComponent.table.find("tfoot input[name=offset]").trigger("change");
        });
        tableComponent.table.find("tfoot .nextPage").click(function(){
            var offset = tableComponent.table.find("tfoot input[name=offset]").val()*1;
            tableComponent.table.find("tfoot input[name=offset]").val(offset + 1);
            tableComponent.table.find("tfoot input[name=offset]").trigger("change");
        });
        /*Result*/
        if(typeof resultConfiguration.limit !== "undefined"){
            tableComponent.body.find(".filterResultForm input[name=limit]").val(resultConfiguration.limit);
        }
        tableComponent.body.find(".filterResultForm").attr("action", resultConfiguration.result_link);
        tableComponent.body.find(".filterResultForm").ajaxForm({
            beforeSubmit : function(data, $form, options){
                retrievingResult();
                for(var x = 0; x < sortList.length;x++ ){
                    data.push({
                        name : "sort["+sortList[x]+"]",
                        required : false,
                        type : "text",
                        value : tableComponent.table.find(".tableHead[table_column="+sortList[x]+"]").attr("sort")
                    });
                }
                var offset = tableComponent.table.find("tfoot input[name=offset]").val()*1;
                var offsetMultiplier = resultConfiguration.limit*1;
                if(tableComponent.table.find("tfoot input[name=offset]").val()*1<=2 && tableComponent.table.find(".resultCount").text()*1 < resultConfiguration.limit*1){
                    offsetMultiplier = 0;
                    tableComponent.table.find("tfoot input[name=offset]").val(1);
                }else{
                    
                }
                data.push({
                    name : "offset",
                    required : false,
                    type : "text",
                    value : (offset <= 0) ? 0 : (offset - 1)*(offsetMultiplier)
                });
                if(typeof filterConfiguration !== "undefined" && typeof filterConfiguration.customGenerator !== "undefined"){
                    filterConfiguration.customGenerator(data);
                }
                
            },
            success : function(data){
                var response = JSON.parse(data);
                if(!response["error"].length){                    
                    if(typeof resultConfiguration.success !== "undefined"){
                        /*Footer detail*/
                       
                        tableComponent.table.find(".resultCount").text((typeof response["result_count"] !== "undefined") ? response["result_count"]*1 : response["data"].length);
                        if(tableComponent.table.find(".resultCount").text()*1 && tableComponent.body.find(".filterResultForm input[name=limit]").val()){
                            tableComponent.table.find(".totalPage").text(Math.ceil( tableComponent.table.find(".resultCount").text()*1/tableComponent.body.find(".filterResultForm input[name=limit]").val()));
                        }else{
                            tableComponent.table.find(".totalPage").text(1);
                        }
                        if(tableComponent.table.find("tfoot input[name=offset]").val()*1 === 0){
                            tableComponent.table.find("tfoot input[name=offset]").val(1);
                        }
                        tableComponent.table.find("tbody").empty();
                        resultConfiguration.success(response["data"]);
                                        

                    }else{
                        console.log("No Result Callback");
                    }
                }else{
                    if(response["data"] === false){
                        
                        var offset = tableComponent.table.find("tfoot input[name=offset]").val()*1;
                        if(offset > tableComponent.table.find(".totalPage").text()*1){
                            tableComponent.table.find("tfoot input[name=offset]").val(offset - 1);//go to previous page
                        }else if(offset <= 0 ){
                            tableComponent.table.find("tfoot input[name=offset]").val(0);//go to previous page
                        }else{//error outside pagination
                            
                            tableComponent.table.find("tbody").empty();
                            for(var x = 0; x < response["error"].length; x++){
                                if(response["error"][x]["status"]*1 === 2){
                                    tableComponent.table.find("tbody").append("<tr><td colspan='"+columnConfiguration.length+"'>No Result</td></tr>")
                                }
                            }
//                            tableComponent.retrieveEntry();
                        }
                    }
                    
                }
                retrievingResult(true);
            }
        });
        tableComponent.addEntry = function(newEntry){
            tableComponent.table.find("tbody").append(newEntry);
        };
        tableComponent.retrieveEntry = function(){
            tableComponent.body.find(".filterResultForm").trigger("submit");
        };
        
        
        /*Filter*/
        if(typeof filterConfiguration !== "undefined" && typeof filterConfiguration.fieldFilter !== "undefined"){
            //offset
             
            var offsetClass = "";
            for(var x = filterConfiguration.fieldFilter.length-1; x >=0;x--){
                var newFilter = tableComponent.body.find(".prototype .formFilterInput").clone();
                if(x===0){
                    newFilter.addClass(offsetClass);
                }
                if(filterConfiguration.fieldFilter[x]["type"] === "hidden"){
                    newFilter.hide();
                }
                if(filterConfiguration.fieldFilter[x]["type"] !== "additional_data"){
                    newFilter.find("input").attr("name", "condition["+filterConfiguration.fieldFilter[x]["table_column"]+"]");
                    
                }else{
                    newFilter.hide();
                    newFilter.find("input").attr("name", filterConfiguration.fieldFilter[x]["table_column"]);
                }
                if(typeof filterConfiguration.fieldFilter[x]["value"] !== "undefined"){
                    newFilter.find("input").val(filterConfiguration.fieldFilter[x]["value"]);
                }
                newFilter.find("type").attr("type", filterConfiguration.fieldFilter[x]["type"]);
                newFilter.find("label").attr("for", filterConfiguration.fieldFilter[x]["table_column"]);
                
                newFilter.find("label").text(filterConfiguration.fieldFilter[x]["description"]+": ");
                tableComponent.body.find(".filterResultFormInput").prepend(newFilter);
            }
        }
        $(".sameHeight").matchHeight();
        
        /*Helper*/
        function retrievingResult(finishLoading){
            finishLoading = (typeof finishLoading === "undefined") ? false : finishLoading;
            if(finishLoading){
                tableComponent.body.find(".filterResult").attr("disabled", false);
                tableComponent.table.find("tfoot .previousPage").attr("disabled", false);
                tableComponent.table.find("tfoot .nextPage").attr("disabled", false);
            }else{
                tableComponent.body.find(".filterResult").attr("disabled", true);
                tableComponent.table.find("tfoot .previousPage").attr("disabled", true);
                tableComponent.table.find("tfoot .nextPage").attr("disabled", true);
            }
        }
        tableComponent.retrieveEntry();
    };
</script>