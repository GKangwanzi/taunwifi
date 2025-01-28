<?php

if ($_SESSION['role'] == 'admin' ) {
	echo '
	<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">Incident Reporting</div>
					<div class="menu-item">
						<a href="dash.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">Dashboard</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="incident.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-paperclip"></i></span>
							<span class="menu-text">Report Incident</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="evidences.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-hand-paper"></i></span>
							<span class="menu-text">Evidences</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="conflict-drivers.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-check-square"></i></span>
							<span class="menu-text">Conflict Drivers</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="risk-indicators.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-clipboard"></i></span>
							<span class="menu-text">Risk Indicators</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="responses.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-reply-all"></i></span>
							<span class="menu-text">Response Mechanisms</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="my-incidents.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-folder-open"></i></span>
							<span class="menu-text">Completed Incidents</span>
						</a>
					</div>

					<div class="menu-divider"></div>
					<div class="menu-header">Data & Users</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="fa fa-th-list"></i>
							</span>
							<span class="menu-text">Data</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="districts.php" class="menu-link">
									<span class="menu-text">Districts</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="subcounty.php" class="menu-link">
									<span class="menu-text">Sub County</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="parishes.php" class="menu-link">
									<span class="menu-text">Parishes</span> 
								</a>
							</div>
							<div class="menu-item">
								<a href="queries.php" class="menu-link">
									<span class="menu-text">Indicators</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="answers.php" class="menu-link">
									<span class="menu-text">Responses</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item">
						<a href="users.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-users"></i></span>
							<span class="menu-text">Users</span>
						</a>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="fa fa-chart-pie"></i>
							</span>
							<span class="menu-text">Reports</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="closed-incidents.php" class="menu-link">
									<span class="menu-text">Incident Report</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="cumulative.php" class="menu-link">
									<span class="menu-text">Cummulative</span>
								</a>
							</div>
						</div>
					</div>
					<div class="menu-item">
						<a href="profile.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-user"></i></span>
							<span class="menu-text">Profile</span>
						</a>
					</div>


					<div class="p-3 px-4 mt-auto hide-on-minified">
						<a href="https://creationsforumafrika.org" class="btn btn-secondary d-block w-100 fw-600 rounded-pill">
							<i class="fa fa-code-branch me-1 ms-n1 opacity-5"></i> Our Website
						</a>
					</div>
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
			
			<!-- BEGIN mobile-sidebar-backdrop -->
			<button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
			<!-- END mobile-sidebar-backdrop -->
		</div>
		<!-- END #sidebar -->

	';
}elseif($_SESSION['role'] == 'monitor'){
	echo '

	<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">Incident Reporting</div>
					<div class="menu-item">
						<a href="dash.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">Dashboard</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="incident.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-paperclip"></i></span>
							<span class="menu-text">Report Incident</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="evidences.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-hand-paper"></i></span>
							<span class="menu-text">Evidences</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="conflict-drivers.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-check-square"></i></span>
							<span class="menu-text">Conflict Drivers</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="risk-indicators.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-clipboard"></i></span>
							<span class="menu-text">Risk Indicators</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="responses.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-reply-all"></i></span>
							<span class="menu-text">Response Mechanisms</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="my-incidents.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-folder-open"></i></span>
							<span class="menu-text">Completed Incidents</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="users.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-users"></i></span>
							<span class="menu-text">Profile</span>
						</a>
					</div>
					<div class="menu-item has-sub">
						<a href="#" class="menu-link">
							<span class="menu-icon">
								<i class="fa fa-chart-pie"></i>
							</span>
							<span class="menu-text">Reports</span>
							<span class="menu-caret"><b class="caret"></b></span>
						</a>
						<div class="menu-submenu">
							<div class="menu-item">
								<a href="closed-incidents.php" class="menu-link">
									<span class="menu-text">Incident Report</span>
								</a>
							</div>
							<div class="menu-item">
								<a href="cumulative.php" class="menu-link">
									<span class="menu-text">Cummulative</span>
								</a>
							</div>
						</div>
					</div>

					<div class="menu-item">
						<a href="profile.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-user"></i></span>
							<span class="menu-text">Profile</span>
						</a>
					</div>


					<div class="p-3 px-4 mt-auto hide-on-minified">
						<a href="https://creationsforumafrika.org" class="btn btn-secondary d-block w-100 fw-600 rounded-pill">
							<i class="fa fa-code-branch me-1 ms-n1 opacity-5"></i> Our Website
						</a>
					</div>
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
			
			<!-- BEGIN mobile-sidebar-backdrop -->
			<button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
			<!-- END mobile-sidebar-backdrop -->
		</div>
		<!-- END #sidebar -->

	';
}elseif ($_SESSION['role'] == 'officer') {
	echo '

	<div id="sidebar" class="app-sidebar">
			<!-- BEGIN scrollbar -->
			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
				<!-- BEGIN menu -->
				<div class="menu">
					<div class="menu-header">Incident Reporting</div>
					<div class="menu-item">
						<a href="dash-o.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-laptop"></i></span>
							<span class="menu-text">Dashboard</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="incident.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-paperclip"></i></span>
							<span class="menu-text">Report Incident</span>
						</a>
					</div>
					<div class="menu-item">
						<a href="district-evidenses.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-hand-paper"></i></span>
							<span class="menu-text">Evidences</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="district-cdrivers.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-check-square"></i></span>
							<span class="menu-text">Conflict Drivers</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="district-risks.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-clipboard"></i></span>
							<span class="menu-text">Risk Indicators</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="district-responses.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-reply-all"></i></span>
							<span class="menu-text">Response Mechanisms</span>
						</a>
					</div>
					<hr/>
					<div class="menu-item">
						<a href="district-incidents.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-folder-open"></i></span>
							<span class="menu-text">Completed Incidents</span>
						</a>
					</div>

					<div class="menu-item">
						<a href="district-closed.php" class="menu-link">
							<span class="menu-icon"><i class="far fa-folder-open"></i></span>
							<span class="menu-text">Closed Incidents</span>
						</a>
					</div>


					<div class="menu-item">
						<a href="profile.php" class="menu-link">
							<span class="menu-icon"><i class="fa fa-user"></i></span>
							<span class="menu-text">Profile</span>
						</a>
					</div>


					<div class="p-3 px-4 mt-auto hide-on-minified">
						<a href="https://creationsforumafrika.org" class="btn btn-secondary d-block w-100 fw-600 rounded-pill">
							<i class="fa fa-code-branch me-1 ms-n1 opacity-5"></i> Our Website
						</a>
					</div>
				</div>
				<!-- END menu -->
			</div>
			<!-- END scrollbar -->
			
			<!-- BEGIN mobile-sidebar-backdrop -->
			<button class="app-sidebar-mobile-backdrop" data-dismiss="sidebar-mobile"></button>
			<!-- END mobile-sidebar-backdrop -->
		</div>
		<!-- END #sidebar -->

	';
}

?>