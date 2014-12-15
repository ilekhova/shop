(function() {
  angular.module('IrkaApp').filter('toRussian', function() {
    return function(input) {
      if (input === 'syrup_id') {
        input = 'Сиропы';
      }
      if (input === 'cream_id') {
        input = 'Крема';
      }
      if (input === 'sprinkling_id') {
        return input = 'Посыпки';
      } else {
        return input = input;
      }
    };
  });

}).call(this);
