<?php

namespace console\controllers;

use common\models\Domain;
use common\models\Level;
use common\models\question\Question;
use common\models\rules\DomainOwner;
use common\models\rules\LevelOwner;
use common\models\rules\QuestionOwner;
use common\models\User;
use frontend\models\SignupForm;
use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;
use yii\rbac\ManagerInterface;
use yii\rbac\Permission;
use yii\rbac\Rule;

class RbacController extends Controller
{

    /**
     * @var string the default command action.
     */
    public $defaultAction = 'init';

    /**
     * @var ManagerInterface
     */
    protected $auth;

    /**
     * Init all roles and permissions matrix
     */
    public function actionInit()
    {
        /** @var DbManager $auth */
        $auth = Yii::$app->authManager;

        $this->auth = $auth;
        if (count($auth->getRoles()) > 0) {
            if (!$this->confirm('Table of roles is not empty. Want You rewrite all of this?')) {
                return self::EXIT_CODE_NORMAL;
            }
        }

        $auth->removeAll();

        $this->initRoles();

        $this->initDomainsPermission();

        $this->initLevelPermission();

        $this->initQuestionPermission();

        //$this->initIssuesPermissions();

        //$this->initPositionsPermissions();

        //$this->initCommentsPermissions();



        $this->initBackendPermissions();

       // $this->initUsersPermissions();

        echo "Roles and Permissions matrix was created\n";

        //$auth->invalidateCache(); todo active cache in config

        return $this->run('update-roles');
    }

    protected function initRoles()
    {
        $auth = $this->auth;

        $guestRole = $auth->createRole(User::ROLE_GUEST);
        $guestRole->description = "Anonymous user";
        $auth->add($guestRole);

        $unconfirmedRole = $auth->createRole(User::ROLE_UNCONFIRMED);
        $unconfirmedRole->description = "Registered unconfirmed user";
        $auth->add($unconfirmedRole);

        $userRole = $auth->createRole(User::ROLE_USER);
        $userRole->description = "Registered user";
        $auth->add($userRole);

        $clientRole = $auth->createRole(User::ROLE_CLIENT);
        $clientRole->description = "Client user";
        $auth->add($clientRole);

        $adminRole = $auth->createRole(User::ROLE_ADMIN);
        $adminRole->description = "Website administrator";
        $auth->add($adminRole);
    }

    protected function initDomainsPermission()
    {
        $auth = $this->auth;

        //create permissions rules (Domain)

        $domainOwnerRule = new DomainOwner();
        $auth->add($domainOwnerRule);

        //create permissions (Domain)

        $viewDomain = $this->createPermission(Domain::PERMISSION_VIEW, 'View domain');

        $viewOwnDomain = $this->createPermission(
            Domain::PERMISSION_VIEW_OWN,
            'View own domain',
            $domainOwnerRule,
            $viewDomain
        );

        $createDomain = $this->createPermission(Domain::PERMISSION_CREATE, 'Create domain');

        $editDomain = $this->createPermission(Domain::PERMISSION_EDIT, 'Edit domain');

        $editOwnDomain = $this->createPermission(
            Domain::PERMISSION_EDIT_OWN,
            'Edit own domain',
            $domainOwnerRule,
            $editDomain
        );

        $deleteDomain = $this->createPermission(Domain::PERMISSION_DELETE, 'Delete domain');

        $deleteOwnDomain = $this->createPermission(
            Domain::PERMISSION_DELETE_OWN,
            'Delete own domain',
            $domainOwnerRule,
            $deleteDomain
        );

        //assign permissions to roles (Issue)
        $this->applyRolePermissions(User::ROLE_ADMIN, [
            $viewDomain,
            $viewOwnDomain,
            $createDomain,
            $editDomain,
            $editOwnDomain,
            $deleteDomain,
            $deleteOwnDomain,
        ]);

        $this->applyRolePermissions(User::ROLE_CLIENT, [
            $createDomain,
            $viewOwnDomain,
            $editOwnDomain,
            $deleteOwnDomain,
        ]);

        $this->applyRolePermissions(User::ROLE_USER, [
            $viewDomain,
        ]);

        $this->applyRolePermissions(User::ROLE_UNCONFIRMED, [
            $viewDomain,
        ]);

        $this->applyRolePermissions(User::ROLE_GUEST, [
            $viewDomain,
        ]);

    }

