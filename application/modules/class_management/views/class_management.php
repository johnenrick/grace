<section id="classManagement" class="page-section clearfix container" >
    <div class=" section-content">
        <div class="row ">
            <div class="col-sm-12 form-group" >
                <label class="col-sm-3 col-md-2 control-label">Training Module</label>
                <div class="col-sm-9 col-md-10">
                    <select id="trainingModuleSelection" class="form-control">
                        <option>Default</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 align-center form-group">
                <button id="viewTrainingModuleMember" type="button" class="btn btn-gold" >
                  <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> View Class List
                </button>
            </div>
        </div>
        <div class="row">
            
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-8">
                <h3 id="trainningModuleTableDescription">Class List</h3>
            </div>
            <div class="col-sm-4 align-right">
                <h3>
                <button id="addTrainingModuleMember" type="button" class="btn btn-success" style="display:none">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Student
                </button>
                    </h3>
            </div>
            <div class="col-sm-12 classTableContainer">

            </div>
        </div>

    </div>
    <div class="modal fade" id="classListManagementModal" training_module_group_id="0" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Class List Management</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 formMessage">

                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-12 studentManagementTableContainer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="prototype">
        <table>
            <tr class="classRow">
                <td class="accountID"></td>
                <td class="accountFullName"></td>
                <td class="accountAction">
                    <button class="viewClassInformation btn btn-xs btn-primary"><i class="fa fa-search" aria-hidden="true"></i> View</button>
                </td>
            </tr>
            <tr class="studentRow">
                <td class="accountID"></td>
                <td class="accountFullName"></td>
                <td class="accountAction">
                    <button class="addStudent btn btn-xs btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Student</button>
                    <button class="removeStudent btn btn-xs btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Remove Student</button>
                </td>
            </tr>
        </table>
    </div>
</section>
<!--        <div id="sideMenu">
            <ul class="menu">
                <li><i class="fa fa-align-justify" aria-hidden="true"></i> MENU</li>
                <li><a class="btn btn-xs btn-pill btn-gold">hide</a></li>
            </ul>
            <ul class="nav">
                <li><a href="#topNav" ><i class="fa fa-class" aria-hidden="true"></i> Class Management</a></li>
                <li><a href="#topNav" ><i class="fa fa-class" aria-hidden="true"></i> Class Management</a></li>
                <li class="active"><a href="#topNav" ><i class="fa fa-class" aria-hidden="true"></i> Class Management</a></li>
            </ul>


        </div>-->