/*
 *	This is the main JS file for all things redactor. The WordPress variables are grabbed from
 *	wp_jsvars.php so I can get some WP variables available to this JS file to avoid ghetto echos.
 *	There's probably a better way to do this, but this was quick :\
 */

jQuery(document).ready(function($){

	// Grab some WP variables all ninja like
/*
	$.getScript('wp_vars.php').done(function(text, status){
		console.log(text);
	}).fail(function(){
		console.log('Uh oh... redactor editor failed to load!');
	});
*/

	// Bind redactor to "Edit" link
	$(action_selector).click(function(e){
		e.preventDefault();
		
		// Save or setup redactor for editing
		if($(action_selector).hasClass('save')){
			// Save routine
			$.post(redactorURL + '/wp_post.php', {
				id: postID,
				content: $(content_selector).html()
			}, function(data){
				//alert(data);
			});
			
			// Destroy editor
			$(content_selector).destroyEditor();
			
			// Toggle save class/text
			$(action_selector).removeClass('save').attr('title', 'Edit Post').text('Edit');
		}else{

			// Buttons
			var buttons = ['html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|', 'unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'media', 'mediavideo', 'file', 'table', 'link', '|', 'fontcolor', 'backcolor', '|', 'alignleft', 'aligncenter', 'alignright', 'justify', '|', 'horizontalrule']
			var airButtons = ['formatting', '|', 'bold', 'italic', 'deleted', '|', 'unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'fontcolor', 'backcolor'];

			// Editor
			$(content_selector).redactor({
				fixed: redactor_fixed_mode,
				wym: redactor_wym_mode,
				air: redactor_air_mode,
				lang: redactor_qtrans_mode,
				direction: redactor_direction_mode,
				buttons: buttons,
				buttonsCustom: {
					media: {
						title: 'Media',
						callback: function(obj, event, key){

							// Call WordPress media upload lightbox
							tb_show('', 'wp-admin/media-upload.php?type=image&amp;TB_iframe=true');

							// Override "insert into post" callback
							window.send_to_editor = function(html) {
								$(content_selector).insertHtml(html);
								imgurl = $('img', html).attr('src');
								tb_remove();
							}
						}
					},
					mediavideo: {
						title: 'Video',
						callback: function(obj, event, key){

							// Call WordPress media upload lightbox
							tb_show('', 'wp-admin/media-upload.php?type=image&amp;TB_iframe=true');

							// Override "insert into post" callback
							window.send_to_editor = function(html) {
								$(content_selector).insertHtml(html);
								imgurl = $('img', html).attr('src');
								tb_remove();
							}
						}
					}
				}
			});

			// If the top of the content area is below the fold, lets animate to it
			if($('body').scrollTop() < $(content_selector).offset().top || redactor_fixed_mode != true){
				$('html, body').animate({scrollTop: $(content_selector).offset().top - 60}, 800);
			}

			// Toggle save class/text
			$(action_selector).addClass('save').attr('title', 'Save Post').text('Save');
		}
	});

});