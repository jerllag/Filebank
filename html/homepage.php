<div class="container" id="main">
        	<div class="row">
                <div class="col-sm-6" id="logo">
                	<img src="images/logo3.png" class="img-responsive">
                </div>
                
                
                <div class="col-sm-6">
                	<div class="col-sm-7" id="nameFileBank">
                		<img src="images/name.png" class="img-responsive">
                	</div><!-- end nameFileBank -->
                    
                    <div class="panel" id="textfields"> 
                        <div class="panel-heading" id="panelField">
                            <h3 class="panel-title">Log In</h3>
                        </div><!-- end panel-heading -->
                        
                        <form class="form-horizontal" ng-controller="LogInController as liCtrl" novalidate>
                            <div class="form-group">
                                <label class="col-lg-3 control-label" id="inputLabel">Email</label>
                                <div class="col-lg-7">
                                    <input class="form-control input-sm" id="inputInfo" placeholder="Email" type="email" ng-model="loginData.email" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-3 control-label" id="inputLabel">Password</label>
                                    <div class="col-lg-7">
                                        <input class="form-control" id="inputInfo" placeholder="Password" type="password" ng-model="loginData.pass" required>
                                    </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-lg-10">
                                    <input class="btn btn-primary pull-right" type="submit" ng-click="liCtrl.login()" value="Log In"></input>
                                    <button class="btn btn-info pull-right" ng-click="liCtrl.open()">Sign Up</button>
                                    
                                    <div>
										<script type="text/ng-template" id="myModalContent.html">
										<div class="modal-header">
											<button class="close" ng-click="cancel()">&times;</button>
											<h4 class="modal-title">Register</h4>
										</div>
										<div class="modal-body">
										   <form class="form-horizontal" novalidate>
												<div class="form-group">
													<label class="col-lg-2 control-label" for="inputName">Name</label>
													<div class="col-lg-10">
														<input class="form-control" id="inputName" placeholder="Name" type="text" ng-model="info.name" required>
													</div>
												</div>
																						
												<div class="form-group">
													<label class="col-lg-2 control-label" for="inputEmail">Email</label>
													<div class="col-lg-10">
														<input class="form-control" id="inputEmail" placeholder="Email" type="email" ng-model="info.email" required>
													</div>
												</div>
																						
												<div class="form-group">
													<label class="col-lg-2 control-label" id="inputLabel">Password</label>
													<div class="col-lg-10">
														<input class="form-control" id="inputInfo" placeholder="Password" type="password" ng-model="info.pass" required>
													</div>
												</div>
											</form>
										</div><!-- end modal-body -->
										<div class="modal-footer">
											<button class="btn btn-default" ng-click="cancel()">Close</button>
											<button class="btn btn-primary" ng-click="ok()">Sign Up</button>
										</div>
									</script>
								</div>
                                    
                                </div>
                            </div>
                       </form>
                    </div><!-- end panel -->
            	</div><!-- end col2 -->
         	</div><!-- end row -->
            
            
        </div><!-- end container -->
        
        <div class="container">
        	<div class="row" id="description">
            	<div class="col-6">
					<h2><u>On the Go</h2></u>
					<p class="lead">You can always use your FileBank with any of your devices. From your smartphones, to your tablets and computers. You can store and edit your files anywhere you go.</p>
				</div><!-- end col-6 -->
                
                <div class="col-6" align="left">
                	<img src="images/on the go 3d.png" class="img-responsive">
				</div><!-- end col-6 -->
            </div><!-- end row -->
            
            <div class="row" id="description">
            	<div class="col-6" align="right">
                	<img src="images/Enriching Memories.png" class="img-responsive">
				</div><!-- end col-6 -->
                
                <div class="col-6" align="right">
					<h2><u>Enriching Memories</h2></u>
					<p class="lead">Truly, it is cherished. Use FileBank where it is capable of transferring photos, videos and other materials to your friends and loved ones. Keep those happy moments alive with FileBank.
</p>
				</div><!-- end col-6 -->
            </div><!-- end row -->
            
            <div class="row" id="description">
            	
                <div class="col-6">
					<h2><u>Too Cool for School</h2></u>
					<p class="lead">School projects, reviewers, research work and other stuffs. FileBank is an organized storage of work and Readables when you're at school. It is important when you have them while you're studying.
</p>
				</div><!-- end col-6 -->
                
                 <div class="col-6" align="left">
                	<img src="images/Too Cool for School.png" class="img-responsive">
				</div><!-- end col-6 -->
            </div><!-- end row -->
            
            <div class="row" id="description">
            	<div class="col-6" align="right">
                	<img src="images/Storage Savior.png" class="img-responsive">
				</div><!-- end col-6 -->
                
                <div class="col-6" align="right">
					<h2><u>Storage Savior</h2></u>
					<p class="lead">Talk about having a hero for your files. FileBank is your guard to privacy. It is safe and is an active protection for those who are trying to steal the great deal. Use FileBank to privatize your storage.

</p>
				</div><!-- end col-6 -->
            </div><!-- end row -->

        </div><!-- end container -->