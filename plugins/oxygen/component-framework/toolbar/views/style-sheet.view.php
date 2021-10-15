<div class="oxygen-sidebar-code-editor-wrap oxygen-sidebar-stylesheet-editor-wrap">
  <textarea ui-codemirror="{
      lineNumbers: true,
      newlineAndIndent: false,
      mode: 'css',
      type: 'stylesheet',
      autoCloseBrackets: true,
      matchBrackets: true,
      onLoad : codemirrorLoaded
    }" 
    ng-model="iframeScope.stylesheetToEdit['css']"></textarea>
  <div class="oxygen-code-error-container"></div>
</div>

<div class="oxygen-control-row oxygen-control-row-bottom-bar oxygen-control-row-bottom-bar-code-editor">
  <?php global $oxygen_toolbar; 
    $oxygen_toolbar->codemirror_theme_chooser(); ?>  
  <a href="#" class="oxygen-code-editor-expand"
    data-collapse="<?php _e("Collapse Editor", "oxygen"); ?>" data-expand="<?php _e("Expand Editor", "oxygen"); ?>"
    ng-click="toggleSidebar()">
    <?php _e("Expand Editor", "oxygen"); ?>
  </a>
</div>