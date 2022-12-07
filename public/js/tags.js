$(document).ready(function() {

    var inputElm = document.querySelector('input[name=tags]'),
        tagify = new Tagify (inputElm, {
            dropdown: {
                maxItems: 20,
                classname: "tags-look",
                enabled: 0,
                closeOnSelect: false,
                enforceWhitelist: true,
              }
        });

    tagify.on('input', onInput);
    inputElm.addEventListener('change', onChange)

    function onInput( e ){
        var value = e.detail.value
        tagify.whitelist = null

        tagify.loading(true).dropdown.hide()

        $.ajax({
            type: "GET",
            url: "/profile/tags",
            data: {query: value},
            dataType: "json",
            success: function (tags) {
                tagify.whitelist = tags,
                //console.log(tags);
                tagify.loading(false).dropdown.show(value)
            }
        });
    }

    function onChange(e){
        console.log(e.target.value);
    }
});
