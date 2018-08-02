jQuery(function () {
    $(document).on('click', '.add_property', function (e, el) {
        that = $(this), fg = that.closest('.input-group'), New = $('<div class="form-group field-items-receipt_id has-success"><div class="input-group"> </div>   </div>').find('.input-group').html(
            '<div class="input-group input-group-md group-w1"><span class="input-group-addon"><code>Добавить  свойство</code></span><textarea id="w1" class="form-control" name="GoodsProperties">\n' +

            '</textarea><div class="input-group-btn"><button type="button" class="btn btn-success" title="удалить  свойство" data-toggle="tooltip"><span class="glyphicon glyphicon-minus"></span></button></div></div>'
        );

        fg.after(New);
        e.preventDefault();
    });
    $(document).on('click', '.convertdate', function (e) {
        attr = $(this).data('cell');
        $that = $(this), oldhtml = $that.html();
        format = $(this).data('format');
        $(this).button('loading');
        $.getJSON(Server.convertdate.url, {'from': $(attr).val(), 'format': format})
            .fail(function (xhr, text, fulltext) {
                alert([text, ':', fulltext]);
                $that.button('reset');
            })
            .done(function (result) {
                $that.button('reset');
                if ('error' in result) {
                    $that.html(result.html);
                    setTimeout(function () {
                        $that.html(oldhtml);
                    }, 1000);
                } else {
                    $(attr).fadeOut();
                    $(attr).val(result.result);
                    $(attr).fadeIn('fast', function () {
                    });
                }

            });
        e.preventDefault();
    });

})
;