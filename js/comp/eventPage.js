angular.module('app').component('eventPage', {
  templateUrl:'/views/eventpage.html',
  controller: function($scope, $stateParams, mainSrv) {
    var ctrl = this
    ctrl.eventName = $stateParams.event

    mainSrv.getEventByName($stateParams.event)
    .then(function(response){
      // console.log(response);
      ctrl.eventPageData = response[0]
      // console.log(ctrl.eventPageData);
    })

    $scope.activeButton = function(event, person){
      console.log(person);
      if ($(event.target).hasClass('text-success')) {
        $(event.target).removeClass('text-success')
        person.isCheckedIn = 0
      }

      else {
        $(event.target).addClass('text-success')
        person.isCheckedIn = 1
      }

      var updateRecord = function(person) {
        mainSrv.checkinConsultant(person)
        // .then(function(response){
        //   return response
        // })
      }

      updateRecord(person)

    }


  }

})
