/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Admin.controller('rootController', function ($scope, $http, $timeout, $interval) {
    var notify_url = rootBaseUrl + "localApi/notificationUpdate";
    $scope.rootData = {'notifications': []};
    $http.get(notify_url).then(function (rdata) {
        $scope.rootData.notifications = rdata.data;
    }, function () {})

    $scope.orderGlobleCheck = {"unssen": 0, "unssenmail": 0, "unseendata": "", "sound": "", "unseenemail": []}

    $scope.orderGlobleCheck.sound = document.getElementById("alertSound");


    $scope.checkUnseenOrder = function () {
        var order_status_url = rootBaseUrl + "localApi/checkUnseenOrder";
        $http.get(order_status_url).then(function (rdata) {
            $scope.orderGlobleCheck.unseendata = rdata.data;
            if (rdata.data.length) {
                $scope.orderGlobleCheck.unseen = 1;

            }
            else{
                $scope.orderGlobleCheck.unseen = 0;
            }
            var inboxOrderMail = rootBaseUrl + "localApi/inboxOrderMailIndb";
            $http.get(inboxOrderMail).then(function (rmdata) {
                $scope.orderGlobleCheck.unseenemail = rmdata.data;
                if (rmdata.data.length) {
                    $scope.orderGlobleCheck.unssenmail = 1;
                }
                else{
                    $scope.orderGlobleCheck.unssenmail = 0;
                }
                console.log(($scope.orderGlobleCheck.unseen == 1) || ($scope.orderGlobleCheck.unssenmail == 1));
                console.log($scope.orderGlobleCheck.unseen, $scope.orderGlobleCheck.unssenmail);
                if (($scope.orderGlobleCheck.unseen == 1) || ($scope.orderGlobleCheck.unssenmail == 1)) {
                    $("#modal-notification").modal("show");
                    $scope.playSound();
                }
            })
        })

        var inboxOrderMail = rootBaseUrl + "localApi/inboxOrderMail";
        $http.get(inboxOrderMail).then(function (rdata) {
        })

    }



    $scope.$watch("orderGlobleCheck.unseen", function (n, o) {
        if (n == 1) {
            $("#modal-notification").modal("show");
        }
    })



    $scope.playSound = function () {
        var promise = $scope.orderGlobleCheck.sound.play();
        if (promise !== undefined) {
            promise.then(_ => {
                // Autoplay started!
            }).catch(error => {
                // Autoplay was prevented.
                // Show a "Play" button so that user can start playback.
            });
        }
    }





    var orderpath = window.location.pathname;
    var orderlist = orderpath.split("orderdetails")
    if (orderlist.length == 2) {
    } else {
        $interval(function () {
            $scope.checkUnseenOrder();
        }, 10000)
        $scope.checkUnseenOrder();
    }

})






