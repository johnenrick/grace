<div class="tableComponent">
   <div class="no-margin-bot row">
        <form class="filterResultForm form-inline" method="POST" role="form">
            
            <input name="limit" type="hidden">
            <div class="filterResultFormInput col-xs-12 col-sm-9 col-md-9 col-lg-9  sameHeight">
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 " style="text-align: center">
                <button class="filterResult btn btn-default" style="margin-left:auto; margin-right:auto"><i class="fa fa-filter" aria-hidden="true"></i> Filter</button>
            </div>

        </form>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table  tableEntry">
                <thead>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-sm-12 form-inline align-center">
                                    <div class="form-group pull-left hidden-xs hidden-sm">
                                        <label class="resultCount">0</label>
                                        <label class="">Result</label>
                                    </div>
                                    <div class="form-group">
                                        <button class="previousPage btn btn-default" style="margin-left:auto; margin-right:auto"><i class="fa fa-chevron-left" aria-hidden="true"></i> Prev</button>
                                        <button class="nextPage btn btn-default" style="margin-left:auto; margin-right:auto">Next <i class="fa fa-chevron-right" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="form-group pull-right">
                                        <label >Page </label>
                                        <input class="form-control input-sm align-right  " name="offset" size="5" maxlength="5" value="0">
                                      <label >of</label>
                                      <label class="totalPage  "></label>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div class="prototype">
        <table>
            <tr>
                <th class="tableHead " table_column="" sort="none">
                    <span class="columnDescription"></span>
                    <i class="fa fa-sort" aria-hidden="true" ></i>
                    <i class="fa fa-sort-asc" aria-hidden="true" style="display:none"></i>
                    <i class="fa fa-sort-desc" aria-hidden="true" style="display:none"></i>
                </th>
            </tr>
        </table>
        <div class="formFilterInput form-group">
            <label class=""></label>
            <input class="form-control">&nbsp;&nbsp;
        </div>
    </div>
</div>