    protected function initLevelPermission()
    {
        $auth = $this->auth;

        //create permissions rules (Level)

        $levelOwnerRule = new LevelOwner();
        $auth->add($levelOwnerRule);

        //create permissions (Level)

        $viewLevel = $this->createPermission(Level::PERMISSION_VIEW, 'View level');

        $viewOwnLevel = $this->createPermission(
            Level::PERMISSION_VIEW_OWN,
            'View own level',
            $levelOwnerRule,
            $viewLevel
        );

        $createLevel = $this->createPermission(Level::PERMISSION_CREATE, 'Create level');

        $editLevel = $this->createPermission(Level::PERMISSION_EDIT, 'Edit level');

        $editOwnLevel = $this->createPermission(
            Level::PERMISSION_EDIT_OWN,
            'Edit own level',
            $levelOwnerRule,
            $editLevel
        );

        $deleteLevel = $this->createPermission(Level::PERMISSION_DELETE, 'Delete level');

        $deleteOwnLevel = $this->createPermission(
            Level::PERMISSION_DELETE_OWN,
            'Delete own level',
            $levelOwnerRule,
            $deleteLevel
        );

        //assign permissions to roles (Issue)
        $this->applyRolePermissions(User::ROLE_ADMIN, [
            $viewLevel,
            $viewOwnLevel,
            $createLevel,
            $editLevel,
            $editOwnLevel,
            $deleteLevel,
            $deleteOwnLevel,
        ]);

        $this->applyRolePermissions(User::ROLE_CLIENT, [
            $createLevel,
            $viewOwnLevel,
            $editOwnLevel,
            $deleteOwnLevel,
        ]);

        $this->applyRolePermissions(User::ROLE_USER, [
            $viewLevel,
        ]);

        $this->applyRolePermissions(User::ROLE_UNCONFIRMED, [
            $viewLevel,
        ]);

        $this->applyRolePermissions(User::ROLE_GUEST, [
            $viewLevel,
        ]);

    }

    protected function initQuestionPermission()
    {
        $auth = $this->auth;

        //create permissions rules (Question)

        $questionOwnerRule = new QuestionOwner();
        $auth->add($questionOwnerRule);

        //create permissions (Question)

        $viewQuestion = $this->createPermission(Question::PERMISSION_VIEW, 'View question');

        $viewOwnQuestion = $this->createPermission(
            Question::PERMISSION_VIEW_OWN,
            'View own question',
            $questionOwnerRule,
            $viewQuestion
        );

        $createQuestion = $this->createPermission(Question::PERMISSION_CREATE, 'Create question');

        $editQuestion = $this->createPermission(Question::PERMISSION_EDIT, 'Edit question');

        $editOwnQuestion = $this->createPermission(
            Question::PERMISSION_EDIT_OWN,
            'Edit own question',
            $questionOwnerRule,
            $editQuestion
        );

        $deleteQuestion = $this->createPermission(Question::PERMISSION_DELETE, 'Delete question');

        $deleteOwnQuestion = $this->createPermission(
            Question::PERMISSION_DELETE_OWN,
            'Delete own question',
            $questionOwnerRule,
            $deleteQuestion
        );

        //assign permissions to roles (Issue)
        $this->applyRolePermissions(User::ROLE_ADMIN, [
            $viewQuestion,
            $viewOwnQuestion,
            $createQuestion,
            $editQuestion,
            $editOwnQuestion,
            $deleteQuestion,
            $deleteOwnQuestion,
        ]);

        $this->applyRolePermissions(User::ROLE_CLIENT, [
            $createQuestion,
            $viewOwnQuestion,
            $editOwnQuestion,
            $deleteOwnQuestion,
        ]);

        $this->applyRolePermissions(User::ROLE_USER, [
            $viewQuestion,
        ]);

        $this->applyRolePermissions(User::ROLE_UNCONFIRMED, [
            $viewQuestion,
        ]);

        $this->applyRolePermissions(User::ROLE_GUEST, [
            $viewQuestion,
        ]);

    }

