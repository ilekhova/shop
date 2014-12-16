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
        input = 'Посыпки';
      }
      if (input === 'syrup') {
        input = 'Сироп';
      }
      if (input === 'sprinkling') {
        input = 'Посыпка';
      }
      if (input === 'cream') {
        return input = 'Крем';
      } else {
        return input = input;
      }
    };
  });

}).call(this);
