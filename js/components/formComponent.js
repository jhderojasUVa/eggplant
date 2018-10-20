// Form Component
// We add the Items service (the storage)
eggplantCoding.controller('formControler', function($scope, Items) {

  // When you add an item we use this function
  $scope.addItem = function(name, dateBird, numberChildren, email) {
    // Modify the date from the JS one to one who MySQL like most :)
    let day = '-'+ (dateBird.getDate());
    let month = '-'+ (dateBird.getMonth() +1);
    let year = dateBird.getFullYear();
    let dbDateBird = year + month + day;
    // Then add it!
    Items.addItem(name, dbDateBird, email, numberChildren);
  }
});
