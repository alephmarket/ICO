(function () {
    "use strict";

    var app = angular.module('App',[]);
    app.service('Locations', function(){
        this.locations = [];
    });
    app.controller('CtrlLoc',['$scope', 'Locations', function($scope, Locations){               
        $scope.locations = Locations.locations = JSON.parse(angular.element('.ideo-google-locations').data('json').replace(/'/g,'"')) || [{text:'', lat:'', lng:''}];

        $scope.$watchCollection('locations', function(val){
            Locations.locations = $scope.locations;
        });

        $scope.add = function(){             
            $scope.locations.push({text:'', lat:'', lng:''});
        };

        $scope.del = function(loc){
            if (confirm('Are you sure to delete this address?')) {
                var index = $scope.locations.indexOf(loc);
                if (index > -1) {
                    $scope.locations.splice(index, 1);
                }
            }
        };

    }]);
    app.controller('CtrlCenter',['$scope', 'Locations', function($scope, Locations){               
        $scope.locations = Locations.locations;
        $scope.$watchCollection('Locations', function(val){
            $scope.locations = Locations.locations;
        });
    }]);

    app.filter('singlequote',function(){
        return function(text){
            return text.replace(/\"/g,"'");
        };
    });
    angular.bootstrap(angular.element('#vc_edit-form-tab-0'), ['App']);
})();