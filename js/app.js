(function(){
	var know__apps = [];
	jQuery('.know__forms__content').each(function(index, element){
		
		var server = jQuery(element).attr('data-know-server');
		var form_api_name = jQuery(element).attr('data-know-form-api-name');

		if(server && form_api_name){
			know__apps.push(new Vue({
				el: element,
				components: {
					'form-component': httpVueLoader(server + '/system/apps/forms/includes/vue_v2.php')
				},
				template : '<div><form-component :form-api-name="form_api_name" :show-header="false"></form-component></div>',
				data : function(){
					return {
						form_api_name : form_api_name
					};
				}
			}));
		}
		
	});
})();