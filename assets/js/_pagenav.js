//Adapted from http://jasalguero.com/ledld/development/web/expandable-list/
/**************************************************************/
/* Prepares the cv to be dynamically expandable/collapsible   */
/**************************************************************/
$(function prepareList() {
	$('#pagenav').find('li:has(ul)').unbind('click').click(function(event) {
		if(this === event.target) {
			$(this).toggleClass('expanded');
			$(this).children('ul').toggle('medium');
		}
		return false;
	}).addClass('collapsed').removeClass('expanded').children('ul').hide();

        //Expand current page
        $('#pagenav').find('.current_page_ancestor').addClass('expanded');
        $('#pagenav').find('.current_page_ancestor').parent().show('medium');
        $('#pagenav').find('.current_page_item').parent().show('medium');
        if ($('#pagenav').find('.current_page_item').children('ul').length > 0) {
            $('#pagenav').find('.current_page_item').addClass('expanded');
            $('#pagenav').find('.current_page_item').children().show('medium');
        }
 
	//Hack to add links inside the cv
	$('#pagenav a').unbind('click').click(function() {
		window.open($(this).attr('href'), '_self');
		return false;
	});
	//Create the button functionality
	$('#expandList').unbind('click').click(function() {
		$('.collapsed').addClass('expanded');
		$('.collapsed').children().show('medium');
	});
	$('#collapseList').unbind('click').click(function() {
		$('.collapsed').removeClass('expanded');
		$('.collapsed').children().hide('medium');
	});
});


/**************************************************************/
/* Functions to execute on loading the document               */
/**************************************************************/
$(document).ready( function() {
    prepareList();
});