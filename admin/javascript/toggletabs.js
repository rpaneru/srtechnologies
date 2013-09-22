
$(document).ready(function() {
	$('.tabContainer .tabList div').click(function() {
		$(this).parent('.tabList').find('div').removeClass('panelButtonOn').addClass('panelButtonOff');
		$(this).parents('.tabContainer').find('.panel .panelBox').hide();
		$(this).removeClass('panelButtonOff').addClass('panelButtonOn');
		$(this).parents('.tabContainer').find('.panel #'+this.id+'Panel.panelBox').show();
		$(this).find('a').blur();
		return false;
	});
});