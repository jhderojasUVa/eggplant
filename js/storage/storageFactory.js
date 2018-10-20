// This is for knowing the URL where you are runing the app
var documentRoot = window.location.href;

eggplantCoding.factory('Items', ['$http', function($http) {

  // The basic storage is an array where you will put
  // every item
  // So better I will take a different approach, use the localStorage of the
  // browser

  // First compose the url
  const getUrl = documentRoot + './php/getallitems.php';
  const putUrl = documentRoot + './php/insertitem.php';
  // Then make the get and insert into the browser storage
  $http({
          method: 'GET',
          url: getUrl
        })
        .then(function(response) {
          localStorage.setItem("items", JSON.stringify(response.data));
        });

  // Last create the array and transform the storage in an array
  // The storage array
  var Item = JSON.parse(localStorage.getItem("items"));

  return {
    addItem: function(name, dateBird, email, numberChildren) {
      // This method will insert into the database and add to the Items array

      // Let's check if the data is correct or at least name and email because
      // the others will the browser test them
      if (name !='' && email.includes("@")) {
        // First to the database, next to the array and last to the storage
        // Creating the data to send via http to the database
        let data =  {
          name: name,
          dateBird: dateBird,
          numberChildren: numberChildren,
          email: email
        };

        // The configuration for the http petition
        var config = {
          headers : {
              'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
          }
        };

        // And the petition :)
        $http.post(putUrl, JSON.stringify(data), config);

        // Next the array
        // We trust in HTML5 for knowing if name, email are valids thanks the required property
        Item.push({
          name: name,
          dateBird: dateBird,
          email: email,
          numberChildren: numberChildren
        });

        // After, we add to the storage
        localStorage.setItem("items", Item);
      }

      return Item;
    },
    showAllItems: function() {
      return Item;
    }
  }

}]);
