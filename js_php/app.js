var app = angular.module("FileBank",['ngRoute','ui.bootstrap', 'ngCookies', 'angularFileUpload']);

app.controller("LogInController", function($http, $scope, $modal, $log, $location, $cookieStore) {
	var a = this;
	$scope.loginData = {};
	this.login = function() {
		/*$http.get('http://localhost/filebank/server.php?email='+a.info.email+'and pass='+a.info.pass)
			.success(function(data) {
				alert("Log in success");
				window.location = "#/welcome";
			})
			.error(function() {
				alert("error");
			})
		;*/
		
		$http({
		method: 'GET',
		url: 'js_php/server.php',
		params: {email: $scope.loginData.email, pass: $scope.loginData.pass}
		})
		.success(function(data) {
			//window.location = "http://192.168.1.131/FileBank_Final/js_php/server.php?email="+$scope.loginData.username+"&pass="+$scope.loginData.password;
			//window.location = "#/home";
			$cookieStore.put('usernum', data[0][0]);
			$cookieStore.put('name', data[0][1]);
			$cookieStore.put('email', data[0][2]);
			$cookieStore.put('password', data[0][3]);
			$cookieStore.put('hasUser', true);
			$cookieStore.put('location', 'Home');
			$location.path("/home");
			
		})
		.error(function() {
			alert("error");
		})
		;
	};
	
	$scope.items = ['item1', 'item2', 'item3'];

	this.open = function (size) {

		var modalInstance = $modal.open({
		  templateUrl: 'myModalContent.html',
		  controller: 'ModalInstanceCtrl',
		  size: size,
		  resolve: {
			items: function () {
			  return $scope.items;
			}
		  }
		});

		modalInstance.result.then(function (selectedItem) {
		  $scope.selected = selectedItem;
		}, function () {
		  $log.info('Modal dismissed at: ' + new Date());
		});
	  };
});

