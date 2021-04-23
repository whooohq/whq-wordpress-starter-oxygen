			<div class="oxygen-control-row">
				<div class="oxygen-control-wrapper">
					<label class="oxygen-control-label"><?php _e("Heading Font Size","oxygen"); ?></label>
					<div class="oxygen-control">
						
						<div class="oxygen-measure-box">
							<input type="text" spellcheck="false" 
								ng-model="$parent.iframeScope.globalSettings.woo['--widget-title-font-size']" 
								ng-model-options="{ debounce: 10 }">
                            <?php $oxygen_toolbar->global_measure_box_unit_selector('global', 'woo.--widget-title-font-size', 'px,%,em'); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="oxygen-control-row">
				<div class='oxygen-control-wrapper' id='oxygen-typography-font-family'>
					<label class='oxygen-control-label'><?php _e("Heading Font Weight","oxygen"); ?></label>
					<div class='oxygen-control'>

						<div class="oxygen-select oxygen-select-box-wrapper">
							<div class="oxygen-select-box">
								<div class="oxygen-select-box-current">{{$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']}}</div>
								<div class="oxygen-select-box-dropdown"></div>
							</div>
							<div class="oxygen-select-box-options">
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']=''">&nbsp;</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='100'">100</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='200'">200</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='300'">300</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='400'">400</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='500'">500</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='600'">600</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='700'">700</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='800'">800</div>
								<div class="oxygen-select-box-option" 
									ng-click="$parent.iframeScope.globalSettings.woo['--widget-title-font-weight']='900'">900</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="oxygen-control-row">
				<div class='oxygen-control-wrapper'>
					<label class='oxygen-control-label'><?php _e("Heading Font Family","oxygen"); ?></label>
					<div class='oxygen-control oxygen-control-global-font'>

						<div class="oxygen-select oxygen-select-box-wrapper">
							<div class="oxygen-select-box">
								<div class="oxygen-select-box-current">{{iframeScope.globalSettings.woo['--widget-title-font-family']}}</div>
								<div class="oxygen-select-box-dropdown"></div>
							</div>
							<div class="oxygen-select-box-options">

								<div class="oxygen-select-box-option">
									<input type="text" value="" placeholder="<?php _e("Search...", "oxygen"); ?>" spellcheck="false"
										ng-model="iframeScope.fontsFilter"/>
								</div>
								<div class="oxygen-select-box-option"
									ng-repeat="font in iframeScope.elegantCustomFonts | filter:iframeScope.fontsFilter | limitTo: 20"
									ng-click="iframeScope.globalSettings.woo['--widget-title-font-family']= font;iframeScope.loadWebFont(font)"
									title="<?php _e("Apply this font family", "oxygen"); ?>">
										{{font}}
								</div>
								<div class="oxygen-select-box-option"
									ng-repeat="font in iframeScope.typeKitFonts | filter:iframeScope.fontsFilter | limitTo: 20"
									ng-click="iframeScope.globalSettings.woo['--widget-title-font-family']= font.slug;iframeScope.loadWebFont(font.slug)"
									title="<?php _e('Apply this font family', 'oxygen'); ?>">
										{{font.name}}
								</div>
								<div class="oxygen-select-box-option"
									ng-repeat="font in iframeScope.webSafeFonts | filter:iframeScope.fontsFilter | limitTo: 20"
									ng-click="iframeScope.globalSettings.woo['--widget-title-font-family']= font"
									title="<?php _e("Apply this font family", "oxygen"); ?>">
										{{font}}
								</div>
								<div class="oxygen-select-box-option"
									ng-repeat="font in iframeScope.googleFontsList | filter:iframeScope.fontsFilter | limitTo: 20"
									ng-click="iframeScope.globalSettings.woo['--widget-title-font-family']=font.family;iframeScope.loadWebFont(font.family)"
									title="<?php _e('Apply this font family', 'oxygen'); ?>">
										{{font.family}}
								</div>

							</div>
							<!-- .oxygen-select-box-options -->
						</div>
						<!-- .oxygen-select.oxygen-select-box-wrapper -->
					</div>
				</div>
			</div>