angular.module('app', ['ui.router'])
.config(function($urlRouterProvider, $stateProvider) {
  $stateProvider
  .state('home', {
    templateUrl: 'views/home.html',
    url: '/'
    //, controller: 'mainCtrl'
  })
  .state('events', {
    templateUrl: 'views/events.html',
    url: '/events'
  })
  .state('consultants', {
    templateUrl: 'views/consultants.html',
    url: '/consultants'
  })
  .state('checkin', {
    templateUrl: 'views/checkin.html',
    url: '/checkin'
  })
  .state('event', {
    url: '/event/:event',
    templateUrl: '../views/event.html',
    controller: 'eventPagesCtrl'
  })

  $urlRouterProvider.otherwise('/')
})