app.controller('ModalInstanceCtrl', function ($scope, $modalInstance, $http) {

  $scope.info = {};

  $scope.ok = function () {
    //$modalInstance.close($scope.selected.item);
	$http.post('js_php/server.php', {name: $scope.info.name, email: $scope.info.email, pass: $scope.info.pass})
		.success(function(data) {
			alert("Sign up successful");
		})
		.error(function(data) {
			alert(data);
		});
	$modalInstance.dismiss('signUp');
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

app.controller('AccountCtrl', function($scope, $modal, $cookieStore, $location, $http) {
	$scope.New;
	$scope.files = {};
	$scope.info = $cookieStore;
	
	$scope.signOut = function() {
		alert("Sign out");
		//window.location = "#/";
		$scope.info = "";
		$cookieStore.remove('usernum');
		$cookieStore.remove('name');
		$cookieStore.remove('email');
		$cookieStore.remove('password');
		$cookieStore.put('hasUser', false);
		$location.path("/");
	};
	
	$scope.newFolder = function (size) {
		var modalInstance = $modal.open({
		  templateUrl: 'NewFolderModal.html',
		  controller: 'NewFolderCtrl',
		  size: size,
		  resolve: {
			items: function () {
			  return $scope.items;
			}
		  }
		});
	  };
	
	$scope.newFile = function (size) {
		var modalInstance = $modal.open({
		  templateUrl: 'NewFileModal.html',
		  controller: 'NewFileCtrl',
		  size: size,
		  resolve: {
			items: function () {
			  return $scope.items;
			}
		  }
		});
	};
	
	$scope.save = function() {
		if($scope.New.curPass == $cookieStore.get('password')) {
			if($scope.New.newPass != null) {
				if($scope.New.newPass == $scope.New.verPass) {
					$http.put('js_php/fileServer.php', {usernum: $cookieStore.get('usernum'), name: $scope.New.name, pass: $scope.New.newPass})
						.success(function(data) {
							alert($scope.info.fileName);
							$route.reload();
						})
						.error(function(data) {
							alert(data);
						});
				}
			} else {
				$http.put('js_php/fileServer.php', {usernum: $cookieStore.get('usernum'), name: $scope.New.name, pass: $cookieStore.get('password')})
						.success(function(data) {
							alert($scope.info.fileName);
							$route.reload();
						})
						.error(function(data) {
							alert(data);
						});
			}
		}
	};
});

app.controller('NewFolderCtrl', function ($scope, $modalInstance, $http, $route, $cookieStore) {
	//$scope.info.usernum = $cookieStore.get('usernum');
	//alert($scope.info.usernum);
	//$scope.info.folderName = "";
	//$scope.info = {};

	$scope.ok = function () {
    //$modalInstance.close($scope.selected.item);
	$http.post('js_php/fileServer.php', {usernum: $cookieStore.get('usernum'), filename: $scope.info.folderName, type: "folder", dateModif: new Date(), location: "home", isFolder: 1})
		.success(function(data) {
			$route.reload();
		})
		.error(function(data) {
			alert(data);
		});
	$modalInstance.dismiss('folder created');
	};

	$scope.cancel = function () {
		$modalInstance.dismiss('cancel');
	};
});

app.controller('NewFileCtrl', function ($scope, $modalInstance, $http, $cookieStore, $route, $upload) {
	$scope.info = {};
  //$scope.info.fileName = "";
	//$scope.info.usernum = $cookieStore.get('usernum');
	//$scope.ok = function () {
		//alert($scope.info.fileName);
    //$modalInstance.close($scope.selected.item);
		/*$http.post('js_php/fileServer.php', {usernum: $cookieStore.get('usernum'), filename: $scope.info.fileName, type: "file", dateModif: new Date(), location: "home", isFolder: 0})
			.success(function(data) {
				alert($scope.info.fileName);
				$route.reload();
			})
			.error(function(data) {
				alert(data);
			});*/
		$scope.$watch('files', function () {
			$scope.upload($scope.files);
		});
		
		$scope.upload = function (files) {
        if (files && files.length) {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                $upload.upload({
                    url: 'js_php/fileServer.php',
					method: 'POST',
                    fields: {usernum: $cookieStore.get('usernum'), location: $cookieStore.get('location'), isFolder: 0},
                    file: file
                }).progress(function (evt) {
                    //var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
					$scope.per = parseInt(100.0 * evt.loaded / evt.total);
                    //console.log('progress: ' + progressPercentage + '% ' + evt.config.file.name);
                }).success(function (data, status, headers, config) {
                    //console.log('file ' + config.file.name + 'uploaded. Response: ' + data);
					//alert(data);
                });
            }
        }
		};
		$modalInstance.dismiss('folder created');
	//};

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

app.controller('FileCtrl', function($scope, $http, $cookieStore, $route) {
	$scope.files = {};

	$http({
		method: 'GET',
		url: 'js_php/fileServer.php',
		params: {usernum: $cookieStore.get('usernum'), location: $cookieStore.get('location')}
		})
		.success(function(data) {
			//alert("Log In Success!");
			//UserInfo.setInfo(data[0][0], data[0][1], data[0][2], data[0][3]);
			//window.location = "http://192.168.1.131/FileBank_Final/js_php/server.php?email="+$scope.loginData.username+"&pass="+$scope.loginData.password;
			//window.location = "#/home";
			$scope.files =  data;
		})
		.error(function(data) {
			//alert(data);
		})
	;
	
	$scope.backDir = function() {
		var dir = $cookieStore.get('location');
		var i;
		for(i = dir.length; i > 0; i--) {
			if(dir.charAt(i) == '/') {
				break;
			}
		}
		
		//$scope.changeDir(dir.slice(0,i));
		$cookieStore.put('location', dir.slice(0,i));
		$route.reload();
	};
	
	$scope.changeDir = function(newDir) {
		//alert(newDir);
		$cookieStore.put('location', $cookieStore.get('location')+"/"+newDir);
		$route.reload();
	};
});

/*app.service('UserInfo', function() {
	var user = {};
	
	return {
		setInfo : function(usernum, name, email, password) {
			user.usernum = usernum;
			user.name = name;
			user.email = email;
			user.password = password;
			user.hasUser = true;
		},
		getInfo : function() {
			return user;
		},
		removeInfo : function() {
			user = {};
		}
	};
});*/
	
app.config(function($routeProvider) {
  $routeProvider
    .when('/', {
      templateUrl: 'html/homepage.php'
    })
    .when('/home', {
      templateUrl: 'html/home.php'
    })
	.when('/home/account', {
      templateUrl: 'html/account.html'
    })
	.otherwise ({
		redirectTo: '/404'
	})
});