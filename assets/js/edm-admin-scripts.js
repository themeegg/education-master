/**
 * Image upload functions
 */
var selector;
function upload_media_image(selector){
// ADD IMAGE LINK
    jQuery('body').on( 'click', selector , function( event ){
    event.preventDefault();

    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdIedmut = jQuery(this).siblings('.upload-id');

    // Create a new media frame
    frame = wp.media({
        title: 'Select or Upload Image',
        button: {
        text: 'Use Image'
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected in the media frame...
    frame.on( 'select', function() {

    // Get media attachment details from the frame state
    var attachment = frame.state().get('selection').first().toJSON();

    // Send the attachment URL to our custom image input field.
    imgContainer.html( '<img src="'+attachment.url+'" style="max-width:100%;"/>' );
    placeholder.addClass('hidden');
    imgIdIedmut.val( attachment.url ).trigger('change');
    });

    // Finally, open the modal on click
    frame.open();

    });
}

function delete_media_image(selector){
    // DELETE IMAGE LINK
    jQuery('body').on( 'click', selector, function( event ){

    event.preventDefault();
    var imgContainer = jQuery(this).closest('.attachment-media-view').find( '.thumbnail-image'),
    placeholder = jQuery(this).closest('.attachment-media-view').find( '.placeholder'),
    imgIdIedmut = jQuery(this).siblings('.upload-id');

    // Clear out the preview image
    imgContainer.find('img').remove();
    placeholder.removeClass('hidden');

    // Delete the image id from the hidden input
    imgIdIedmut.val( '' ).trigger('change');

    });
}

jQuery(document).ready(function($) {
    "use strict";

    /**
     * Image upload at widget
     */
    upload_media_image('.edm-upload-button');
    delete_media_image('.edm-delete-button');

    $('body').on('click','.selector-labels label', function(){
        var $this = $(this);
        var value = $this.attr('data-val');
        $this.siblings().removeClass('selector-selected');
        $this.addClass('selector-selected');
        $this.closest('.selector-labels').next('input').val(value);
    });

    /**
     * Radio Image control in metabox
     * Use buttonset() for radio images.
     */
    $( '.edm-meta-options-wrap .buttonset' ).buttonset();

    /**
     * Meta tabs and its content
     */
    var curTab = $('.edm-meta-menu-wrapper li.active').data('tab');
    $('.edm-metabox-content-wrapper').find('#'+curTab).show();

    $('ul.edm-meta-menu-wrapper li').click(function (){
        var id = $(this).data('tab');

        $('ul.edm-meta-menu-wrapper li').removeClass('active');
        $(this).addClass('active')

        $('.edm-metabox-content-wrapper .edm-single-meta').hide();
        $('#'+id).fadeIn();
        $('#post-meta-selected').val(id);
    });

});
