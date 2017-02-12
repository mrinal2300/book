$.fn.exists = function(callback) {
    var args = [].slice.call(arguments, 1);

    if (this.length) {
        callback.call(this, args);
    }
    return this;
};

//select 2
$("#resourcesInput").exists(function() {
$("#resourcesInput").select2({
    theme: "bootstrap",
    placeholder: "Type your location",
    ajax: {
        url: "api/calendar/resources",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term,
                page: params.page
            };
        },
        processResults: function (result, params) {

			return {
				results: result.items,
				pagination: {
					more: (params.page * 30) < result.total_count
				}
			};


        },
        cache: false
    },
    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    minimumInputLength: 0,
    templateResult: formatProject, // omitted for brevity, see the source of this page
    templateSelection: formatProjectSelection, // omitted for brevity, see the source of this page
    placeholder: "Enter name",
	tokenSeparators: [",", " "],
});
});


$("#resourcesInput").select2.defaults.set('data', 'dddd');

$("#resourcesInput").on('change', function(e) {

var values = $(this).val().join(',');

console.log(values);

	$.ajax({
	type: "POST",
	url: '/api/calendar/update_calendar_resource',
	data: {'val': values},
	dataType: 'json'
	});


// $.post( "/api/calendar/update_calendar_resource", {'val': $(this).select2('data')}, function( data ) {
//   console.log( data );
// });

 
    

});


function formatProject (project) {
    //if (project.loading) return "searching...";
    return  project.name;
}

function formatProjectSelection (project) {
    return project.name;
}





var app = angular.module('booking', []);


app.controller('home', function($scope, $http) {
    //$scope.firstName = "John";
    //$scope.lastName = "Doe";


    $http({
			url: '/api/calendar/resources',
			dataType: 'json',
			method: 'GET',
		data: $scope.form,
		headers: {"Content-Type": "application/json"}
        }).success(function(response){
            $scope.resources = response;
        }).error(function(error){
            $scope.error = error;
        });




});




// app.directive('calDirective', function($http, $compile) {

//     var getTemplateUrl = function(field) {
//         return '/designer/'+field.type+'.html';
//     }

//     var linker = function(scope, element, attrs) {
//         // GET template content from path

//         var templateUrl = getTemplateUrl(scope.field);
//         $http.get(templateUrl).success(function(data) {
//             element.html(data);
//             $compile(element.contents())(scope);
//         });
//     }

//     return {
//         restrict: "EA",
//         scope: false,
//         link: linker,
//     };

// });