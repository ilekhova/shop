(function() {
  angular.module('IrkaApp').factory('Good', function($resource) {
    return $resource('/items/:id');
  }).factory('Cart', function($resource) {
    return $resource('/cart');
  }).factory('Additions', function($resource) {
    return $resource('/additions');
  }).factory('Orders', function($resource) {
    return $resource('/orders/:order_id', {
      order_id: '@id'
    });
  }).factory('SingleOrder', function($resource) {
    return {
      get: function(order_id) {
        return $resource("/orders/" + order_id);
      }
    };
  });

}).call(this);
