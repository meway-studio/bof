$(document).ready(function() {
	$('.ajax-cart.-add').click(function() {
		var obj = $(this);
		var elementId = obj.data('id') ? parseInt(obj.data('id')) : false;
		var quantity = $('.ajax-cart.-quantity').length ? $('.ajax-cart.-quantity').val() : 1;
		if (elementId) {
			$.post('/catalog/cart/element', {id: elementId, quantity: quantity}, function() {
				alert('Товар успешно добавлен в корзину');
			});
		}
	});
	$('.ajax-cart.-delete').click(function() {
		var obj = $(this);
		var elementId = obj.data('id') ? parseInt(obj.data('id')) : false;
		var removedElement = obj.data('remove-element') ? obj.data('remove-element') : false;
		if (elementId) {
			$.post('/catalog/cart/element', {id: elementId, delete: 1}, function() {
				if (removedElement) {
					$(removedElement).remove();
				}
			});
		}
	});
});