(function() {
  angular.module('IrkaApp').factory('Good', function($resource) {
    return $resource('/items/:id');
  }).factory('Cart', function($resource) {
    return $resource('/cart');
  }).factory('Additions', function($resource) {
    return $resource('/additions');
  });

}).call(this);
