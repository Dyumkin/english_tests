<?php
use backend\components\smartform\Nav;

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
    'items' => [
        'dashboard' => [
            'label' => 'Dashboard',
            'url' => ['/site/index'],
            'icon' => 'fa-home'
        ],
        'inbox' => [
            'label' => 'Inbox (None)',
            'url' => '/inbox.php',
            'icon' => 'fa-inbox',
        ],
        'user' => [
            'label' => 'Users',
            'url' => ['/user/admin'],
            'icon' => 'fa-users',
        ],
        'auth' => [
            'label' => 'Access Control (Beta)',
            'icon' => 'fa-shield',
            'items' => [
                [
                    'label' => 'Route',
                    'url' => ['/admin/route']
                ],
                [
                    'label' => 'Permission',
                    'url' => ['/admin/permission']
                ],
                [
                    'label' => 'Role',
                    'url' => ['/admin/role']
                ],
                [
                    'label' => 'Assignment',
                    'url' => ['/admin/assignment']
                ],
            ]
        ],
        'level' => [
            'label' => 'Level',
            'url' => ['/level/index'],
            'icon' => 'fa-level-up',
        ],
        'options' => [
            'label' => 'Options',
            'icon' => 'fa-cogs',
            'items' => [
                [
                    'label' => 'Languages',
                    'url' => ['/lang/index']
                ]
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
                        <?= \cebe\gravatar\Gravatar::widget([
                            'email' => Yii::$app->user->identity->profile->gravatar_email,
                            'options' => [
                                'alt' => 'me',
                                'class' => 'online'
                            ],
                            'size' => 50
                        ]) ?>
						<span>
							<?= Yii::$app->user->identity->getUserName(); ?>
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

				<?= Nav::widget($pageNav); ?>

			</nav>
			<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

		</aside>
		<!-- END NAVIGATION -->
