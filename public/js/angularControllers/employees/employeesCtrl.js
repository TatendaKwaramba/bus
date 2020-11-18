businessWalletApp.controller('employeesController', function ($scope, dataHandler) {

    $scope.employeeList = true;
    $scope.employeeFile = false;


    dataHandler.getAI()
        .then(function (data) {
            $scope.id = data.agent.id;

            var params = {
                id: $scope.id
            };
            console.log(params);
            dataHandler.getAgentEmployees(params)
                .then(function (data) {
                    $scope.employees = data.employees
                }, function (error) {
                    console.log(error)
                })

        }, function (error) {
        });


    $scope.openEmployee = function (employee) {
        $scope.employeeList = false;
        $scope.employeeFile = true;
        $scope.employeeInfo = employee;
        console.log($scope.employeeInfo);


        //////////////////////////////////
        var today = new Date();
        var dd = today.getDate();
        var ed = today.getDate() + 1;
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;
        var end = yyyy + '-' + mm + '-' + (ed );
        $scope.displayedDate = new Date().toDateString();
        $scope.todayParams = {
            id: $scope.employeeInfo.id,
            start_date: today,
            end_date: end
        };
        console.log($scope.todayParams)
        dataHandler.getEmployeeTransactions($scope.todayParams)
            .then(function (data) {
                $scope.transactions = data.transactions;
                console.log($scope.transactions)

            }, function (error) {
                console.log(error)
            });
        console.log($scope.transactions)
        /////////////////////////////////////////////////////////////////////////////////////////
        $scope.searchByDate = function () {
            $scope.loader = true;
            $scope.search_icon = false;

            $scope.statement = '';

            if ($scope.start_date.getTime() > $scope.end_date.getTime()) {
                $scope.loader = false;
                $scope.search_icon = true;

                swal('', 'Invalid Date Range!', 'warning');
            }
            if ($scope.start_date.getTime() < $scope.end_date.getTime()) {
                /////////////////////////////////////////////
                var sd = $scope.start_date.getDate();
                var ed = $scope.end_date.getDate() + 1;
                var sm = $scope.start_date.getMonth() + 1; //January is 0!
                var em = $scope.end_date.getMonth() + 1; //January is 0!
                var ssyy = $scope.start_date.getFullYear();
                var eeyy = $scope.end_date.getFullYear();
                /////////////////////////////////////////////
                if (sd < 10) {
                    sd = '0' + sd
                }
                if (sm < 10) {
                    sm = '0' + sm
                }
                if (ed < 10) {
                    ed = '0' + ed
                }
                if (em < 10) {
                    em = '0' + em
                }
                ////////////////////////////////////////////
                var start = ssyy + '-' + sm + '-' + sd;
                var end = eeyy + '-' + em + '-' + (ed);
                ///////////////////////////////////////

                var params = {
                    id: $scope.id,
                    start_date: start,
                    end_date: end
                };
                console.log(params);
                dataHandler.getAgentTransactions(params)
                    .then(function (data) {
                        $scope.displayedDate = $scope.start_date.toDateString() + ' - ' + $scope.end_date.toDateString();
                        $scope.loader = false;
                        $scope.search_icon = true;
                        console.log(data)
                        $scope.transactions = data.transactions;

                    }, function (error) {
                        swal('', 'Something Went Wrong, Please try Again', 'warning');
                        $scope.loader = false;
                        $scope.search_icon = true;
                    });
            }
            if ($scope.start_date.getTime() == $scope.end_date.getTime()) {



                /////////////////////////////////////////////
                var sde = $scope.start_date.getDate();
                var ede = $scope.end_date.getDate();
                var sme = $scope.start_date.getMonth() + 1; //January is 0!
                var eme = $scope.end_date.getMonth() + 1; //January is 0!
                var ssyye = $scope.start_date.getFullYear();
                var eeyye = $scope.end_date.getFullYear();
                /////////////////////////////////////////////
                if (sde < 10) {
                    sde = '0' + sde
                }
                if (sme < 10) {
                    sme = '0' + sme
                }
                if (ede < 10) {
                    ede = '0' + ede
                }
                if (eme < 10) {
                    eme = '0' + eme
                }
                ////////////////////////////////////////////
                var starte = ssyye + '-' + sme + '-' + sde;
                var ende = eeyye + '-' + eme + '-' + (ede + 1);
                ///////////////////////////////////////

                var paramse = {
                    id: $scope.id,
                    start_date: starte,
                    end_date: ende
                };
                dataHandler.getAgentTransactions(paramse)
                    .then(function (data) {
                        $scope.displayedDate = $scope.start_date.toDateString();
                        $scope.loader = false;
                        $scope.search_icon = true;
                        console.log(data)
                        $scope.transactions = data.transactions;

                    }, function (error) {
                        swal('', 'Something Went Wrong, Please try Again', 'warning');
                        $scope.loader = false;
                        $scope.search_icon = true;
                    });
            }

        }


    };

    $scope.backToEmployeeList = function () {
        $scope.employeeList = true;
        $scope.employeeFile = false;
        $('#dateSearchForm').trigger('reset');
        $scope.dateSearch = false;
    }



});
