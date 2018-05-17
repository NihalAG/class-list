<?php 
error_reporting(E_ERROR | E_PARSE);
Class jsonObject{
    public $name;
	public $role;
}

$names = explode("\n", file_get_contents('nameList.txt'));
$roles = explode("\n", file_get_contents('roleList.txt'));
//print_r ($names);

$classData[] =  new jsonObject();

for ($index = 0; $index < count($names); $index++) {
 	$classData[$index]->name = str_replace("", '', $names[$index]);
 	$classData[$index]->role =str_replace("", '', $roles[$index]);
}
?>
<!doctype html>
<html lang="en" ng-app="classApp">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Search for Student IDs</title>

    <link rel="shortcut icon" href="https://getmdl.io/assets/favicon.png">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <style>
		.demo-ribbon {
		  width: 100%;
		  height: 40vh;
		  background-color: #3F51B5;
		  -webkit-flex-shrink: 0;
		  -ms-flex-negative: 0;
		  flex-shrink: 0;
		}

		.demo-main {
		  margin-top: -35vh;
		  -webkit-flex-shrink: 0;
		  -ms-flex-negative: 0;
		  flex-shrink: 0;
		}

		.demo-header .mdl-layout__header-row {
		  padding-left: 40px;
		}

		.demo-container {
		  max-width: 1600px;
		  width: calc(100% - 16px);
		  margin: 0 auto;
		}

		.demo-content {
		  border-radius: 2px;
		  padding: 80px 56px;
		  margin-bottom: 80px;
		}

		.demo-layout.is-small-screen .demo-content {
		  padding: 40px 28px;
		}

		.demo-content h3 {
		  margin-top: 48px;
		}

		.demo-footer {
		  padding-left: 40px;
		}

		.demo-footer .mdl-mini-footer--link-list a {
		  font-size: 13px;
		}
		.mdl-data-table{
		    width: 100%;
		}
		.mdl-data-table th{
			text-align: left;
		}
		.mdl-layout-title{
			text-align: center;
		}
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
      <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--grey-100 mdl-color-text--grey-800">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title">Search for Person in Class</span>
          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" ng-model='searchText' type="text" id="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
        </div>
      </header>
      <div class="demo-ribbon"></div>
      <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
          <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
          <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
          	<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  				<thead>
					<tr>
						<th>Last Name, First Name</th>
						<th>Role</th>
					</tr>
				</thead>
				<tbody ng-controller="populateClassList">
					<tr ng-repeat="(name,value) in items | filter:searchText">	
						<td class="mdl-data-table__cell--non-numeric">
							{{value.name}}
						</td>
						<td class="mdl-data-table__cell--non-numeric">
							{{value.role}}
						</td>
					</tr>
				</tbody>
			</table>
          </div>
        </div>
      </main>
    </div>

    <script type="text/javascript">
    	var app = angular.module('classApp' ,[]);

    	var jsonClassList = <?php 
    		$classData = json_encode($classData);
			print_r($classData);
    	?>
    	
    	function populateClassList($scope){
    		$scope.items = jsonClassList;
    	}

    	app.controller("MainCtrl", function($scope){});
    </script>
  </body>
</html>
