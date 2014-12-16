(function() {
  angular.module('IrkaApp', ['ngRoute', 'ngResource', 'ngAnimate']).config(function($routeProvider, $locationProvider) {
    return $routeProvider.when('/', {
      templateUrl: '../templates/main.html'
    }).when('/goods', {
      controller: 'GoodCtrl',
      templateUrl: '../templates/goods.html'
    }).when('/goods/:id', {
      controller: 'ItemCtrl',
      templateUrl: '../templates/item.html'
    }).when('/cart', {
      controller: 'CartCtrl',
      templateUrl: '../templates/cart.html'
    }).otherwise({
      redirectTo: '/'
    });
  });

}).call(this);
