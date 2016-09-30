<script>
    /*Adding an asset*/
    load_asset("jquery-confirm.min.css");
    load_asset("jquery-confirm.min.js");
    load_asset("jquery.matchHeight-min.js");
    /*Component Object*/
    /***
     * A sample Component
     * @param {type} componentContainer an element selector where the instance of the component is placed
     * @returns {undefined}
     */
    var GridList = function (componentContainer) {
        var gridList = this;
        gridList.body = $("#pageComponentContainer .gridList").clone();//The HTML instance of the component.
        componentContainer.append(gridList.body);
        /**
         * 
         * @param {int} userVideoID ID of the user video
         * @param {string} userVideoThumbnailLink the link of the video which is already generated using user_video_url
         * @param {string} videoDescription the title of the video
         * @param {string} uploaderFullName full name of the uploaded
         * @param {timestamp} datetimeCreated the timestamp it was created
         * @param {int} viewCount count of how many views the video has
         * @returns {undefined}
         */
        gridList.addItem = function(userVideoID, userVideoThumbnailLink, videoDescription, uploaderFullName, datetimeCreated, viewCount){
            var videoItem = gridList.body.find(".prototype .videoItem").clone();
            videoItem.attr("user_video_id", userVideoID);
            videoItem.find("img").attr("src", userVideoThumbnailLink);
            videoItem.find(".videoDescription").text(videoDescription);
            videoItem.find(".uploadederName").text(uploaderFullName);
            videoItem.find(".viewCount").text(viewCount+" view"+((viewCount > 1) ? "s":""));
            var currentTimestamp = (new Date()).getTime()/1000;
            var timestampDifference = currentTimestamp - datetimeCreated;
            var videoAge = "long ";
            if(timestampDifference < 60){//seconds
                videoAge = timestampDifference+" second"+(timestampDifference > 1 ? "s" :"");
            }else if(timestampDifference < 3600){//Minute
                videoAge = parseInt(timestampDifference/60)+" minute"+((parseInt(timestampDifference/60) > 1) ? "s" :"");
            }else if(timestampDifference < 86400){//Hour
                videoAge = parseInt(timestampDifference/3600)+" hour"+((parseInt(timestampDifference/3600) > 1) ? "s" :"");
            }else if(timestampDifference < 2678400){//Day
                videoAge = parseInt(timestampDifference/86400)+" day"+((parseInt(timestampDifference/86400) > 1) ? "s" :"");
            }else if(timestampDifference < 32140800){//Month
                videoAge = parseInt(timestampDifference/2678400)+" month"+((parseInt(timestampDifference/2678400) > 1) ? "s" :"");
            }else{//years
                videoAge = parseInt(timestampDifference/32140800)+" year"+((parseInt(timestampDifference/32140800) > 1) ? "s" :"");
            }
            videoItem.find(".videoAge").text(videoAge+" ago");
            gridList.body.find(".videoList").append(videoItem);
            gridList.body.find(".videoList .videoItem").matchHeight();
        };
        
        
    };
</script>