jQuery(document).ready(function($){
    $(document).on("click", ".upload_image_button", function(e) {
        var custom_uploader;

        // Get the previous text input field where image URL would be stored
        var text_field_url = $(e.target).prev("input[type=text]");
        e.preventDefault();

        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }

        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: true
        });

        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            text_field_url.val(attachment.url);

            // Trigger change to enable the 'Saved' widget button 
            text_field_url.trigger("change"); 
         });

        //Open the uploader dialog
        custom_uploader.open();
    });
});