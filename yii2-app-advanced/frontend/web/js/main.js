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
    $(document).on('keyup', '#items-price', function (e) {

        $cell = ($ig = $(this).closest('.form-group')).find('.input-group-addon code');
        els = [$f = $(this).closest('form'), $ig, $inp = $ig.find('input'), $cell];

        $that = $(this), oldhtml = $that.html();
        val = $(this).val();
        result = false;
        try {
            if (val !== '')
                eval('{var result =  ' + val.toString() + ';}');
            if (result)
                val = parseFloat(result);

        } catch (error) {
            $('#' + $f.attr('id')).yiiActiveForm('updateAttribute', $inp.attr('id'), [error.message]);
        }
        $cell.html(number_format(val / 100, 2, '.', ' '));


        e.preventDefault();
    });

    /**
     *
     * @param number
     * @param decimals
     * @param dec_point
     * @param thousands_sep
     * @returns {string}
     * @see https://javascript.ru/php/number_format
     */
    function number_format(number, decimals, dec_point, thousands_sep) {	// Format a number with grouped thousands
        //
        // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +	 bugfix by: Michael White (http://crestidg.com)

        var i, j, kw, kd, km;

        // input sanitation & defaults
        if (isNaN(decimals = Math.abs(decimals))) {
            decimals = 2;
        }
        if (dec_point == undefined) {
            dec_point = ',';
        }
        if (thousands_sep == undefined) {
            thousands_sep = '.';
        }

        i = parseInt(number = (+number || 0).toFixed(decimals)) + '';

        if ((j = i.length) > 3) {
            j = j % 3;
        } else {
            j = 0;
        }

        km = (j ? i.substr(0, j) + thousands_sep : '');
        kw = i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousands_sep);
        //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
        kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


        return km + kw + kd;
    }


})
;