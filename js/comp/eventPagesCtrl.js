angular.module('app').controller('eventPagesCtrl', function($scope, $stateParams, $state, mainSrv) {

  mainSrv.getEvents()
  .then(function(response) {
    var eventData = response.data
    var eventPages = function() {
      for (var i = 0; i < eventData.length; i++) {
        if ($state.params.event == eventData[i].event) {
          $scope.eventDetails = eventData[i]
        }
      }
    }
    eventPages()
  })
})
