(function() {
  angular.module('IrkaApp').factory('Good', function($resource) {
    return $resource('/items/:id');
  });

}).call(this);
