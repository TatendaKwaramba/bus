<div style="margin-left: 10px" ng-controller="transactionsController">
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card ">
                <div class="card-content ">
                    <h4 class="blue-text center"><i class="fa fa-line-chart"></i> TRANSACTION HISTORY</h4>
                </div>
            </div>
        </div>
    </div>
    <div ng-show="transactionList">
        <div class="card">
            <div class="card-content indigo white-text with-padding" style="font-size: large">
                <i class="fa fa-line-chart"></i> {{ai.agent.name | uppercase}} TRANSACTIONS | {{displayedDate}}
                <a href="" ng-click="dateSearch = !dateSearch" class="right white-text"><i class="fa fa-calendar"></i>

                    <a href="" ng-show=false ng-click="employeeSearch = !employeeSearch" class="right white-text"
                       style="margin-right: 7px"><i class="fa fa-group"></i>
                    </a>
            </div>
        </div>
        <div class="card">
            <div class="card-content with-padding">
                <div class="col s12 " ng-show="dateSearch">
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


                <table class="bordered">
                    <thead>
                    <tr>
                        <th data-field="cellphone">DATE</th>
                        <th data-field="cellphone">REF.</th>
                        <th data-field="passcode">DESCRIPTION</th>
                        <th data-field="status">AMOUNT</th>

                        <th data-field="status">COMMISSION</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr dir-paginate="transaction in results =  (transactions  | filter:searchResult | orderBy: '-date')| itemsPerPage:20"
                        ng-dblclick="openTransaction(transaction)">
                        <td style="font-size: small; ">{{transaction.date | date:'dd/MM/yyyy @ h:mma'}}</td>
                        <td>{{transaction.id}}</td>
                        <td>{{transaction.description}} <span
                                    ng-if="transaction.productId"> <b class="blue-text">({{transaction.productId.name}})</b>
                            </span>
                        </td>
                        <td>{{transaction.amount | currency}}</td>
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

            <div class="fixed-action-btn horizontal" style=" bottom: 45px; right: 24px;">
                <a class="btn-floating btn-large red" >
                    <i class="fa fa-download"></i>
                </a>
                <ul>
                    <li><a class="btn-floating red" ng-click="test()" ><i class="fa fa-file-pdf-o"></i></a></li>
                    <li><a class="btn-floating green darken-1" ng-csv="makeBusinessListCsv(results)" lazy-load="true"
                           filename="transactionList.csv"><i class="fa fa-file-excel-o"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
    <div id="transactionInfo" class="modal">
        <div class="modal-content">
            <img src="/img/gc/ico.png" alt="" style="width: 50px; height:auto;"><br>
            <h7><strong>TRANSACTION REF: {{transactionInfo.id}}</strong></h7>
            <p>
                DATE: <span class="blue-text">{{transactionInfo.date | date:'dd/MM/yyyy @ h:mma' }}</span><br/>
                DESCRIPTION: <span class="blue-text"><strong>{{transactionInfo.description | uppercase}} <span
                            ng-if="transactionInfo.productId">({{transactionInfo.productId.name | uppercase}})</span></strong></span><br/>
                COMMISSION: <span class="blue-text"><strong>{{transactionInfo.commission | currency}}</strong></span>
            <div ng-if="transactionInfo.agentId">
                AGENT : <span class="blue-text"><strong>{{transactionInfo.agentId.name}}</strong></span><br>
                Email: <span class="blue-text">{{transactionInfo.agentId.email}}</span><br/>
            </div>


            </p>

            <button class=" modal-action modal-close waves-effect btn-flat red white-text"
                    ng-click="viewTransactionFile()">VIEW FULL TRANSACTION FILE
            </button>
        </div>
        <div class="modal-footer">

        </div>
    </div>
    <div class="transactionFile" ng-show="transactionFile">
        <br/>
        <div id="back" class="chip red white-text with-padding z-depth-1 clickable"
             ng-click="backToTransactionListFromDetails()">
            <i class="fa fa-arrow-left"></i> Back To Transaction List
        </div>
        <br/>


        <div class="card">
            <div class="card-content with-padding">
                <strong><h5 class="blue-text"><i class="fa fa-file-text-o"></i> TRANSACTION REFERENCE :
                        {{transactionInfo.id}} | {{transactionInfo.description}}</h5>
                </strong>
                <hr>

            </div>
            <div class="card-content with-padding">
                <div ng-if="transactionInfo.agentId">
                    <div class="row">
                        <h5><u>AGENT INFORMATION</u></h5>
                    </div>
                    <div class="row">
                        NAME : <span class="blue-text">{{transactionInfo.agentId.name}}</span><br>
                        MOBILE : <span class="blue-text">{{transactionInfo.agentId.cellphone}}</span><br>
                        ADDRESS : <span class="blue-text">{{transactionInfo.agentId.address}}</span><br>
                        CLASS OF SERVICE : <span
                            class="blue-text">{{transactionInfo.agentId.partnerClassOfServiceId.name}}</span><br>
                    </div>
                </div>

                <div ng-if="transactionInfo.clientId">
                    <div class="row">
                        <h5><u>CLIENT INFORMATION</u></h5>
                    </div>
                    <div class="row">
                        NAME : <span class="blue-text">{{transactionInfo.clientId.firstname}} {{transactionInfo.clientId.lastname}}</span><br>
                        MOBILE : <span class="blue-text">{{transactionInfo.clientId.mobile}}</span><br>
                        CLASS OF SERVICE : <span
                            class="blue-text">{{transactionInfo.clientId.clientClassOfServiceId.name}}</span><br>
                    </div>


                </div>

                <div ng-if="transactionInfo.deviceId">
                    <div class="row">
                        <h5><u>DEVICE INFORMATION</u></h5>
                    </div>
                    <div class="row">
                        NAME : <span class="blue-text">{{transactionInfo.deviceId.name}}</span><br>
                        IMEI : <span class="blue-text">{{transactionInfo.deviceId.imei}}</span><br>
                        STATUS : <span class="blue-text">{{transactionInfo.deviceId.status}}</span><br>
                    </div>


                </div>

                <div ng-if="transactionInfo.employeeId">
                    <div class="row">
                        <h5><u>EMPLOYEE INFORMATION</u></h5>
                    </div>
                    <div class="row">
                        NAME : <span class="blue-text">{{transactionInfo.employeeId.firstname}}</span><br>
                        CELLPHONE : <span class="blue-text">{{transactionInfo.employeeId.cellphone}}</span><br>
                    </div>


                </div>

                <div>
                    <div class="row">
                        <h5><u>TRANSACTION INFORMATION</u></h5>
                    </div>
                    <div class="row">
                        DESCRIPTION : <span class="blue-text">{{transactionInfo.description}}</span><br>
                        <div ng-if="transactionInfo.productId">
                            PRODUCT : <span class="blue-text">{{transactionInfo.productId.name}}</span><br>
                            BILLER : <span class="blue-text">{{transactionInfo.productId.billerId.company}}</span><br>
                            <span ng-if="transactionInfo.productId.billerId.company == 'ZETDC'">METER NUMBER : <span
                                    class="blue-text">{{transactionInfo.billid}}</span><br></span>
                        </div>
                        AMOUNT : <span class="blue-text">{{transactionInfo.amount | currency}}</span><br>
                        CREDIT : <span class="blue-text">{{transactionInfo.credit | currency}}</span><br>
                        DEBIT : <span class="blue-text">{{transactionInfo.debit | currency}}</span><br>
                        DATE : <span
                            class="blue-text">{{transactionInfo.date | date : 'dd/MM/yyyy @ HH:mm:ss'}}</span><br>
                        FEES : <span class="blue-text">{{transactionInfo.fees | currency}}</span><br>
                        COMMISSION : <span class="blue-text">{{transactionInfo.commission  | currency}}</span><br>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>