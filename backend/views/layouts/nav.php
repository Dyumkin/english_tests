<?php
use backend\components\smartui\SmartUI;
use yii\helpers\Url;

/* @var $this \yii\web\View */

/*navigation array config

ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_blank",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)

*/
$pageNav = [
    'dashboard' => [
        'title' => 'Dashboard',
        'url' => Url::toRoute('site/index'),
        'icon' => 'fa-home'
    ],
    'inbox' => [
        'title' => 'Inbox',
        'url' => '/inbox.php',
        'icon' => 'fa-inbox',
        'label_htm' => '<span class="badge pull-right inbox-badge">14</span>',
    ],
    'options' => [
        'title' => 'Options',
        //'url' => Url::toRoute('site/index'),
        'url_target' => '_blank',
        'icon' => 'fa-cogs',
        'sub' => [
            [
                'title' => 'Languages',
                'url' => Url::toRoute('lang/index')
            ]
        ]
    ]
];
?>
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			<div class="login-info">
				<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

					<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
						<img src="/img/avatars/sunny.png" alt="me" class="online" />
						<span>
							john.doe
						</span>
						<i class="fa fa-angle-down"></i>
					</a>

				</span>
			</div>
			<!-- end user info -->

			<!-- NAVIGATION : This navigation is also responsive

			To make this navigation dynamic please make sure to link the node
			(the reference to the nav > ul) after page load. Or the navigation
			will not initialize.
			-->
			<nav>
				<!-- NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional hre="" links. See documentation for details.
				-->

				<?php
					$ui = new SmartUI();
					$ui->create_nav($pageNav)->print_html();
				?>

			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->
