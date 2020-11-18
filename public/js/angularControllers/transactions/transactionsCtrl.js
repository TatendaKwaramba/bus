businessWalletApp.controller('transactionsController', function ($scope, dataHandler) {

    $scope.transactionFile = false;
    $scope.transactionList = true;


    dataHandler.getAI()
        .then(function (data) {
            $scope.ai = data;
            $scope.id = data.agent.id;


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
                start_date: today,
                end_date: end
            };
            console.log($scope.todayParams)
            dataHandler.getAgentTransactions($scope.todayParams)
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
                    var ende = eeyye + '-' + eme + '-' + ( '0' +ede + 1);
                    ///////////////////////////////////////

                    var paramse = {
                        start_date: starte,
                        end_date: ende
                    };
                    console.log(paramse)
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

        }, function (error) {
            swal('', 'Something Went Wrong, Please try Again', 'warning');
        });
    ///////////////////////////////////////////////////////////////////////////////////////


    $scope.openTransaction = function (transaction) {
        $scope.transactionInfo = transaction;
        $('#transactionInfo').openModal();

    };
    $scope.viewTransactionFile = function () {
        $scope.transactionFile = true;
        $scope.transactionList = false;
    };
    $scope.backToTransactionListFromDetails = function () {
        $scope.transactionFile = false;
        $scope.transactionList = true;
    }

    $scope.makeBusinessListCsv = function (filtered) {
        var csv_filtered = [];

        var product = function (entry) {
            try {
                return entry.productId.name
            } catch (e) {
                return '-';
            }

        };
        var agentName = function (entry) {
            try {
                return entry.agentId.name
            } catch (e) {
                return '-';
            }

        };
        var agentAccount = function (entry) {
            try {
                return entry.agentId.account
            } catch (e) {
                return '-';
            }

        };
        var clientName = function (entry) {
            try {
                return entry.clientId.name
            } catch (e) {
                return '-';
            }

        };
        var amount = function (entry) {
            try {
                return entry.amount
            } catch (e) {
                return '-';
            }

        };
        var debit = function (entry) {
            try {
                return entry.credit
            } catch (e) {
                return '-';
            }

        };
        var credit = function (entry) {
            try {
                return entry.debit
            } catch (e) {
                return '-';
            }

        };


        filtered.forEach(function (entry) {
            csv_filtered.push(
                {
                    date: 'Date',
                    ref: 'Reference',
                    description: 'Description',
                    product: 'Product',
                    amount: 'Amount'

                }
            );
            csv_filtered.push(
                {
                    date: entry.date,
                    ref: entry.id,
                    description: entry.description,
                    product: product(entry),
                    amount: amount(entry)


                }
            );

        });


        return csv_filtered;
    };


    $scope.test = function () {
        var x = $scope.makeBusinessListCsv($scope.transactions);
        console.log(x)
        var dd = {
            content: [
                {text: 'Dynamic parts', style: 'header'},
                table(x, ['name', 'age','s','s','k','l'])
            ],
            styles: {
                tableExample: {
                    margin: [0, 5, 0, 15]
                }
            }

        };
        pdfMake.createPdf(dd).download('optionalName.pdf');
    };

});

function buildTableBody(data, columns) {
    var body = [];

    body.push(columns);

    data.forEach(function(row) {
        var dataRow = [];

        columns.forEach(function(column) {
            dataRow.push(row[column]);
        });

        body.push(dataRow);
    });

    return body;
}

function table(data, columns) {
    return {
        table: {
            headerRows: 1,
            body: buildTableBody(data, columns)
        }
    };
}

