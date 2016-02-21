$(document).ready(function(){
	if($('.datepicker').length > 0) {
		$('.datepicker').datetimepicker({
			format: 'DD MMM YYYY'
		});
	}

	$('.clear-form').on('click', function() {
		$formId = $(this).closest('form').attr('id');
		$clearingClass = $(this).data('clearing-class');
		$(":input."+$clearingClass, "#"+$formId).not(':button, :submit, :reset, :hidden').val('').removeAttr('checked').removeAttr('selected');
	});
	
	$(".btn-user-note-edit").click(function () {
		if ($(".form-user-note-edit").length > 0) {
			$(".form-user-note-edit #UserNoteId").val($(this).data('id'));
			$(".form-user-note-edit #UserNoteSummary").val($(this).data('summary'));
			$(".form-user-note-edit #UserNoteDescription").val($(this).data('description'));
			return false;
		}
	});
	
	$(".form-user-note-edit button[data-type='reset']").click(function () {
		$(".form-user-note-edit #UserNoteId").val('');
		$(".form-user-note-edit #UserNoteSummary").val('');
		$(".form-user-note-edit #UserNoteDescription").val('');
		return false;
	});
	
	if($('#bottom-shade .alert:not(#cookies-alert)').length > 0){
		animBottomMargin();
		$('#bottom-shade .alert:not(#cookies-alert)').addClass('timed-from-start');
		setTimeout(function() {
			$('#bottom-shade .alert.timed-from-start').remove();
			animBottomMargin();
		}, 7500);
	}
	$('#bottom-shade').on('click', '.alert .close', function(e){
		var closingElem = $(e.currentTarget).closest('.alert');
		// the folllowing line is different than animBottomMargin();
		$('#container').animate({paddingBottom: $('#bottom-shade').outerHeight()-closingElem.outerHeight() + parseInt($('#bottom-shade').css('marginBottom').replace('px', '')) +'px'}, 500);
	});
	
	if($( "ul.main-nav" ).length > 0){
		
		// mouse events
		$('.main-nav > li.custom').mouseover(function(){	$('ul.main-nav').addClass('attached');});
		$('.main-nav > li:not(.custom) > a, #header').mouseover(function(){	$('ul.main-nav').removeClass('attached');});
		$('.main-nav > li.custom > a + ul').mouseleave(function(){	$('ul.main-nav').removeClass('attached');});
		$('.main-nav li.custom, .main-nav li.custom').mouseout(function(){	$('ul.main-nav').removeClass('attached');});
		
		//scrolldown fixing to the top
		var view = $(window);
		var placeholder = $( ".main-nav" );
		var placeholderInitialTop = placeholder.offset().top;
		view.bind("scroll", function(){
			var viewTop = view.scrollTop();
			if ((viewTop > placeholderInitialTop)){
				placeholder.addClass('scrolled');
				$('.go-to-top').show();
				$('#flashMessage').addClass('scrolled');
			}else{
				placeholder.removeClass('scrolled');
				$('.go-to-top').hide();
				$('#flashMessage').removeClass('scrolled');
			}
		});
	}
	if($('.go-to-top')){
		$('.go-to-top').click(function(){
			$('html,body').animate({ scrollTop: 0}, "slow");
		});
	}

	if (!empty($(".redactor"))) {
		$(".redactor").redactor({
			minHeight: 300, // pixels
			replaceDivs: false,
	        paragraphize: false,
	        removeEmpty: ['strong', 'em', 'span', 'p']
		});
	}

	/* nicEditors.allTextAreas(
		{
			iconsPath : '/js/nicedit/nicEditorIcons.gif',
			fullPanel : true,
		}
	); */

	// $('.datatable').DataTable();
});

/***** Functions *****/

function empty(mixed_var) {
	// Checks if the argument variable is empty
	// undefined, null, false, number 0, empty string,
	// string "0", objects without properties and empty arrays
	// are considered empty
	var key, i, len;
	var emptyValues = [undefined, null, false, 0, "", "0"];
	
	for (i = 0, len = emptyValues.length; i < len; i++) {
		if (mixed_var === emptyValues[i]) {
			return true;
		}
	}
	return false;
}

function animBottomMargin(){
	$('#container').animate({paddingBottom: $('#bottom-shade').outerHeight() + parseInt($('#bottom-shade').css('marginBottom').replace('px', '')) +'px'}, 500);
}