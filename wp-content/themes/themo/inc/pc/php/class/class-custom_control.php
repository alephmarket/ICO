<?php

if(!class_exists('WP_Customize_Control')){
    require_once(ABSPATH . WPINC . '/class-wp-customize-setting.php');
    require_once(ABSPATH . WPINC . '/class-wp-customize-section.php');
    require_once(ABSPATH . WPINC . '/class-wp-customize-control.php');
}

class WP_Customize_PcUrl_Control extends WP_Customize_Control
{

    public function render_content()
    {

    }
}

class WP_Customize_PcPanel_Control extends WP_Customize_Control
{

    public function render_content()
    {        
         
        ?>
        <input id="pc-data-input" type="text">
        <div class="pc-wrap {{data.settings.panelColor}}">
            <div class="pc-brand"></div>
            <div class="buttons">
                <a href="<?php echo esc_url( home_url('/') ); ?>wp-admin/" class="button back"><span ng-bind="::l10n.close"></span></a>
                <a class="button save" ng-click="save()">
                    <span ng-if="!isStoringData" ng-bind="::l10n.save"></span> 
                    <span class="loading" ng-if="isStoringData"></span>
                </a>
            </div>
            <div class="pc-breadcrumb top {{ view }}">
                <a href="" ng-repeat="link in breadcrumb" ng-click="switchPanel(link.path)">
                       <span ng-bind="::link.name"></span></a>
            </div>

            <div class="pc-panel {{ viewClass }}" ng-scroll-panel ng-cloak>
                <div class="scrollbar-rp">
                    <div class="bar-rp">
                        <div class="scroll-rp"></div>
                    </div>
                </div>
                <div class="pc-subpanel" ng-view></div>

                <div ng-if="showEmptySectionInfo" class="angular-section-empty">
                    <div class="table">
                        <div class="cell">
                            <div class="info" ng-bind-html="::l10n.emptySection.text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pc-buttons">
                <ul class="">
                    <li>
                        <a href="" class="btn settings icon" title="Settings" ng-click="toggleSettingsPanel()"></a>
                    </li>
                    <li>
                        <a href="" class="btn navi icon" title="FullScreen Mode" ng-click="toggleFullScreen()"></a>

                    </li>
                    <li>
                        <a href="" class="btn import-export icon" title="Export/Import" ng-click="toggleIEPanel()"
                           ng-disabled="view!='layers'"></a>
                        <ul class="pc-import-export" ng-class="{active:collapsedIEPanel}">
                            <li><a href="" class="export" ng-bind="::l10n.export" ng-click="export()"></a></li>
                            <li><a href="" class="import" ng-bind="::l10n.import" ng-click="import()"></a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <?php


    }
}


