businessWalletApp.factory('dataHandler', function ($http, $q) {
    var dataHandler = {};

    //GET PRODUCTS
    dataHandler.getProducts = function () {
        var defer = $q.defer();
        $http.get('/api/products/get')
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };

    dataHandler.getAgents = function () {
        var defer = $q.defer();
        $http.get('/api/agents/get')
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };
    dataHandler.getAI = function () {
        var defer = $q.defer();
        $http.get('/api/ai')
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };
    dataHandler.removeAI = function () {
        var defer = $q.defer();
        $http.get('/api/ai/logout')
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };


    dataHandler.getClassOfService = function () {
        var defer = $q.defer();
        $http.get('/api/classofservice/get')
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };


    dataHandler.payBillPreauthCash = function (params) {
        var defer = $q.defer();
        $http.post('/api/paybill/cash/preauth', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };
    dataHandler.payBillConfirmCash = function (params) {
        var defer = $q.defer();
        $http.post('/api/paybill/cash/confirm', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };

    dataHandler.payBillPreauthAccount = function (params) {
        var defer = $q.defer();
        $http.post('/api/paybill/account/preauth', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };
    dataHandler.payBillConfirmAccount = function (params) {
        var defer = $q.defer();
        $http.post('/api/paybill/account/confirm', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };

    dataHandler.payBillPreauthPersonal = function (params) {
        var defer = $q.defer();
        $http.post('/api/paybill/personal/preauth', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };
    dataHandler.payBillConfirmPersonal = function (params) {
        var defer = $q.defer();
        $http.post('/api/paybill/personal/confirm', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };

    dataHandler.addSubscriber = function (params) {
        var defer = $q.defer();
        $http.post('/api/subscriber/add', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };

    dataHandler.printZesa = function (params) {
        var defer = $q.defer();
        $http.get('/pdf', {params: params})
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err) {
                defer.reject(err)
            });
        return defer.promise;
    };

    dataHandler.getAgentTransactions = function (params) {
        var defer = $q.defer();

        $http.post('/api/business/transactions', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };

    dataHandler.getAgentEmployees = function (params) {
        var defer = $q.defer();

        $http.post('/api/business/employees', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };

    dataHandler.getEmployeeTransactions = function (params) {
        var defer = $q.defer();

        $http.post('/api/business/employees/transactions', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };


    dataHandler.submitPin = function (params) {
        var defer = $q.defer();

        $http.post('/change-pin', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };

    dataHandler.receivePaymentPreauth = function (params) {
        var defer = $q.defer();

        $http.post('/api/receive_payment/preauth', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };
    dataHandler.receivePaymentConfirm = function (params) {
        var defer = $q.defer();

        $http.post('/api/receive_payment/confirm', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };

    dataHandler.cardActivation = function (params) {
        var defer = $q.defer();

        $http.post('/api/cardActivation', params)
            .success(function (data) {
                defer.resolve(data)
            })
            .error(function (err, status) {
                defer.reject(err)
            });

        return defer.promise;

    };


    return dataHandler;
});
