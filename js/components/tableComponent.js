// Table component
eggplantCoding.controller('tableContoler', function($scope, Items) {

  // Take all the items from the factory
  items = Items.showAllItems();

  // Populate the items
  // This will help for the pagination too
  $scope.items = items;

  // For sorting we create
  // reverse to know if show in reverse order by default ASC
  // with wich it must be ordered, by default name
  $scope.reverse = false;
  $scope.propertyName = 'name';

  // This function will put in normal or reverse order depending on what
  // the user select
  $scope.sortBy = function(propertyName) {
    // It put the contraty of what reverse is
    $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
    // and sets the property scope to where you push
    $scope.propertyName = propertyName;
  };

});
