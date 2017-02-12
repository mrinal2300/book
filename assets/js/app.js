var app = angular.module('booking', []);
app.controller('bookingForm', function($scope) {
    $scope.names = ["No repeat", "Daily", "Weekly", "Monthly", "Anually"];

});