<textarea cols="40" id="<?php echo $field_name; ?>" name="<?php echo $field_name; ?>" rows="10" style="width:100px;"><?php echo $field_value; ?></textarea>
<script>
        CKEDITOR.replace( '<?php echo $field_name; ?>',{
        	allowedContent: true,
        	forcePasteAsPlainText:	true,
    		toolbar :
            [
                ['Source','-','-'],
    			['PasteFromWord','-', 'SpellChecker'],
    			['SelectAll','RemoveFormat'],
    			['ImageButton'],
    			['Bold','Italic','Underline','-','Subscript','Superscript'],
    			['NumberedList','BulletedList','-','Blockquote'],
    			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    			['Link','Unlink','Anchor'],
    			['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak','Format','Font','FontSize','TextColor','BGColor']
            ],
    		
            filebrowserBrowseUrl : '<?php echo admin_skin();?>js/ckfinder/ckfinder.html',
    		filebrowserImageBrowseUrl : '<?php echo admin_skin();?>js/ckfinder/ckfinder.html?Type=Images',
    		filebrowserFlashBrowseUrl : '<?php echo admin_skin();?>js/ckfinder/ckfinder.html?Type=Flash',
    		filebrowserUploadUrl : '<?php echo admin_skin();?>js/ckfinder/connector/php/connector.php?command=QuickUpload&type=Files',
    		filebrowserImageUploadUrl : '<?php admin_skin();?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    		filebrowserFlashUploadUrl : '<?php admin_skin();?>js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    		skin:'moono'
    			} );
</script>