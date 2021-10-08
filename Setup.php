<?php

namespace ThemeHouse\ThreadWatchers;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

/**
 * Class Setup
 * @package ThemeHouse\ThreadWatchers
 */
class Setup extends AbstractSetup
{
    use StepRunnerInstallTrait;
    use StepRunnerUpgradeTrait;
    use StepRunnerUninstallTrait;

    /**
     * @param array $stateChanges
     */
    public function postInstall(array &$stateChanges)
    {
        $this->applyGlobalPermission('forum', 'ththreadwatchers_view');
    }
}