    /*protected function initIssuesPermissions()
    {
        $auth = $this->auth;

        //create permissions rules (Issue)

        $issueOwnerRule = new IssueOwnerRule();
        $auth->add($issueOwnerRule);

        $issueDeletedRule = new IssueDeletedRule();
        $auth->add($issueDeletedRule);

        $issueRestoreRule = new IssueRestoreRule();
        $auth->add($issueRestoreRule);

        $issuePublishRule = new IssuePublishRule();
        $auth->add($issuePublishRule);

        $issueDraftRule = new IssueDraftRule();
        $auth->add($issueDraftRule);

        $issueBlockedRule = new IssueBlockedRule();
        $auth->add($issueBlockedRule);

        $issueUnblockedRule = new IssueUnblockedRule();
        $auth->add($issueUnblockedRule);

        $issueHotRule = new IssueHotRule();
        $auth->add($issueHotRule);

        $issueNotHotRule = new IssueNotHotRule();
        $auth->add($issueNotHotRule);

        $issuePublishedRule = new IssuePublishedRule();
        $auth->add($issuePublishedRule);

        $issueSuggestRule = new IssueSuggestRule();
        $auth->add($issueSuggestRule);

        //create permissions (Position)

        $viewIssue = $this->createPermission(Issue::PERMISSION_VIEW, 'View issue');

        $viewOwnIssue = $this->createPermission(
            Issue::PERMISSION_VIEW_OWN,
            'View own issue',
            $issueOwnerRule,
            $viewIssue
        );

        $createIssue = $this->createPermission(Issue::PERMISSION_CREATE, 'Create issue');

        $editIssue = $this->createPermission(Issue::PERMISSION_EDIT, 'Edit issue');

        $editOwnIssue = $this->createPermission(
            Issue::PERMISSION_EDIT_OWN,
            'Edit own issue',
            $issueOwnerRule,
            $editIssue
        );

        $deleteIssue = $this->createPermission(Issue::PERMISSION_DELETE, 'Delete issue', $issueDeletedRule);

        $deleteOwnIssue = $this->createPermission(
            Issue::PERMISSION_DELETE_OWN,
            'Delete own issue',
            $issueOwnerRule,
            $deleteIssue
        );

        $addFactToIssue = $this->createPermission(Issue::PERMISSION_ADD_FACT, 'Add fact to issue');

        $addFactToOwnIssue = $this->createPermission(
            Issue::PERMISSION_ADD_FACT_TO_OWN,
            'Add fact to own issue',
            $issueOwnerRule,
            $addFactToIssue
        );


        $restoreIssue = $this->createPermission(
            Issue::PERMISSION_RESTORE,
            'Restore issue',
            $issueRestoreRule
        );

        $restoreOwnIssue = $this->createPermission(
            Issue::PERMISSION_RESTORE_OWN,
            'Restore own issue',
            $issueOwnerRule,
            $restoreIssue
        );

        $draftIssue = $this->createPermission(Issue::PERMISSION_DRAFT, 'Draft issue', $issueDraftRule);

        $draftOwnIssue = $this->createPermission(
            Issue::PERMISSION_DRAFT_OWN,
            'Draft own issue',
            $issueOwnerRule,
            $draftIssue
        );

        $publishIssue = $this->createPermission(
            Issue::PERMISSION_PUBLISH,
            'Publish issue',
            $issuePublishRule
        );

        $publishOwnIssue = $this->createPermission(
            Issue::PERMISSION_PUBLISH_OWN,
            'Publish own issue',
            $issueOwnerRule,
            $publishIssue
        );

        $suggestIssue = $this->createPermission(
            Issue::PERMISSION_SUGGEST,
            'Suggest issue',
            $issueSuggestRule
        );

        $suggesthOwnIssue = $this->createPermission(
            Issue::PERMISSION_SUGGEST_OWN,
            'Suggest own issue',
            $issueOwnerRule,
            $suggestIssue
        );

        $unblockIssue = $this->createPermission(
            Issue::PERMISSION_UNBLOCK,
            'Unblock issue',
            $issueBlockedRule
        );

        $blockIssue = $this->createPermission(Issue::PERMISSION_BLOCK, 'Block issue', $issueUnblockedRule);

        $hotIssue = $this->createPermission(Issue::PERMISSION_HOT, 'Hot issue', $issueHotRule);
        $notHotIssue = $this->createPermission(
            Issue::PERMISSION_NOT_HOT,
            'Not hot issue',
            $issueNotHotRule
        );

        $viralizeIssue = $this->createPermission(Issue::PERMISSION_VIRALIZE, 'Viralize issue');

        //assign permissions to roles (Issue)
        $this->applyRolePermissions(User::ROLE_ADMIN, [
            $viewIssue,
            $viewOwnIssue,
            $createIssue,
            $editIssue,
            $editOwnIssue,
            $deleteIssue,
            $deleteOwnIssue,
            $hotIssue,
            $notHotIssue,
            $viralizeIssue,
            $addFactToIssue,

            $restoreIssue,
            $draftIssue,
            $publishIssue,
            $suggestIssue,

            $unblockIssue,
            $blockIssue,
        ]);

        $trustedUnblockedPermissions = $this->createPermission(
            'trustedUnblockedIssues',
            'Filter unblocked issue for trusted users',
            $issueUnblockedRule,
            [
                $viewIssue,
                $viewOwnIssue,
                $editOwnIssue,
                $addFactToOwnIssue,
                $deleteOwnIssue,
                $restoreOwnIssue,
                $draftOwnIssue,
//                $publishOwnIssue,
                $hotIssue,
                $notHotIssue,
                $viralizeIssue,
            ]
        );

        $this->applyRolePermissions(User::ROLE_TRUSTED, [
            $createIssue,
            $trustedUnblockedPermissions,
            $suggestIssue
        ]);
        // blog moderator have permissions like trusted user
        $this->applyRolePermissions(User::ROLE_BLOG_MODERATOR, [
            $createIssue,
            $trustedUnblockedPermissions,
            $suggestIssue
        ]);

        $userUnblockedPermissions = $this->createPermission(
            'userUnblockedIssues',
            'Filter unblocked issue for confirmed users',
            $issueUnblockedRule,
            [
                $viewIssue,
                $viewOwnIssue,
                $editOwnIssue,
                $addFactToOwnIssue,
                $deleteOwnIssue,
                $restoreOwnIssue,
                $draftOwnIssue,
//                $publishOwnIssue,
                $hotIssue,
                $notHotIssue,
                $viralizeIssue,
            ]
        );

        $this->applyRolePermissions(User::ROLE_USER, [
            $createIssue,
            $userUnblockedPermissions,
            $suggestIssue
        ]);

        $unconfirmedUnblockedPermissions = $this->createPermission(
            'unconfirmedUnblockedIssues',
            'Filter unblocked issue for unconfirmed users',
            $issueUnblockedRule,
            [
                $viewIssue,
                $hotIssue,
                $notHotIssue,
                $viralizeIssue,
            ]
        );

        $this->applyRolePermissions(User::ROLE_UNCONFIRMED, [
            $unconfirmedUnblockedPermissions,
        ]);

        $guestUnblockedPermissions = $this->createPermission(
            'guestUnblockedIssues',
            'Filter unblocked issue for guest users',
            $issueUnblockedRule,
            [
                $viewIssue,
            ]
        );

        $this->applyRolePermissions(User::ROLE_GUEST, [
            $guestUnblockedPermissions,
        ]);
    }

    protected function initPositionsPermissions()
    {
        $auth = $this->auth;

        //create permissions rules (Position)

        $positionOwnerRule = new PositionOwnerRule();
        $auth->add($positionOwnerRule);

        $positionDeletedRule = new PositionDeletedRule();
        $auth->add($positionDeletedRule);

        $positionRestoreRule = new PositionRestoreRule();
        $auth->add($positionRestoreRule);

        $positionPublishRule = new PositionPublishRule();
        $auth->add($positionPublishRule);

        $positionDraftRule = new PositionDraftRule();
        $auth->add($positionDraftRule);

        $positionBlockedRule = new PositionBlockedRule();
        $auth->add($positionBlockedRule);

        $positionUnblockedRule = new PositionUnblockedRule();
        $auth->add($positionUnblockedRule);

        $agreePositionRule = new PositionAgreeRule();
        $auth->add($agreePositionRule);

        $disagreePositionRule = new PositionDisagreeRule();
        $auth->add($disagreePositionRule);

        //create permissions (Position)

        $viewPosition = $this->createPermission(Position::PERMISSION_VIEW, 'View position');

        $viewOwnPosition = $this->createPermission(
            Position::PERMISSION_VIEW_OWN,
            'View own position',
            $positionOwnerRule,
            $viewPosition
        );

        $createPosition = $this->createPermission(Position::PERMISSION_CREATE, 'Create position');

        $editPosition = $this->createPermission(Position::PERMISSION_EDIT, 'Edit position');

        $editOwnPosition = $this->createPermission(
            Position::PERMISSION_EDIT_OWN,
            'Edit own position',
            $positionOwnerRule,
            $editPosition
        );

        $suggestSourceToPosition = $this->createPermission(
            Position::PERMISSION_SUGGEST_SOURCES,
            'Suggest source to position'
        );

        $deletePosition = $this->createPermission(Position::PERMISSION_DELETE, 'Delete position', $positionDeletedRule);

        $deleteOwnPosition = $this->createPermission(
            Position::PERMISSION_DELETE_OWN,
            'Delete own position',
            $positionOwnerRule,
            $deletePosition
        );

        $restorePosition = $this->createPermission(
            Position::PERMISSION_RESTORE,
            'Restore position',
            $positionRestoreRule
        );

        $restoreOwnPosition = $this->createPermission(
            Position::PERMISSION_RESTORE_OWN,
            'Restore own position',
            $positionOwnerRule,
            $restorePosition
        );

        $draftPosition = $this->createPermission(Position::PERMISSION_DRAFT, 'Draft position', $positionDraftRule);

        $draftOwnPosition = $this->createPermission(
            Position::PERMISSION_DRAFT_OWN,
            'Draft own position',
            $positionOwnerRule,
            $draftPosition
        );

        $publishPosition = $this->createPermission(
            Position::PERMISSION_PUBLISH,
            'Publish position',
            $positionPublishRule
        );

        $publishOwnPosition = $this->createPermission(
            Position::PERMISSION_PUBLISH_OWN,
            'Publish own position',
            $positionOwnerRule,
            $publishPosition
        );


        $unblockPosition = $this->createPermission(
            Position::PERMISSION_UNBLOCK,
            'Unblock position',
            $positionBlockedRule
        );


        $blockPosition = $this->createPermission(Position::PERMISSION_BLOCK, 'Block position', $positionUnblockedRule);

        $agreePosition = $this->createPermission(Position::PERMISSION_AGREE, 'Agree position', $agreePositionRule);
        $disagreePosition = $this->createPermission(
            Position::PERMISSION_DISAGREE,
            'Disagree position',
            $disagreePositionRule
        );

        $electedSharePosition = $this->createPermission(
            Position::PERMISSION_ELECTED_SHARE,
            'Share position with elected'
        );
        $viralizePosition = $this->createPermission(Position::PERMISSION_VIRALIZE, 'Viralize position');

        $commentPosition = $this->createPermission(Position::PERMISSION_ADD_COMMENT, 'Comment position');

        //assign permissions to roles (Position)
        $this->applyRolePermissions(User::ROLE_ADMIN, [
            $viewPosition,
            $viewOwnPosition,
            $createPosition,
            $editPosition,
            $editOwnPosition,
            $deletePosition,
            $deleteOwnPosition,
            $agreePosition,
            $disagreePosition,
            $electedSharePosition,
            $viralizePosition,
            $suggestSourceToPosition,

            $commentPosition,

            $restorePosition,
            $draftPosition,
            $publishPosition,

            $unblockPosition,
            $blockPosition,
        ]);

        $trustedUnblockedPermissions = $this->createPermission(
            'trustedUnblockedPositions',
            'Filter unblocked position for trusted users',
            $positionUnblockedRule,
            [
                $viewPosition,
                $viewOwnPosition,
                $editOwnPosition,
                $suggestSourceToPosition,
                $deleteOwnPosition,
                $restoreOwnPosition,
                $draftOwnPosition,
                $publishOwnPosition,
                $commentPosition,
                $agreePosition,
                $disagreePosition,
                $electedSharePosition,
                $viralizePosition
            ]
        );

        $this->applyRolePermissions(User::ROLE_TRUSTED, [
            $createPosition,
            $trustedUnblockedPermissions,
        ]);
        // blog moderator have permissions like trusted user
        $this->applyRolePermissions(User::ROLE_BLOG_MODERATOR, [
            $createPosition,
            $trustedUnblockedPermissions,
        ]);

        $userUnblockedPermissions = $this->createPermission(
            'userUnblockedPositions',
            'Filter unblocked position for confirmed users',
            $positionUnblockedRule,
            [
                $viewPosition,
                $viewOwnPosition,
                $editOwnPosition,
                $suggestSourceToPosition,
                $deleteOwnPosition,
                $restoreOwnPosition,
                $draftOwnPosition,
                $publishOwnPosition,
                $commentPosition,
                $agreePosition,
                $disagreePosition,
                $electedSharePosition,
                $viralizePosition,
            ]
        );

        $this->applyRolePermissions(User::ROLE_USER, [
            $createPosition,
            $userUnblockedPermissions,
        ]);

        $unconfirmedUnblockedPermissions = $this->createPermission(
            'unconfirmedUnblockedPositions',
            'Filter unblocked position for unconfirmed users',
            $positionUnblockedRule,
            [
                $viewPosition,
                $commentPosition,
                $agreePosition,
                $disagreePosition,
                $viralizePosition,
                $suggestSourceToPosition,
            ]
        );

        $this->applyRolePermissions(User::ROLE_UNCONFIRMED, [
            $unconfirmedUnblockedPermissions,
        ]);

        $guestUnblockedPermissions = $this->createPermission(
            'guestUnblockedPositions',
            'Filter unblocked position for guest users',
            $positionUnblockedRule,
            [
                $viewPosition,
            ]
        );

        $this->applyRolePermissions(User::ROLE_GUEST, [
            $guestUnblockedPermissions,
        ]);
    }

    protected function initCommentsPermissions()
    {
        $auth = $this->auth;

        //create permissions (Comment)
        $commentRead = $auth->createPermission('commentRead');
        $commentRead->description = 'Read comment';
        $auth->add($commentRead);

        $commentReply = $auth->createPermission('commentReply');
        $commentReply->description = 'Reply comment';
        $auth->add($commentReply);

        $commentPost = $auth->createPermission('commentPost');
        $commentPost->description = 'Post comment';
        $auth->add($commentPost);

        $commentOwnerRule = new CommentOwner();
        $auth->add($commentOwnerRule);

        $commentEditAny = $auth->createPermission('commentEditAny');
        $commentEditAny->description = 'Edit any comment';
        $auth->add($commentEditAny);

        $commentEditOwn = $auth->createPermission('commentEditOwn');
        $commentEditOwn->description = 'Edit own comment';
        $commentEditOwn->ruleName = $commentOwnerRule->name;
        $auth->add($commentEditOwn);

        $auth->addChild($commentEditOwn, $commentEditAny);

        $commentDeleteAny = $auth->createPermission('commentDeleteAny');
        $commentDeleteAny->description = 'Delete any comment';
        $auth->add($commentDeleteAny);

        $commentDeleteOwn = $auth->createPermission('commentDeleteOwn');
        $commentDeleteOwn->description = 'Delete own comment';
        $commentDeleteOwn->ruleName = $commentOwnerRule->name;
        $auth->add($commentDeleteOwn);

        $auth->addChild($commentDeleteOwn, $commentDeleteAny);

        $commentPostFirst = $auth->createPermission('commentPostFirst');
        $commentPostFirst->description = 'Can post first comment';
        $auth->add($commentPostFirst);

        //assign permissions to roles (Comment)
        $adminRole = $auth->getRole(User::ROLE_ADMIN);
        $auth->addChild($adminRole, $commentRead);
        $auth->addChild($adminRole, $commentReply);
        $auth->addChild($adminRole, $commentPost);
        $auth->addChild($adminRole, $commentEditAny);
        $auth->addChild($adminRole, $commentDeleteAny);
        $auth->addChild($adminRole, $commentPostFirst);

        $trustedRole = $auth->getRole(User::ROLE_TRUSTED);
        $auth->addChild($trustedRole, $commentRead);
        $auth->addChild($trustedRole, $commentReply);
        $auth->addChild($trustedRole, $commentPost);
        $auth->addChild($trustedRole, $commentEditOwn);
        $auth->addChild($trustedRole, $commentDeleteOwn);
        $auth->addChild($trustedRole, $commentPostFirst);

        // blog moderator have permissions like trusted user
        $blogModeratorRole = $auth->getRole(User::ROLE_BLOG_MODERATOR);
        $auth->addChild($blogModeratorRole, $commentRead);
        $auth->addChild($blogModeratorRole, $commentReply);
        $auth->addChild($blogModeratorRole, $commentPost);
        $auth->addChild($blogModeratorRole, $commentEditOwn);
        $auth->addChild($blogModeratorRole, $commentDeleteOwn);
        $auth->addChild($blogModeratorRole, $commentPostFirst);

        $userRole = $auth->getRole(User::ROLE_USER);
        $auth->addChild($userRole, $commentRead);
        $auth->addChild($userRole, $commentReply);
        $auth->addChild($userRole, $commentPost);
        $auth->addChild($userRole, $commentEditOwn);
        $auth->addChild($userRole, $commentDeleteOwn);
        $auth->addChild($userRole, $commentPostFirst);

        $unconfirmedRole = $auth->getRole(User::ROLE_UNCONFIRMED);
        $auth->addChild($unconfirmedRole, $commentRead);
        $auth->addChild($unconfirmedRole, $commentReply);
        $auth->addChild($unconfirmedRole, $commentPost);
        $auth->addChild($unconfirmedRole, $commentEditOwn);
        $auth->addChild($unconfirmedRole, $commentDeleteOwn);
        $auth->addChild($unconfirmedRole, $commentPostFirst);

    }

    protected function initUsersPermissions()
    {
        $auth = $this->auth;

        //create permissions (User)

        $userOwnerRule = new UserOwner();
        $auth->add($userOwnerRule);

        $viewProfile = $this->createPermission(User::PERMISSION_VIEW_PROFILE, 'View user profile');

        $viewOwnProfile = $this->createPermission(
            User::PERMISSION_VIEW_OWN_PROFILE,
            'View own user profile',
            $userOwnerRule,
            $viewProfile
        );

        $editProfile = $this->createPermission(User::PERMISSION_EDIT_PROFILE, 'Edit profile');

        $editOwnProfile = $this->createPermission(
            User::PERMISSION_EDIT_OWN_PROFILE,
            'Edit own profile',
            $userOwnerRule,
            $editProfile
        );

        $followRule = new FollowRule();
        $auth->add($followRule);
        $followUser = $this->createPermission(User::PERMISSION_FOLLOW_USER, 'User to follow', $followRule);

        $unfollowRule = new UnfollowRule();
        $auth->add($unfollowRule);
        $unfollowUser = $this->createPermission(User::PERMISSION_UNFOLLOW_USER, 'To unfollow user', $unfollowRule);

        $blockFollowerRule = new BlockFollowerRule();
        $auth->add($blockFollowerRule);
        $blockFollowerUser = $this->createPermission(
            User::PERMISSION_BLOCK_FOLLOWER_USER,
            'Block to follow user',
            $blockFollowerRule
        );

        $unblockFollowerRule = new UnblockFollowerRule();
        $auth->add($unblockFollowerRule);
        $unblockFollowerUser = $this->createPermission(
            User::PERMISSION_UNBLOCK_FOLLOWER_USER,
            'Unblock to follow user',
            $unblockFollowerRule
        );

        $deleteUser = $this->createPermission(User::PERMISSION_DELETE_USER, 'Delete the user');

        $deleteOwnUser = $this->createPermission(
            User::PERMISSION_DELETE_OWN_USER,
            'Delete own user',
            $userOwnerRule,
            $deleteUser
        );

        $changeUserRole = $this->createPermission(User::PERMISSION_CHANGE_USER_ROLE, 'Change role for user');

        $blockUser = $this->createPermission(User::PERMISSION_BLOCK_USER, 'Block the user');

        $disableUserFollowRule = new DisableUserFollowRule();
        $auth->add($disableUserFollowRule);
        $disableUserFollow = $this->createPermission(
            User::PERMISSION_DISABLE_FOLLOW,
            'Disable to follow user',
            $disableUserFollowRule
        );

        $enableUserFollowRule = new EnableUserFollowRule();
        $auth->add($enableUserFollowRule);
        $enableUserFollow = $this->createPermission(
            User::PERMISSION_ENABLE_FOLLOW,
            'Enable to follow user',
            $enableUserFollowRule
        );

        $optOutUserFollowRule = new OptOutUserFollowRule();
        $auth->add($optOutUserFollowRule);
        $optOutUserFollow = $this->createPermission(
            User::PERMISSION_OPT_OUT_FOLLOW,
            'Opt out follow feature for user',
            $optOutUserFollowRule
        );

        $optInUserFollowRule = new OptInUserFollowRule();
        $auth->add($optInUserFollowRule);
        $optInUserFollow = $this->createPermission(
            User::PERMISSION_OPT_IN_FOLLOW,
            'Opt in follow feature for user',
            $optInUserFollowRule
        );

        //assign permissions to roles (User)

        $this->applyRolePermissions(User::ROLE_GUEST, [
            $viewProfile
        ]);

        $this->applyRolePermissions(User::ROLE_ADMIN, [
            $viewProfile,
            $viewOwnProfile,
            $editProfile,
            $deleteUser,
            $followUser,
            $unfollowUser,
            $blockFollowerUser,
            $unblockFollowerUser,
            $blockUser,
            $changeUserRole,
            $disableUserFollow,
            $enableUserFollow,
            $optOutUserFollow,
            $optInUserFollow,
        ]);

        $this->applyRolePermissions(User::ROLE_TRUSTED, [
            $viewProfile,
            $viewOwnProfile,
            $editOwnProfile,
            $deleteOwnUser,
            $followUser,
            $unfollowUser,
            $blockFollowerUser,
            $unblockFollowerUser,
            $disableUserFollow,
            $enableUserFollow,
            $optOutUserFollow,
            $optInUserFollow,
        ]);
        // blog moderator have permissions like trusted user
        $this->applyRolePermissions(User::ROLE_BLOG_MODERATOR, [
            $viewProfile,
            $viewOwnProfile,
            $editOwnProfile,
            $deleteOwnUser,
            $followUser,
            $unfollowUser,
            $blockFollowerUser,
            $unblockFollowerUser,
            $disableUserFollow,
            $enableUserFollow,
            $optOutUserFollow,
            $optInUserFollow,
        ]);

        $this->applyRolePermissions(User::ROLE_USER, [
            $viewProfile,
            $viewOwnProfile,
            $editOwnProfile,
            $deleteOwnUser,
            $followUser,
            $unfollowUser,
            $blockFollowerUser,
            $unblockFollowerUser,
            $disableUserFollow,
            $enableUserFollow,
            $optOutUserFollow,
            $optInUserFollow,
        ]);

        $this->applyRolePermissions(User::ROLE_UNCONFIRMED, [
            $viewProfile,
            $viewOwnProfile,
            $editOwnProfile,
            $deleteOwnUser,
            $followUser,
            $unfollowUser,
            $blockFollowerUser,
            $unblockFollowerUser,
            $disableUserFollow,
            $enableUserFollow,
            $optOutUserFollow,
            $optInUserFollow,
        ]);
    }

    protected function initSystemPermissions()
    {
        $auth = $this->auth;

        //create permissions (System)
        $emailToRepresentative = $auth->createPermission('emailToRepresentative');
        $emailToRepresentative->description = 'Email to Representative';
        $auth->add($emailToRepresentative);

        $suggestNewIssues = $auth->createPermission('suggestNewIssues');
        $suggestNewIssues->description = 'Suggest new Issues';
        $auth->add($suggestNewIssues);

        //assign permissions to roles (User)
        $adminRole = $auth->getRole(User::ROLE_ADMIN);
        $auth->addChild($adminRole, $emailToRepresentative);
        $auth->addChild($adminRole, $suggestNewIssues);

        $trustedRole = $auth->getRole(User::ROLE_TRUSTED);
        $auth->addChild($trustedRole, $emailToRepresentative);
        $auth->addChild($trustedRole, $suggestNewIssues);

        $userRole = $auth->getRole(User::ROLE_USER);
        $auth->addChild($userRole, $emailToRepresentative);
        $auth->addChild($userRole, $suggestNewIssues);
    }*/

