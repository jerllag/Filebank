<div ng-controller="AccountCtrl">
	<div ng-show="info.get('hasUser')">
	<div class="navbar navbar-fixed-top">
			<div class="container">
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<button class="navbar-toggle" id="navbarFront" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			
				
				<a class="navbar-brand" href="#/home"><img src="images/namesmall.png" class="img-responsive"></a>
				<div class="nav-collapse collapse navbar-responsive-collapse">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="#/home">Home</a>
						</li>                            
					</ul>
					
					
					<ul class="nav navbar-nav pull-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> My Account <strong class="caret"></strong></a>
							
							<ul class="dropdown-menu">
								<li>
									<a href="#/home/account"><span class="glyphicon glyphicon-refresh"></span> Account</a>
								</li>
								
								<li class="divider"></li>
								
								<li>
									<a ng-click="signOut()"<span class="glyphicon glyphicon-off"></span> Sign out</a>
								</li>
							</ul>
						</li>
					</ul><!-- end nav pull-right -->
				</div><!-- end nav-collapse -->
			
			</div><!-- end container -->
	</div><!-- end navbar -->
	
		<div class="container" ng-controller="FileCtrl">
		<div class="row">
			<form class="form-inline">
				<div class="form-group" id="searchPanel">
					 
				<div class="col-lg-1">
					<img src="images/logopngsmall.png" class="img-responsive">
				</div>  
						
						<div class="col-lg-4" id="path">
							<h4>Filebank/{{info.get('location')}}</h4>
						</div>  
						
						<div class="col-lg-4" id="activityMargin">
							<a ng-click="newFile()" id="activity"><span class="glyphicon glyphicon-upload" ></span> Upload</a>
							<a ng-click="newFolder()" id="activity"><span class="glyphicon glyphicon-folder-open"></span> New Folder</a>
							<a ng-click="del()" id="activity"><span class="glyphicon glyphicon-trash"></span> Delete</a>
						</div>  
						
						<div class="col-lg-3">
							<form class="navbar-form pull-right" novalidate>
								<input type="text" class="form-control" placeholder="File Bank" id="searchInput" ng-model="search.filename" required>
								<button ng-click="search()" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>                            
							</form><!-- end navbar-form -->
						</div>
						
					</div>
				</form>
			</div><!-- end row -->
			<hr>
			<div class="row">
			
				<!-- start of body -->
				<div class="col-lg-10">
					<div class="table">
						<table class="table table-striped">
							<tr id="sorting">
								<th class="col-lg-1" ng-show="deleted==1"></th>
								<th><a href="#" class="col-lg-5" id="sortingElements">Name</a></th>
								<th><a href="#" class="col-lg-2" id="sortingElements">Type</a></th>
								<th><a href="#" class="col-lg-2" id="sortingElements">Modified</a></th>
							</tr>
							<td class="col-lg-1" ng-show="deleted==1&&!info.get('location')=='Home'">asd</td>
							<td class="col-lg-5" id="tableElements" ng-hide="info.get('location')=='Home'"><a ng-click="backDir()">...</a></td>
							<td class="col-lg-2" id="tableElements" ng-hide="info.get('location')=='Home'"></td>
							<td class="col-lg-2" id="tableElements" ng-hide="info.get('location')=='Home'"></td>
							<tr ng-repeat="file in files">
								<td class="col-lg-1" id="tableElements" ng-show="deleted==1"><input type="checkbox"></td>
								<td class="col-lg-5" id="tableElements" ng-show="file.isFolder==1"><a ng-click="changeDir(file.filename)">{{file.filename}}</a></td>
								<td class="col-lg-5" id="tableElements" ng-show="file.isFolder==0"><a href="js_php/fileDownload.php?filename={{file.filename}}&filetype={{file.type}}&location={{file.location}}&usernum={{info.get('usernum')}}">{{file.filename}}</td>
								<td class="col-lg-2" id="tableElements">{{file.type}}</td>
								<td class="col-lg-2" id="tableElements">{{file.dateModif}}</td>
							</tr>
							<!--<tr>
								<td class="col-lg-6" id="tableElements">{{user.usernum}}</td>
								<td class="col-lg-2" id="tableElements">jpg</td>
								<td class="col-lg-2" id="tableElements">4/5/2015</td>
							</tr>
							
							<tr>
								<td class="col-lg-6" id="tableElements">Document1</td>
								<td class="col-lg-2" id="tableElements">docx</td>
								<td class="col-lg-2" id="tableElements">1/3/2015</td>
							</tr>
							
							<tr>
								<td class="col-lg-6" id="tableElements">Video1</td>
								<td class="col-lg-2" id="tableElements">mp4</td>
								<td class="col-lg-2" id="tableElements">12/26/2014</td>
							</tr>
							
							<tr>
								<td class="col-lg-6" id="tableElements">Document2</td>
								<td class="col-lg-2" id="tableElements">docx</td>
								<td class="col-lg-2" id="tableElements">11/12/2014</td>
							</tr>
							
							<tr>
								<td class="col-lg-6" id="tableElements">Video2</td>
								<td class="col-lg-2" id="tableElements">mp4</td>
								<td class="col-lg-2" id="tableElements">6/23/2014</td>
							</tr>-->
							
						</table>
					 </div>
				</div><!-- col-lg-6 -->
				
				
				<!-- end of body -->
				
				
				<!-- start of leftnavbar -->
				<div class="col-lg-2">
					
					<div class="list-group pull-right">
						<a href="#" class="list-group-item">
							<span class="glyphicon glyphicon-file"></span> Documents <span class="badge">{{divide.app}}</span>
						</a>
						<a href="#" class="list-group-item">
							<span class="glyphicon glyphicon-picture"></span> Images <span class="badge">{{divide.image}}</span>
						</a>
						<a href="#" class="list-group-item">
							<span class="glyphicon glyphicon-film"></span> Videos <span class="badge">{{divide.vid}}</span>
						</a>
						<a href="#" class="list-group-item">
							<span class="glyphicon glyphicon-briefcase"></span> Others <span class="badge">{{divide.others}}</span>
						</a>
					</div>
					
				</div>  
				
			</div><!-- end row -->
				
	  
	</div><!-- end container -->
	</div>
								<div>
									<script type="text/ng-template" id="NewFolderModal.html">
										<div class="modal-header">
											<button class="close" ng-click="cancel()">&times;</button>
											<h4 class="modal-title">New Folder</h4>
										</div>
										<div class="modal-body">
										   <form class="form-horizontal">
												<div class="form-group">
													<label class="col-lg-3 control-label" for="inputName">Folder Name</label>
													<div class="col-lg-9">
														<input class="form-control" id="inputName" placeholder="Name" type="text" ng-model="info.folderName">
													</div>
												</div>
											</form>
										</div><!-- end modal-body -->
										<div class="modal-footer">
											<button class="btn btn-default" ng-click="cancel()">Close</button>
											<button class="btn btn-primary" ng-click="ok()">Save</button>
										</div>
									</script>
								</div>
								
								<div>
									<script type="text/ng-template" id="NewFileModal.html">
										<div class="modal-header">
											<button class="close" ng-click="cancel()">&times;</button>
											<h4 class="modal-title">Upload</h4>
										</div>
										<div class="modal-body">
										   <form class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-lg-3 control-label" for="inputName">File</label>
													<div class="col-lg-9">
														<!--<input class="form-control" id="inputName" placeholder="Name" type="file" name="image" ng-model="info.fileName">-->
														<div class="form-control" ng-file-select ng-model="files">Upload</div>
													</div>
													<div class="col-lg-12" ng-show="per!=null">
														{{per+"%"}}
													</div>
												</div>
											</form>
										</div><!-- end modal-body -->
										<div class="modal-footer">
											<button class="btn btn-primary" ng-click="cancel()">Done</button>
										</div>
									</script>
								</div>
	<!--<div ng-show="!info.get('hasUser')">
		<input type="hidden" ng-init="signOut()"></input>
	</div>-->
</div>