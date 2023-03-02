(function(_, $) {
    $.ceEvent('on', 'ce.commoninit', function(context) {		
       setTimeout(function(){
			$("[name='user_data[s_city]']").autocomplete({
				source: function( request, response ) {
					var type = this.element.attr('name').substr(10,1);
					cosc_getRusCities(type, request, response);
				}
			});
			$("[name='user_data[b_city]']").autocomplete({
				source: function( request, response ) {
					var type = this.element.attr('name').substr(10,1);
					cosc_getRusCities(type, request, response);
				}
			});
	   }, 100);	   
	   function cosc_getRusCities(type, request, response) {
            var check_country = $("[name='user_data[" + type + "_country]']").length ? $("[name='user_data[" + type + "_country]']").val() : '';
            var check_state = $("[name='user_data[" + type + "_state]']").length ? $("[name='user_data[" + type + "_state]']").val() : '';

            $.ceAjax('request', fn_url('city.autocomplete_city?q=' + encodeURIComponent(request.term) + '&check_state=' + check_state + '&check_country=' + check_country), {
                callback: function(data) {
                    response(data.autocomplete);
                }
            });
        }
    });
}(Tygh, Tygh.$));

$(document).on('click', '.ui-autocomplete .ui-menu-item', function(){
	setTimeout(function(){
		fn_cs_update_profile(0, true);	 
	}, 100);
	
});
