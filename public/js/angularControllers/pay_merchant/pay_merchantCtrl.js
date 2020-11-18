businessWalletApp.controller('pay_merchantCtrl', function ($scope, dataHandler) {
    $scope.cards = true;
    $scope.receivePayment = false;
    $scope.makePayment = false;
    $scope.merchantList = true;
    $scope.merchantPayment = false;
    $scope.merchantSearchIcon = false;
    $scope.mobile = '';
    $scope.pin = '';
    $scope.amount = '';

    dataHandler.getAI()
        .then(function (data) {
            $scope.ai = data;
        }, function (error) {
            dataHandler.removeAI();
            swal({
                    title: '',
                    text: 'Could Not Verify Your Business Information, Please Reload the Page',
                    type: 'warning',
                    showCancelButton: false,
                    confirmButtonText: 'RELOAD'
                },
                function () {
                    location.reload();
                }
            );

            console.log(error)
        })


    $scope.showReceivePayment = function () {

        $scope.cards = false;
        $scope.receivePayment = true;
    };

    $scope.showMakePayment = function () {
        $scope.cards = false;
        $scope.makePayment = true;
        $scope.merchantSearchIcon = true;

    };

    dataHandler.getAgents()
        .then(function (data) {
            $scope.merchants = data.agents;
        }, function (error) {
            console.log(error)
        });

    $scope.open = function (merchant) {
        $scope.merchantList = false;
        $scope.merchantPayment = true;
        $scope.merchant = merchant;
        console.log($scope.merchant)
    };

    $scope.receivePreauth = function () {
        var params = {
            imei: '980005',
            mobile: $scope.mobile,
            amount: $scope.amount,
            pin: $scope.pin,
            agent_id: $scope.ai.agent.id,
            type: 'c2b'
        };

        dataHandler.receivePaymentPreauth(params)
            .then(function (data) {
                console.log(data);
                if (data.code === '00') {
                    swal({
                            title: "PLEASE ENTER YOUR EMPLOYEE CODE",
                            text: "",
                            type: "input",
                            showCancelButton: true,
                            closeOnConfirm: false,
                            inputPlaceholder: "",
                            inputType: "password",
                            showLoaderOnConfirm: true
                        },
                        function (inputValue) {
                            if (inputValue === false) return false;

                            if (inputValue === "") {
                                swal.showInputError("PIN IS REQUIRED");
                                return false
                            }
                            var params2 = {
                                imei: $scope.ai.devices[0].imei,
                                mobile: $scope.mobile,
                                amount: $scope.amount,
                                pin: $scope.pin,
                                agent_id: $scope.ai.agent.id,
                                type: 'c2b',
                                employee_code: inputValue,
                                auth_id: data.auth_id
                            };


                           dataHandler.receivePaymentConfirm(params2)
                               .then(function (data) {
                                 swal(data.description);
                                   $('#receivePaymentForm').trigger('reset')
                               }, function (error) {
                                   swal('Something Went Wrong, Please Try Again!');
                                   $('#receivePaymentForm').trigger('reset')

                               })
                        });


                }
            }, function (error) {
                console.log(error)
            });


        /*swal({
         title: "PLEASE ENTER YOUR PIN",
         text: "",
         type: "input",
         showCancelButton: true,
         closeOnConfirm: false,
         inputPlaceholder: "",
         inputType: "password",
         showLoaderOnConfirm: true
         },
         function (inputValue) {
         if (inputValue === false) return false;

         if (inputValue === "") {
         swal.showInputError("PIN IS REQUIRED");
         return false
         }

         setTimeout(function () {
         swal("Ajax request finished!");
         }, 2000);
         });*/


    };

    $scope.makePaymentPreauth = function(){
        var params = {
            imei: '980005',
            mobile: 'default',
            amount: $scope.amount,
            pin: $scope.pin,
            agent_id: $scope.merchant.id,
            type: 'b2b',
            agent: $scope.ai.agent.id
        };
        dataHandler.receivePaymentPreauth(params)
            .then(function(data){
                console.log(data);
                if (data.code === '00') {

                            var params2 = {
                                imei: '980005',
                                mobile: $scope.ai.agent.cellphone,
                                amount: $scope.amount,
                                agent_id: $scope.merchant.id,
                                type: 'b2b',
                                pin: $scope.pin,
                                auth_id: data.auth_id,
                                agent: $scope.ai.agent.id
                            };
                            console.log(params2)


                            dataHandler.receivePaymentConfirm(params2)
                                .then(function (data) {
                                    swal(data.description);
                                    $('#makePaymentForm').trigger('reset')
                                }, function (error) {
                                    swal('Something Went Wrong, Please Try Again!');
                                    $('#makePaymentForm').trigger('reset')

                                })
                        }
                        else {
                    swal(data.description);
                }


            }, function (error) {
                console.log(error)
            })

    }


});
