<div ng-controller="pay_billCtrl" ng-cloak>
    <div class="productList" id="productList" ng-show="productList">
        <div class="row">
            <div class="col s6 offset-s3">
                <div class="card ">
                    <div class="card-content ">
                        <h5 class="blue-text "><i class="fa fa-cart-plus"></i> PAY BILLS
                            <span><a href="" ng-click="billerSearch = !billerSearch"><i class="fa fa-search right"></i></a></span>
                        </h5>
                        <input ng-show="billerSearch" placeholder="SEARCH BILLER" type="text"
                               ng-model="searchResults.name">
                    </div>
                </div>
            </div>
        </div>

        <div ng-show="loading">
            <h4 class="center loading"><strong class="black-text "><i
                        class="fa fa-circle-o-notch fa-spin"></i></strong> FETCHING PRODUCTS...</h4>
        </div>

        <div class="row">

            <div id="products" class="col s4" ng-repeat="product in products | filter:searchResults"
                 ng-dblclick="open(product)">
                <div class="card clickable collapsible">
                    <div class="card-content">
                        {{product.name}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="productPay col s6 offset-s3" id="productPay" ng-show="productPay">
        <div class="card">
            <div class="card-content ">
                <h4 class="blue-text center"> Pay {{productInfo.name}}<br>
                    <button class="massive circular ui icon button blue white-text "
                            style="width: 100px; height: 100px; margin: 10px;">
                        <i class="fa fa-credit-card fa-2x"></i>
                    </button>
                </h4>
            </div>
            <div class="card-content with-padding grey lighten-3">
                <div class="center">
                    <input name="group1" type="radio" id="cashRadio" class="with-gap" ng-model="mode" value="cash"/>
                    <label for="cashRadio">CASH</label>
                    <input name="group1" type="radio" id="accountRadio" class="with-gap" ng-model="mode"
                           value="account"/>
                    <label for="accountRadio">ACCOUNT</label>
                    <input name="group1" type="radio" id="personalRadio" class="with-gap" ng-model="mode"
                           value="personal"/>
                    <label for="personalRadio">PERSONAL</label>

                </div>

                <div ng-show="mode === 'cash'">
                    <form id="payBillCash" name="payBillCash" ng-submit="paybillPreauthCash()">
                        <div class="input-field">
                            <i class="fa fa-asterisk prefix"></i>
                            <input type="text" name="reference"
                                   ng-pattern="productInfo.billidFormat.replace(dblSlash,snglSlash)" id="reference"
                                   ng-model="reference" autocomplete="off" required>
                            <label for="reference">{{productInfo.billidLabel | uppercase}}</label>
                            <div ng-messages="payBillCash.reference.$error"
                                 ng-if="payBillCash.reference.$touched || payBillCash.reference.$dirty"
                                 style="color:red; font-size: x-small" role="alert">
                                <div ng-message="required">
                                    <strong>The {{productInfo.billidLabel}} is Required!</strong>
                                </div>
                                <div ng-message="pattern">
                                    <strong>Please Enter a Valid {{productInfo.billidLabel}}!</strong>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-money prefix"></i>
                            <input type="text" name="amount" ng-model="amount" id="amount"
                                   pattern="^\d{1,2}((\.\d{1,2})?$)"
                                   required>
                            <label for="amount">AMOUNT</label>
                            <div ng-messages="payBillCash.amount.$error"
                                 ng-if="payBillCash.amount.$touched || payBillCash.amount.$dirty"
                                 style="color:red; font-size: x-small" role="alert">
                                <div ng-message="required">
                                    <strong>The Amount is Required!</strong>
                                </div>
                                <div ng-message="pattern">
                                    <strong>Please Enter a Valid Amount</strong>
                                </div>
                            </div>

                        </div>
                        <div class="input-field">
                            <i class="fa fa-user-o prefix"></i>
                            <input type="password" name="pin" id="pin" ng-model="pin" required>
                            <label for="pin">EMPLOYEE CODE</label>
                        </div>

                        <button class="fluid ui button blue waves-effect" type="submit" ng-show="submit_pay">PAY WITH
                            CASH
                        </button>
                        <div class="progress" ng-show="loader">
                            <div class="indeterminate"></div>
                        </div>
                    </form>
                </div>


                <!--ACCOUNT-->
                <div ng-show="mode === 'account'">
                    <form id="payBillAccount" name="payBillAccount" ng-submit="paybillPreauthAccount()">
                        <div class="input-field">
                            <i class="fa fa-asterisk prefix"></i>
                            <input type="text" name="accountreference"
                                   ng-pattern="productInfo.billidFormat.replace(dblSlash,snglSlash)" id="accountreference"
                                   ng-model="accountreference" autocomplete="off" required>
                            <label for="accountreference">{{productInfo.billidLabel | uppercase}}</label>
                            <div ng-messages="payBillAccount.accountreference.$error"
                                 ng-if="payBillAccount.accountreference.$touched || payBillAccount.accountreference.$dirty"
                                 style="color:red; font-size: x-small" role="alert">
                                <div ng-message="required">
                                    <strong>The {{productInfo.billidLabel}} is Required!</strong>
                                </div>
                                <div ng-message="pattern">
                                    <strong>Please Enter a Valid Reference!</strong>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-money prefix"></i>
                            <input type="text" name="accountamount" ng-model="accountamount" id="accountamount"
                                   pattern="^\d{1,2}((\.\d{1,2})?$)"
                                   required ng-model="accountamount">
                            <label for="accountamount">AMOUNT</label>
                            <div ng-messages="payBillAccount.accountamount.$error"
                                 ng-if="payBillAccount.accountamount.$touched || payBillAccount.accountamount.$dirty"
                                 style="color:red; font-size: x-small" role="alert">
                                <div ng-message="required">
                                    <strong>The Amount is Required!</strong>
                                </div>
                                <div ng-message="pattern">
                                    <strong>Please Enter a Valid Amount</strong>
                                </div>
                            </div>

                        </div>
                        <div class="input-field">
                            <i class="fa fa-user-o prefix"></i>
                            <input type="password" name="account_employee_code" id="account_employee_code" ng-model="account_employee_code" required>
                            <label for="account_employee_code">EMPLOYEE CODE</label>
                        </div>
                        <br>
                        <div class="container"><hr></div>
                        <br>
                        <div class="input-field">
                            <i class="fa fa-mobile prefix"></i>
                            <input type="text" name="mobile" id="mobile" pattern="^(\+263|263|00263|0)7((1[2-6]\d{6}$)|(7[1-9]|8[1|2])\d{6}$|(3[2-9]\d{6}$))" ng-model="account_mobile" required>
                            <label for="mobile">MOBILE NUMBER</label>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-key prefix"></i>
                            <input type="password" name="account_pin" id="account_pin" ng-model="account_pin" required>
                            <label for="account_pin">PIN</label>
                        </div>

                        <button class="fluid ui button blue waves-effect" type="submit" ng-show="submit_pay">PAY VIA
                            ACCOUNT
                        </button>
                        <div class="progress" ng-show="loader">
                            <div class="indeterminate"></div>
                        </div>
                    </form>
                </div>
                <div ng-show="mode === 'personal'">
                    <form id="payBillPersonal" name="payBillPersonal" ng-submit="paybillPreauthPersonal()">
                        <div class="input-field">
                            <i class="fa fa-asterisk prefix"></i>
                            <input type="text" name="personalreference"
                                   ng-pattern="productInfo.billidFormat.replace(dblSlash,snglSlash)" id="personalreference"
                                   ng-model="personalreference" autocomplete="off" required>
                            <label for="personalreference">{{productInfo.billidLabel | uppercase}}</label>
                            <div ng-messages="payBillPersonal.personalreference.$error"
                                 ng-if="payBillPersonal.personalreference.$touched || payBillPersonal.personalreference.$dirty"
                                 style="color:red; font-size: x-small" role="alert">
                                <div ng-message="required">
                                    <strong>The {{productInfo.billidLabel}} is Required!</strong>
                                </div>
                                <div ng-message="pattern">
                                    <strong>Please Enter a Valid {{productInfo.billidLabel}}!</strong>
                                </div>
                            </div>
                        </div>
                        <div class="input-field">
                            <i class="fa fa-money prefix"></i>
                            <input type="text" name="personalamount" ng-model="personalamount" id="personalamount"
                                   pattern="^\d{1,2}((\.\d{1,2})?$)"
                                   required>
                            <label for="personalamount">AMOUNT</label>
                            <div ng-messages="payBillPersonal.personalamount.$error"
                                 ng-if="payBillPersonal.personalamount.$touched || payBillPersonal.personalamount.$dirty"
                                 style="color:red; font-size: x-small" role="alert">
                                <div ng-message="required">
                                    <strong>The Amount is Required!</strong>
                                </div>
                                <div ng-message="pattern">
                                    <strong>Please Enter a Valid Amount</strong>
                                </div>
                            </div>

                        </div>
                        <div class="input-field">
                            <i class="fa fa-user-o prefix"></i>
                            <input type="password" name="personal_employee_code" id="personal_employee_code" ng-model="personal_employee_code" required>
                            <label for="personal_employee_code">EMPLOYEE CODE</label>
                        </div>

                        <button class="fluid ui button blue waves-effect" type="submit" ng-show="submit_pay">PAY
                        </button>
                        <div class="progress" ng-show="loader">
                            <div class="indeterminate"></div>
                        </div>
                        <object ng-show="pdf" data="{{pdf}}" type="application/pdf" style="width: 100%; height: 400px;"></object>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>