function changeField(ithis) {
    var url = '/admin/products/:product/editField';
    var product = ithis.attr('data-product-id');
    var type = ithis.attr('data-attribute-type');
    var field = ithis.attr('data-attribute-name');
    var value = ithis.html();
    var token = document.head.querySelector('meta[name="csrf-token"]');

    $.ajax({
        url: url.replace(':product', product),
        method: 'PUT',
        data: {
            attributeType: type,
            field: field,
            value: value,
            _token: token.content
        },
        complete: function() {
            ithis.removeClass('sending')
        },
        beforeSend: function () {
            ithis.addClass('sending').removeClass('success', 'error');
        },
        success: function (json) {
            if(json['success']) {
                ithis.addClass('success')
            } else {
                ithis.addClass('error');
            }
        }
    })
}

$(document).ready(function () {
    $(document).on('keyup', '.ajax-editable', function () {
        changeField($(this));
    });
});