    protected function initBackendPermissions()
    {
        $auth = $this->auth;
        //backend access
        $backAccess = $auth->createPermission('backendAccess');
        $backAccess->description = 'Access to backend part of site';
        $auth->add($backAccess);

        $adminRole = $auth->getRole(User::ROLE_ADMIN);
        $auth->addChild($adminRole, $backAccess);
        $clientRole = $auth->getRole(User::ROLE_CLIENT);
        $auth->addChild($clientRole, $backAccess);
    }


    /**
     * @param $name
     * @param null $description
     * @param Rule $rule
     * @param Permission|Permission[] $children
     * @return \yii\rbac\Permission
     */
    protected function createPermission($name, $description = null, Rule $rule = null, $children = null)
    {
        $permission = $this->auth->createPermission($name);
        $permission->description = $description;

        if (!is_null($rule)) {
            $permission->ruleName = $rule->name;
        }

        $this->auth->add($permission);

        if (empty($children)) {
            return $permission;
        }

        if (!is_array($children)) {
            $children = [$children];
        }

        foreach ($children as $child) {
            $this->auth->addChild($permission, $child);
        }

        return $permission;
    }

    protected function applyRolePermissions($name, $children)
    {
        if (!is_array($children)) {
            $children = [$children];
        }
        $role = $this->auth->getRole($name);

        foreach ($children as $child) {
            $this->auth->addChild($role, $child);
        }
    }


