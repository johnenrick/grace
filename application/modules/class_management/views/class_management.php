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
                <button id="exportClassList" type="button" class="btn btn-primary" style="display:none">
                    <span class="glyphicon glyphicon-export"></span> Export Class List
                </button>
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
    <div class="modal fade" id="userInformation" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content">
                <form method="POST">
                    <input name="ID" type="hidden">
                    <div class="modal-header">
                        <h4 class="modal-title">User Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 formMessage">
                                
                            </div>
                        </div>
                        <div class="row form-horizontal">
                            <div class="col-sm-6">
                                
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">First Name</label>
                                    <div class="col-sm-8">
                                        <span field_name="first_name" type="text" class="form-control"  placeholder="First Name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Middle Name</label>
                                    <div class="col-sm-8">
                                        <span field_name="middle_name" type="text" class="form-control"  placeholder="Middle Name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Last Name</label>
                                    <div class="col-sm-8">
                                        <span field_name="last_name" type="text" class="form-control"  placeholder="Last Name"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Profession</label>
                                    <div class="col-sm-8">
                                        <span field_name="profession" type="text" class="form-control"  placeholder="Profession"></span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Email Address</label>
                                    <div class="col-sm-8">
                                        <span field_name="email_address" type="email" class="form-control"  placeholder="Email Address"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Address</label>
                                    <div class="col-sm-8">
                                        <span field_name="address" type="text" class="form-control"  placeholder="Address"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Nationality</label>
                                    <div class="col-sm-8">
                                        <span field_name="nationality" type="text" class="form-control"  placeholder="Nationality"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Birthday</label>
                                    <div class="col-sm-8">
                                        <span field_name="birth_datetime_dummy" type="date" class="form-control"  placeholder="Birthday"></span>
                                        <input field_name="birth_datetime" type="hidden" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label  class="col-sm-4 control-label">Age</label>
                                    <div class="col-sm-8">
                                        <span name="age" type="number" class="form-control"  placeholder="Age"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="educationalBackgroundTable table table-responsive  table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="4">Educational Background</th>
                                        </tr>
                                        <tr>
                                            <th>Degree</th>
                                            <th>School</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="personalInterestTable table  table-responsive  table-hover">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Interest</th>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                       
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                    </div>
                </form>
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
            <tr class="educationalBackgroundRow" education_background_id="0">
                <td>
                    <span name="degree" type="text" class="form-control"></span>
                </td>
                <td>
                    <span name="school" type="text" class="form-control"></span>
                </td>
                <td>
                    <span name="academic_year" type="date" class="form-control" ></span>
                </td>
            </tr>
            <tr class="personalInterestRow" personal_interest_id="0">
                <td>
                    <span name="description" type="text" class="form-control"></span>
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