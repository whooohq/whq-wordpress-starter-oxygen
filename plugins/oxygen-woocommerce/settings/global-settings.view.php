		<?php 
	
		/**
		 * Manage > Settings > Global Styles > WooCommerce
		 */ 
		
		global $oxygen_toolbar;

		$oxygen_toolbar->settings_breadcrumbs(	
							__('WooCommerce','oxygen'),
							__('Global Styles','oxygen'),
							'default-styles',
							"hasOpenChildTabs('settings','woo')"); 

		$subsections = array("buttons" => __("Buttons","oxygen"),
							"links" => __("Links","oxygen"),
							"inputs" => __("Inputs","oxygen"),
							"text" => __("Text","oxygen"),
							"notifications" => __("Notifications","oxygen"),
							"misc" => __("Misc","oxygen"),
							"widgets" => __("Widgets","oxygen") 
						);

		foreach ($subsections as $subsection => $title) : ?>

			<div class="oxygen-sidebar-advanced-subtab" 
				ng-hide="<?php foreach($subsections as $subsection2 => $title2):?>isShowChildTab('settings','woo','<?php echo $subsection2 ?>')<?php if ($subsection2!="widgets") echo "||"; endforeach; ?>"
				ng-click="switchChildTab('settings', 'woo', '<?php echo $subsection ?>');">
				<img src="<?php echo CT_FW_URI; ?>/toolbar/UI/oxygen-icons/panelsection-icons/styles.svg">
				<?php echo $title; ?>
				<img src="<?php echo CT_FW_URI; ?>/toolbar/UI/oxygen-icons/advanced/open-section.svg">
			</div>

			<div ng-if="isShowChildTab('settings','woo','<?php echo $subsection; ?>')">
			    <?php $oxygen_toolbar->settings_breadcrumbs(	
								$title,
								__('WooCommerce','oxygen'),
								'woo'); ?>
				<?php include_once($subsection."-settings.view.php"); ?>
			</div>

		<?php endforeach; ?>
