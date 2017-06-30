angular.module('app').service('mainSrv', function($http) {



  this.getEvents = function(){
    return $http.get('/api.php/checkin/getevents')
    .then(function(response){
      // console.log('finished loading events')
      return response
    })
  }

  this.getEventByName = function(name) {
    // console.log(name);
    return $http.get('/api.php/checkin/getconsultants?event=' + name)
    .then(function(response){
      var temp = response.data

      var x = 0
      var j = 0
      for (var i = 0; i < response.data.length; i++) {
        if (temp[i].isSpanish === 1) {
          // console.log(temp[i].givenName, temp[i].familyName)
          x++
          temp[i].spanishImg = 'https://upload.wikimedia.org/wikipedia/commons/d/d9/ES_Spanish_Language_Symbol_ISO_639-1_IETF_Language_Tag_Icon.png'
        }
        if (temp[i].isJapanese === 1) {
          // console.log(temp[i].givenName, temp[i].familyName)
          j++
          temp[i].jaImg = 'https://upload.wikimedia.org/wikipedia/commons/0/0f/Google_Japanese_Input_icon.png'
        }
      }
      console.log(x + ' spanish')
      // console.log(temp);
      console.log(j + ' japanese');
      return [temp]
    })
  }

  // this.getConsultants = function(){
  //   return $http.get('/api.php/checkin/getconsultants')
  //     .then(function(response){
  //       var temp = response.data
  //
  //       var x = 0;
  //       for (var i = 0; i < response.data.length; i++) {
  //         if (temp[i].isSpanish === 1) {
  //           console.log(temp[i].givenName, temp[i].familyName);
  //           x++
  //           temp[i].spanishImg = 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Pok%C3%A9_Ball_icon.svg/2000px-Pok%C3%A9_Ball_icon.svg.png'
  //           // console.log(temp[i]);
  //         }
  //       }
  //       console.log(x);
  //       return {temp}
  //     })
  //
  // }

  this.checkinConsultant = function(person) {
    console.log('we are here now');
    return $http.put('/api.php/checkin/updaterecord?id=' + person.id + '&isCheckedIn=' + person.isCheckedIn)
    .then(function(response){
      console.log(response);
      return response
    })
  }


})
