# Eggplant Coding Test

We want to create an app that have one form where you can put a name, birthday, number of children and email, show it up in a table who can be sorted by name and email which must have a pagination of 15 elements.

It must be done with AngularJS and PHP without frameworks (I suppose PHP frameworks).

## What do you need

For running this application you will need a web server PHP captable (nginx with fmp or apache with php lib) a MySQL database (you will know and have a free database, user and password for this database).


## Instalation

A very easy one.

1. Copy all the files in an apropiate directory (it can be an alias or a host)

2. Open the php/databaseconfig.php file and let it with the appropiate data (host, user, password, database, the typical).

3. Clone the needed database included in sql/eggplant.sql, it means that the database you need is on this file.

4. Open the URL you will know :)

5. Nothing! It will work!.

## How it works

Because by need you must use AngularJS and must store all the data in a MySQL I have used some clean PHP where the AngularJS app will comunicate via JSON to extract and put the data into the MySQL database.

So, the application have two "faces":

- Backend. Where we use the PHP for connecting to the database and insert new items

- Frontend. Where we use the HTML/CSS/JS/AngularJS for all the rest

# File structure

The directory structure and little explanations about the files:

```
index.html > The application
README.md > This file
/css/base.css > The stylesheet of the app
/css/base.map.css > The mapping file of the CSS because they are made with SCSS
/img > not needed but I always put on my projects
/js/components/formComponent.js > The angularjs component for the form
/js/components/tableComponent.js > The angularjs component for showing the data
/js/storage/storageFactory.js > The storage of the items in a factory element
/js/thirdparty/dir-pagination.js > There's a lot of third party for pagination but I use this (dirPagination)
/php/databaseconfig.php > Where the database configuration relays
/php/getallitems.php > Returns all items of the database in JSON format
/php/insertitem.php > Insert an item into the database
/scss/base.scss > SCSS file for the styles
/sql/eggplant.sql > Database dump without content
```

## The coding

I have tried to use camelCase everywhere because it will help to read it. It works for the JS and the PHP, but for the PHP I have tried to use PSR too (https://www.php-fig.org/psr/). Standards will help you to continue this app if you will.

## The Data

Data is stored in the database in order to have the same data if you change from one web browser to another (see my idea of local storage below) but the consistency of the data is very low. There's no primary key or test if something is duplicated so the data on the database (if it's a real app) will be a mesh.

So it will be great if know the purpose of the data in order to, as I say, put a primary key in (don't know, for example the email address which will be "unique" for the data or for the name and the address -this will be better-) or create a more complex one with names (and surenames) separated from the other data (children, email) with some IDs (for example a user database with key name and surename chained with a userData table with all the data... I don't know... there's a lot of ways to do it depending on what must be the result). Whatever it's needed it's fundamental (on the first) create a structured way to store the data, because any changes on this will be "dangerous" if some adjust are needed after (data consistency, you know).

## The PHP

The best method to intercommunicate between a front and the back is in something common, for example, JSON format.

I have divided the backend application in three files, one for the configuration (that it's included on the others to connect to the database), one for getting all the items and other for insert an item into the database.

This, can be done in many several ways but the most easy (at the moment) it's a raw one. I.e. put the raw SQL inside every file.

Other way it's to create several functions that can be in separate files or not, that will do the insert or the select so you only call one URL with some parameter that it's the function.

Other way it's to create an object (not the connection object, but other object) that have several properties (host, name, user...) and some methods (for getting all the items and for inserting one).

Why I select to have separate and selfcontained files? Because at the begining with no complexity it's the best way to test (on my opinion) and to see what I have do. With separate files you can test if something works (or not).

So, the way I used to test it it's to take a look at the JSON that it returns. It will say if it's all ok or not when something can be directly called.

This is not a pure REST service or web service (and not a SOAP of course) but it can be upgraded to if needed.

All the code is commented so you will know what it does on every point.

## The AngularJS Components

There are two components, one storage and one third party module inclusion.

One component, one controller is for the form (formControler) and his work it's to take the date and transform it to something more appropriate for the MySQL.

The other have more logic (tableComponent). It shows the items, short them by name or email (propertyName) by ascending or descending (I alway use reverse as name, don't blame me for this).

The third is the most interesting one, the storage factory element (storageFactory). Yes, it's an storage so it must be a service or a factory. I prefer to use a factory than a service as a provider of this kind because it have no lag on initialization and it will not depend of others. If not, I will use a service.

On this "storage component" I have tried a new thing. The typical use of a factory or a service is to retrieve and store, and it will work fine. So, storing the data you can add/sort/delete/change or whatever you need as a trusted storage. But I have done other approach thanks that I like to try something new: use the local storage of the web client.

Yes, why not use the localStorage of the web client to save all the data?. It will have something very kind, persistence. I have not developed more this, but in the future, using the storage and, (why not), a service worker, you will minimize the backend petitions. But for now it's very simple. It loads from the database via the PHP and stores in the localStorage. If you add a new element it send to the database (for future or if you open in other browser), and save it to the localStorage too.

I knows this is a happy fart because it not needed but if someone likes to improve, there are :)

The last thing it's the use of an external module for pagination. You can create the logic of the pagination that will read the number of pages by dividing the number of items by the number of elements, create a variable that store the current page, modify the items you see putting from you need to you need on the list and compose something in the HTML that creates a simple pagination. But maybe it's good to know that I know how to use third party "things" (and it will save me from too much coding).

Ah! this can be done in so many several ways (for example one only component, use a service for interchanging data or only for doing the http petitions -a trust storage-, or three components -one for the form, other for the table and the last for the search- or two with the form and the table been the same component...) that it can be really infinite. I have selected this way (and the use of the localStorage) to show the basics.

Depending of the whole application different approach must be taken in order to help the integration with other components or whatever is needed. This approach it's easily upgradeable to a bigger form or to change some logic on the table thanks that I think the best is using what AngularJS had (the filters, the ordering way) and not to put the logic for doing it. If, for example, other filter is needed you can add the logic on the controller and put on the "view" (the html file) without no worries.

All the code is commented so you will know what it does on every point.

## HTML

I have used HTML5 because, well, it helps me in the inputs (on the forms) because it includes something very good, the required property. The required property will test if the input of an input it's ok or not and it will let do it by the browser, so you can relax and it's no need for more logic. And I have used the "new types" for the inputs that helps you transform your keyboard and let the user only put the proper on it. So, the use of the "form" tag and the required is a great way to pass this responsibility to the web client (but I test on the storage too, you know...).

I know if an old browser runs it, it will be a problem (yes, a problem) because you must use JS for testing it (and PHP too, of couse, always do double check!) but, as I say, it helps you to save time and on the test, you don't say that it must be compatible with old browsers (because Angular will fail too).

Using Bootstrap as a framework for the HTML helps to put the things in some order and to design rapidly a layout. That's why I have use it. But you can do without any framework or with other ones like Foundation, Bulma or whatever you want. Maybe using Bootstrap will show you that I know to use HTML frameworks too.

## CSS

The best and fast way to do it, it's using SCSS. So there's a SCSS file and his "compiled" one in CSS. On that way you can see that I know SCSS too.

And, using SCSS will help to integrate with a more large application thanks that you can import other CSS files and render/compile them together to see if there's errors or mistakes... and you can do some things dynamically by generating some mixins and functions :)

# More questions

If you have questions about it, please feel free to ask me.