    /**
     * @param string $email
     * @param string $password
     * @param string $name
     * @return int
     */
    public function actionAdmin($email = 'admin@admin.com', $password = 'admin1', $name = 'admin')
    {

        $model = new User(['scenario' => 'create']);
        if (!$model->load(['username' => $name, 'email' => $email, 'password' => $password], '')) {
            foreach ($model->getFirstErrors() as $key => $val) {
                echo $val . "\n";
            }
            return self::EXIT_CODE_ERROR;
        }

        if (!$model->create()) {
            foreach ($model->getFirstErrors() as $key => $val) {
                echo $val . "\n";
            }
            return self::EXIT_CODE_ERROR;
        }

        $model->saveRole(User::ROLE_ADMIN);

        echo "Admin account was created\n";
        return self::EXIT_CODE_NORMAL;
    }

    public function actionApply($role, $to = '')
    {
        $roles = array_keys(Yii::$app->authManager->getRoles());

        if (!in_array($role, $roles)) {
            echo "Wrong Role. Allowed roles: " . implode(', ', $roles) . "\n";
            return self::EXIT_CODE_ERROR;
        }

        /** @var $user User  */
        if (!$user = User::findByUsername($to)) {
            echo "Cannot find user with username: {$to}\n";
            return self::EXIT_CODE_ERROR;
        }

        if (!$user->saveRole($role)) {
            echo "Cannot set role '{$role}' to user with username '{$to}'\n";
            return self::EXIT_CODE_ERROR;
        }

        echo "Role '{$role}' was applied to user with username {$to}\n";
        return self::EXIT_CODE_NORMAL;
    }

    /**
     *
     */
    public function actionUpdateRoles()
    {
        /** @var User $user */
        foreach (User::find()->each() as $user) {
            $user->scenario = 'update';
            $user->saveRole($user->role);
            echo "Role '{$user->role}' was applied to user with id: {$user->id}\n";
        }

        return self::EXIT_CODE_NORMAL;
    }
}
