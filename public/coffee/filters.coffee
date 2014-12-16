angular.module 'IrkaApp'

	.filter 'toRussian', ->
		(input) ->
			if input == 'syrup_id'
				input = 'Сиропы'

			if input == 'cream_id'
				input = 'Крема'

			if input == 'sprinkling_id'
				input = 'Посыпки'

			else
				input = input