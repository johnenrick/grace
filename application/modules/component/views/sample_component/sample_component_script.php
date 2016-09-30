<script>
    /*Adding an asset*/
    load_asset("jquery-confirm.min.css");
    load_asset("jquery-confirm.min.js");
    
    /*Component Object*/
    /***
     * A sample Component
     * @param {type} componentContainer an element selector where the instance of the component is placed
     * @returns {undefined}
     */
    var SampleComponent = function (componentContainer) {
        var sampleComponent = this;
        sampleComponent.body = $("#pageComponentContainer .sampleComponent").clone();//The HTML instance of the component. 
        sampleComponent.body.html("Hello World From the Component!");
        componentContainer.append(sampleComponent.body);
    };
</script>