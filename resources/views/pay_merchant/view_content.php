<div ng-controller="pay_merchantCtrl">
    <div class="row">
        <div class="col s6 offset-s3">
            <div class="card ">
                <div class="card-content ">
                    <h4 class="blue-text center"><i class="fa fa-money"></i> PAY MERCHANT
                        <span><a href="" ng-show="merchantSearchIcon" ng-click="merchantSearch = !merchantSearch"><i
                                    class="fa fa-search right"></i></a></span>
                    </h4>
                    <input ng-show="merchantSearch" placeholder="SEARCH MERCHANT" type="text"
                           ng-model="searchResults">
                </div>
            </div>
        </div>
    </div>

    <div class="cards" ng-show="cards">
        <div class="row">
            <div class="col s6">
                <div class="card clickable" ng-dblclick="showReceivePayment()">
                    <div class="card-content">
                        <h4 class="blue-text center"> RECEIVE PAYMENT<br>
                            <button class="massive circular ui icon button blue white-text "
                                    style="width: 100px; height: 100px; margin: 10px;">
                                <i class="fa fa-handshake-o fa-2x"></i>
                            </button>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col s6 ">
                <div class="card clickable" ng-dblclick="showMakePayment()">
                    <div class="card-content">
                        <h4 class="blue-text center"> MAKE PAYMENT <br>
                            <button class="massive circular ui icon button blue white-text "
                                    style="width: 100px; height: 100px; margin: 10px;">
                                <i class="fa fa-money fa-2x"></i>
                            </button>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="receivePayment" ng-show="receivePayment">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="card">
                    <div class="card-content ">
                        <h4 class="blue-text center"> RECEIVE PAYMENT <br>
                            <button class="massive circular ui icon button blue white-text "
                                    style="width: 100px; height: 100px; margin: 10px;">
                                <i class="fa fa-handshake-o fa-2x"></i>
                            </button>
                        </h4>
                    </div>
                    <div class="card-content with-padding grey lighten-3">
                        <form name="receivePaymentForm" id="receivePaymentForm">
                            <div class="input-field">
                                <i class="fa fa-mobile prefix"></i>
                                <input type="text" name="mobile" id="mobile" autocomplete="off" ng-model="mobile">
                                <label for="mobile">MOBILE NUMBER</label>
                            </div>
                            <div class="input-field">
                                <i class="fa fa-money prefix"></i>
                                <input type="text" name="amount" id="amount" ng-model="amount">
                                <label for="amount">AMOUNT</label>
                            </div>
                            <div class="input-field">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="pin" id="pin" ng-model="pin">
                                <label for="pin">PIN</label>
                                <button class="fluid ui button blue waves-effect" ng-click="receivePreauth()">PAY
                                </button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="makePayment" ng-show="makePayment">
        <div class="row" ng-show="merchantList">

            <div id="products" class="col s4" ng-repeat="merchant in merchants | filter:searchResults"
                 ng-dblclick="open(merchant)">
                <div class="card clickable collapsible">
                    <div class="card-content">
                        {{merchant.name}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row" ng-show="merchantPayment">
            <div class="col s6 offset-s3">
                <div class="card">
                    <div class="card-content ">
                        <h4 class="blue-text center">PAY {{merchant.name | uppercase }} <br>
                            <button class="massive circular ui icon button blue white-text "
                                    style="width: 100px; height: 100px; margin: 10px;">
                                <i class="fa fa-money fa-2x"></i>
                            </button>
                        </h4>
                    </div>


                    <div class="card-content with-padding grey lighten-3">
                        <form name="makePaymentForm" id="makePaymentForm">
                            <div class="input-field">
                                <i class="fa fa-money prefix"></i>
                                <input type="text" name="_amount" id="_amount" ng-model="amount">
                                <label for="_amount">AMOUNT</label>
                            </div>
                            <div class="input-field">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" name="_pin" id="_pin" ng-model="pin">
                                <label for="_pin">PIN</label>
                                <button class="fluid ui button blue waves-effect" ng-click="makePaymentPreauth()">PAY
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
