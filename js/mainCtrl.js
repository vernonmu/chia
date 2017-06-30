angular.module('app').controller('mainCtrl', function($scope, mainSrv) {
  $scope.test = 'hi!'

  $scope.isActive = false

  // checkbox button function
  $scope.activeButton = function(event, consultant){
    console.log(consultant);
    if ($(event.target).hasClass('text-success')) {
      $(event.target).removeClass('text-success')
      consultant.isCheckedIn = 0
    }

    else {
      $(event.target).addClass('text-success')
      consultant.isCheckedIn = 1
    }
  }

  // get events for events view
  $scope.getEvents = function() {
    mainSrv.getEvents()
    .then(function(response) {
      console.log(response);
      $scope.events = response.data
    })
  }

  $scope.getEvents()

  // $scope.getConsultants = function() {
  //   mainSrv.getConsultants()
  //   .then(function(response){
  //     console.log(response)
  //   })
  // }
  //
  // $scope.getConsultants()


})
