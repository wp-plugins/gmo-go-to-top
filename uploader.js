jQuery(document).ready(function($){
    var custom_uploader;
    $('#up_botan').click(function(e) {
        e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
        custom_uploader = wp.media({
            title: 'Choose Image',
            library: {
                type: 'image'
            }, 
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            var images = custom_uploader.state().get('selection');
            images.each(function(file){
                $('#images_url').val(file.toJSON().url);
            });
        });
        custom_uploader.open();
    });
});

