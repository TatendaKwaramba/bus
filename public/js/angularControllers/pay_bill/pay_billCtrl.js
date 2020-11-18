businessWalletApp.controller('pay_billCtrl', function ($scope, dataHandler,$window) {
    $scope.loading = true;
    $scope.searchResults = {};
    $scope.productList = true;
    $scope.productPay = false;
    $scope.submit_pay = true;
    $scope.loader = false;

    $scope.accountamount = '';
    $scope.accountreference = '';
    $scope.personalamount = '';
    $scope.personalreference = '';
    $scope.amount = '';
    $scope.reference = '';

    $scope.cash_employee_code = '';
    $scope.personal_employee_code = '';
    $scope.account_employee_code = '';
    $scope.account_mobile = '';
    $scope.account_pin='';


    $scope.pin = '';
    $scope.mode = 'cash';

    $scope.isShown = function(mode) {
        return mode === $scope.mode;
    };


    $scope.dblSlash = /\\\\/g;
    $scope.snglSlash = "\\";


    dataHandler.getProducts()
        .then(function (data) {
            $scope.loading = false;
            $scope.products = data.products;


            //console.log(data.products)
        }, function (error) {
            $scope.loading = false;
            swal('', 'Something Went Wrong While Fetching the Data. Please Refresh the Page', 'warning');
        });

    $scope.open = function (product) {
        $scope.productInfo = product;
        $scope.productList = false;
        $scope.productPay = true;
    };

    $scope.paybillPreauthCash = function () {
        $scope.submit_pay = false;
        $scope.loader = true;
        var params = {
            imei: '980005',
            amount: $scope.amount,
            reference: $scope.reference,
            employee_code: $scope.pin,
            product_id: $scope.productInfo.id,
            agent_id: $scope.ai.agent.id
        };
        console.log(params);

        if ($scope.productInfo.name === 'ZESA TOKEN PURCHASE'){
            dataHandler.payBillPreauthCash(params)
                .then(function (data) {
                    $scope.submit_pay = true;
                    $scope.loader = false;
                    if (data.code === "00") {
                        var params2 = {
                            imei: '980005',
                            agent_id: $scope.ai.agent.id,
                            amount: $scope.amount,
                            reference: $scope.reference,
                            employee_code: $scope.pin,
                            product_id: $scope.productInfo.id,
                            auth_id: data.auth_id
                        };
                        console.log(params2);
                        console.log($.parseJSON(data.additionalData));
                        $scope.additionalData = $.parseJSON(data.additionalData);
                        $scope.additionalData.customerData = $scope.additionalData.customerData.split('|');
                        $scope.additionalData.customerAddress = $scope.additionalData.customerAddress.split('|');
                        console.log($scope.additionalData.transmissionDate);

                        swal({
                                title: "Confirm Payment",
                                text: formatter.format($scope.amount) + " to " + $scope.productInfo.name.toUpperCase() +
                                "<br><b>Customer name:</b> " + $scope.additionalData.customerData[0] +
                                "<br><b>Customer address:</b> " + $scope.additionalData.customerAddress,
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                                html:true
                            },
                            function () {
                                dataHandler.payBillConfirmCash(params2)
                                    .then(function (data) {
                                        console.log(data);
                                        var zesa = $.parseJSON(data.apiDescription);
                                        var fixed_charges_data = zesa.fixedCharges.split('|');
                                        var misc = zesa.miscellaneousData.split('|');
                                        var token = zesa.token.split('|');
                                        var receipt_number = fixed_charges_data[1];
                                        var meter_number = zesa.meterNumber;
                                        var token_number = token[0];
                                        var vendor_reference = zesa.vendorReference;
                                        var transmission_date = zesa.transmissionDate;
                                        var tariff =  token[2];
                                        var tendered_amount = formatter.format(zesa.transactionAmount/100);
                                        var customer_name = $scope.additionalData.customerData[0];
                                        var house_number = $scope.additionalData.customerAddress[0];
                                        var suburb = $scope.additionalData.customerAddress[2];
                                        var town = $scope.additionalData.customerAddress[3];
                                        var energy_bought = token[1];
                                        var energy_charge = token[4]/100;
                                        var vat_percentage  = token[6];
                                        var vat  = token[5]/100;
                                        var re_levy = fixed_charges_data[2]/100;
                                        var re_levy_percentage = fixed_charges_data[4];
                                        var debt_collected = fixed_charges_data[3]/100;
                                        var tariff_index = misc[0];
                                        var supply_group = misc[1];
                                        var key_rev_number = misc[2];
                                        var total_paid = energy_charge + vat + re_levy;
                                        var debt_before_transaction = '';
                                        var debt_after_transaction = '';

                                        if (data.code === "00") {
                                           var params = {
                                                token_number: token_number,
                                                meter_number: meter_number,
                                                receipt_number: receipt_number,
                                                customer_name:customer_name,
                                                house_number:house_number,
                                                suburb:suburb,
                                                town:town,
                                                tariff:tariff,
                                                energy_bought:energy_bought,
                                                tendered_amount:tendered_amount,
                                                energy_charge:formatter.format(energy_charge),
                                                debt_collected:debt_collected,
                                                re_levy:formatter.format(re_levy),
                                                vat:formatter.format(vat),
                                                vat_percentage:vat_percentage,
                                                re_levy_percentage:re_levy_percentage,
                                                tariff_index:tariff_index,
                                                supply_group:supply_group,
                                                key_rev_number:key_rev_number,
                                                total_paid:formatter.format(total_paid),
                                                debt_before_transaction:debt_before_transaction,
                                                debt_after_transaction:debt_after_transaction,
                                                transmission_date: transmission_date,
                                                vendor_reference: vendor_reference

                                            };

                                            console.log(params);

                                            dataHandler.printZesa(params)
                                                .then(function (data) {
                                                    var file = new Blob([(data)], {type:'application/pdf'});
                                                    var fileURL = URL.createObjectURL(file);
                                                    $scope.pdf= $window.open(fileURL,'_self','');
                                                }, function (error) {
                                                    console.log(error)
                                                });

                                            swal("", "Payment Successful", "success");
                                            $('#payBillCash').trigger('reset');
                                        } else {
                                            console.log(data);
                                            swal('', 'Something Went Wrong While Fetching the Data. Please Refresh the Page', 'warning');

                                        }

                                        console.log($.parseJSON(data.apiDescription))
                                    }, function (error) {
                                        swal("", "Something Went Wrong, Please Try Again", "warning");
                                        $('#payBillCash').trigger('reset');

                                        console.log(error)
                                    })

                            })
                    }
                    else {
                        swal('', data.description, 'warning');
                        $('#payBillCash').trigger('reset');

                    }


                }, function (error) {
                    $scope.submit_pay = true;
                    $scope.loader = false;
                    swal('', 'Something Went Wrong While Processing the Transaction. Please Try Again', 'warning');
                })        }
        else {
            dataHandler.payBillPreauthCash(params)
                .then(function (data) {
                    $scope.submit_pay = true;
                    $scope.loader = false;
                    console.log(data);
                    if (data.code === "00") {
                        var params2 = {
                            imei: '980005',
                            amount: $scope.amount,
                            reference: $scope.reference,
                            employee_code: $scope.pin,
                            product_id: $scope.productInfo.id,
                            auth_id: data.auth_id,
                            agent_id: $scope.ai.agent.id

                        };
                        console.log(params2);
                        swal({
                                title: "Confirm Payment",
                                text: formatter.format($scope.amount) + " to " + $scope.productInfo.name.toUpperCase(),
                                type: "info",
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true
                            },
                            function () {
                                dataHandler.payBillConfirmCash(params2)
                                    .then(function (data) {
                                        console.log(data);
                                        if (data.code === "00") {
                                            swal("", "Payment Successful", "success");
                                            $('#payBillCash').trigger('reset');
                                        }
                                        if(data.contains('Success')){
                                            swal("", "Payment Successful", "success");
                                            $('#payBillCash').trigger('reset');
                                        }
                                        else {
                                            console.log(data);
                                            swal('', data.description, 'warning');

                                        }

                                        console.log(data)
                                    }, function (error) {
                                        swal("", "Something Went Wrong, Please Try Again", "warning");
                                        $('#payBillCash').trigger('reset');

                                        console.log(error)
                                    })

                            })
                    }
                    else {
                        swal('', data.description, 'warning');
                    }


                }, function (error) {
                    $scope.submit_pay = true;
                    $scope.loader = false;
                    swal('', 'Something Went Wrong While Processing the Transaction. Please Try Again', 'warning');
                })
        }
    };

    $scope.paybillPreauthAccount = function () {
        $scope.submit_pay = false;
        $scope.loader = true;
        var params = {
            imei: $scope.ai.devices[0].imei,
            amount: $scope.accountamount,
            reference: $scope.accountreference,
            employee_code: $scope.account_employee_code,
            product_id: $scope.productInfo.id,
            mobile: $scope.account_mobile,
            pin: $scope.account_pin,
            agent_id: $scope.ai.agent.id


        };
        console.log(params);
        dataHandler.payBillPreauthAccount(params)
            .then(function (data) {
                $scope.submit_pay = true;
                $scope.loader = false;
                if (data.code === "00") {
                    var params2 = {
                        imei: $scope.ai.devices[0].imei,
                        amount: $scope.accountamount,
                        reference: $scope.accountreference,
                        employee_code: $scope.account_employee_code,
                        product_id: $scope.productInfo.id,
                        auth_id: data.auth_id,
                        mobile: $scope.account_mobile,
                        pin: $scope.account_pin,
                        agent_id: $scope.ai.agent.id
                    };
                    swal({
                            title: "Confirm Payment",
                            text: formatter.format($scope.accountamount) + " to " + $scope.productInfo.name.toUpperCase(),
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true,
                            inputPlaceholder: "Enter OTP"
                        },
                        function (inputValue) {

                            if (inputValue === false) return false;

                            if (inputValue === "") {
                                swal.showInputError("The OTP is required!");
                                return false
                            }
                            params2['OTP'] = inputValue;

                            dataHandler.payBillConfirmAccount(params2)
                                .then(function (data) {
                                    if (data.code === "00") {
                                        swal("", "Payment Successful", "success");
                                        $('#payBillAccount').trigger('reset');
                                    } else {
                                        swal('', 'Something Went Wrong While Fetching the Data. Please Refresh the Page', 'warning');

                                    }

                                }, function (error) {
                                    swal("", "Something Went Wrong, Please Try Again", "warning");
                                    $('#payBillAccount').trigger('reset');

                                })

                        })
                }
                else {
                    swal('', data.description, 'warning');
                }


            }, function (error) {
                $scope.submit_pay = true;
                $scope.loader = false;
                swal('', 'Something Went Wrong While Processing the Transaction. Please Try Again', 'warning');
            })
    };

    $scope.paybillPreauthPersonal= function () {
        $scope.submit_pay = false;
        $scope.loader = true;
        var params = {
            imei: '980005',
            agent_id: $scope.ai.agent.id,
            amount: $scope.personalamount,
            reference: $scope.personalreference,
            employee_code: $scope.personal_employee_code,
            product_id: $scope.productInfo.id
        };
        console.log(params);
        dataHandler.payBillPreauthPersonal(params)
            .then(function (data) {
                $scope.submit_pay = true;
                $scope.loader = false;
                if (data.code === "00") {
                    var params2 = {
                        imei: '980005',
                        agent_id: $scope.ai.agent.id,
                        amount: $scope.personalamount,
                        reference: $scope.personalreference,
                        employee_code: $scope.personal_employee_code,
                        product_id: $scope.productInfo.id,
                        auth_id: data.auth_id
                    };
                    swal({
                            title: "Confirm Payment",
                            text: formatter.format($scope.amount) + " to " + $scope.productInfo.name.toUpperCase(),
                            type: "info",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            showLoaderOnConfirm: true
                        },
                        function () {
                            dataHandler.payBillConfirmPersonal(params2)
                                .then(function (data) {
                                    if (data.code === "00") {
                                        swal("", "Payment Successful", "success");
                                        $('#payBillPersonal').trigger('reset');
                                    } else {
                                        swal('', data.description, 'warning');

                                    }

                                    console.log(data)
                                }, function (error) {
                                    swal("", "Something Went Wrong, Please Try Again", "warning");
                                    $('#payBillPersonal').trigger('reset');

                                    console.log(error)
                                })

                        })
                }
                else {
                    swal('', data.description, 'warning');
                }


            }, function (error) {
                $scope.submit_pay = true;
                $scope.loader = false;
                swal('', 'Something Went Wrong While Processing the Transaction. Please Try Again', 'warning');
            })
    };

    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });

});