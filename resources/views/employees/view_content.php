<div style="margin-left: 10px" ng-controller="employeesController">
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card ">
                <div class="card-content ">
                    <h4 class="blue-text center"><i class="fa fa-group"></i>EMPLOYEES</h4>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-content blue white-text with-padding" style="font-size: large">
                <i class="fa fa-group"></i> {{ai.agent.name | uppercase}} EMPLOYEES
                <a href="" ng-show=false ng-click="dateSearch = !dateSearch" class="right white-text"><i
                            class="fa fa-calendar"></i>

                    <a href="" ng-show=false ng-click="employeeSearch = !employeeSearch" class="right white-text"
                       style="margin-right: 7px"><i class="fa fa-group"></i>
                    </a>
            </div>
        </div>
        <div class="card" ng-show="employeeList">
            <div class="card-content with-padding">
                <table class="bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th data-field="name">NAME</th>
                        <th data-field="cellphone">CELLPHONE</th>
                        <th data-field="status">STATUS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr dir-paginate="employee in employees_results = (employees) | itemsPerPage:20 "
                        pagination-id="business_employee_table" ng-class="{
                    'red-text':employee.status === 'DEACTIVATED',
                    'strike':employee.status === 'DEACTIVATED'
                    }" ng-dblclick="openEmployee(employee)">

                        <td>{{$index + 1}} {{$index.length}}</td>
                        <td>{{employee.firstname | uppercase }}</td>
                        <td>{{employee.cellphone}}</td>
                        <td>{{employee.status | uppercase}}</td>


                    </tr>
                </table>
                <center>
                    <dir-pagination-controls
                            pagination-id="business_employee_table"
                            max-size="5"
                            direction-links="true"
                            boundary-links="true" class="red">
                    </dir-pagination-controls>
                </center>
            </div>
        </div>
    </div>
    <div id="employeeInfo" class="modal">
        <div class="modal-content">
            <img src="/img/gc/ico.png" alt="" style="width: 50px; height:auto;"><br>
            <h7><strong>EMPLOYEE REF: {{employeeInfo.id}}</strong></h7>
            <p>
                DATE: <span class="blue-text">{{employeeInfo.date | date:'dd/MM/yyyy @ h:mma' }}</span><br/>
                DESCRIPTION: <span class="blue-text"><strong>{{employeeInfo.description | uppercase}} <span
                                ng-if="employeeInfo.productId">({{employeeInfo.productId.name | uppercase}})</span></strong></span><br/>
                COMMISSION: <span class="blue-text"><strong>{{employeeInfo.commission | currency}}</strong></span>
            <div ng-if="employeeInfo.agentId">
                AGENT : <span class="blue-text"><strong>{{employeeInfo.agentId.name}}</strong></span><br>
                Email: <span class="blue-text">{{employeeInfo.agentId.email}}</span><br/>
            </div>


            </p>

            <button class=" modal-action modal-close waves-effect btn-flat red white-text"
                    ng-click="viewTransactionFile()">VIEW FULL EMPLOYEE FILE
            </button>
        </div>
        <div class="modal-footer">

        </div>
    </div>

    <div class="employeeFile" ng-show="employeeFile">
        <br/>
        <div id="back" class="chip red white-text with-padding z-depth-1 clickable"
             ng-click="backToEmployeeList()">
            <i class="fa fa-arrow-left"></i> Back To Employee List
        </div>
        <br/>

        <div class="card">
            <div class="card-content with-padding">
                <strong><h5 class="blue-text"><i class="fa fa-file-text-o"></i> EMPLOYEE TRANSACTIONS :
                        {{employeeInfo.firstname}} | {{displayedDate}}
                        <span class="right"><a href="" ng-click="dateSearch = !dateSearch" class="blue-text"><i
                                        class="fa fa-calendar"></i></a></span>
                    </h5>
                </strong>
            </div>

            <hr>
            <div class="card-content with-padding">
                <div class="row">
                    <div ng-show="dateSearch">
                        <form name="dateSearchForm" id="dateSearchForm" ng-submit="searchByDate()">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="date" id="start_date" ng-model="start_date"
                                           class="datepicker" ng-required="true"/>
                                    <label for="start_date" class="active">START DATE</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="date" id="end_date" ng-model="end_date"
                                           class="datepicker" ng-required="true"/>
                                    <div class="col s4 offset-s10">
                                        <button class="waves-effect waves-light btn indigo"
                                                ng-disabled="dateSearchForm.$invalid"><i
                                                    class="fa fa-search"></i> <i class="fa fa-refresh fa-spin"
                                                                                 ng-show="loader"></i></button>
                                    </div>
                                    <label for="end_date">END DATE</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="bordered">
                    <thead>
                    <tr>
                        <th data-field="cellphone">DATE</th>
                        <th data-field="cellphone">REF.</th>
                        <th data-field="passcode">DESCRIPTION</th>
                        <th data-field="status">AMOUNT</th>
                        <th data-field="status">CREDIT</th>
                        <th data-field="status">DEBIT</th>
                        <th data-field="status">COMMISSION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr dir-paginate="transaction in results =  (transactions  | filter:searchResult | orderBy: '-date')| itemsPerPage:20"
                        ng-dblclick="openTransaction(transaction)">
                        <td style="font-size: small; ">{{transaction.date | date:'dd/MM/yyyy @ h:mma'}}</td>
                        <td>{{transaction.id}}</td>
                        <td>{{transaction.description}} <b>{{transaction.productId.name}}</b></td>
                        <td>{{transaction.amount | currency}}</td>
                        <td>{{transaction.credit | currency}}</td>
                        <td>{{transaction.debit | currency}}</td>
                        <td>{{transaction.commission | currency}}</td>

                    </tr>
                </table>
                <center>
                    <dir-pagination-controls
                            max-size="5"
                            direction-links="true"
                            boundary-links="true" class="red">
                    </dir-pagination-controls>
                </center>
            </div>

        </div>

    </div>

</div>