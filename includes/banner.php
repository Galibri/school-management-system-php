<div class="page-banner section-padding text-center text-light about-banner-bg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="display-table page-banner-min-height">
					<div class="display-table-cell">
						<?php
							$pageName = pathinfo(basename($_SERVER['SCRIPT_NAME']), PATHINFO_FILENAME);
							$capitalizePageName = strtoupper($pageName);
							echo "<h3>$capitalizePageName</h3>"
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>