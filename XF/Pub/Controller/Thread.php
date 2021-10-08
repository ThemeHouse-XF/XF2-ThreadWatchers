<?php

namespace ThemeHouse\ThreadWatchers\XF\Pub\Controller;

use XF\Mvc\ParameterBag;

/**
 * Class Thread
 * @package ThemeHouse\ThreadWatchers\XF\Pub\Controller
 */
class Thread extends XFCP_Thread
{
    /**
     * @param ParameterBag $params
     * @return \XF\Mvc\Reply\View
     * @throws \XF\Mvc\Reply\Exception
     */
    public function actionThWatchers(ParameterBag $params)
    {
        if (!\XF::visitor()->hasPermission('forum', 'ththreadwatchers_view')) {
            return $this->noPermission();
        }

        $thread = $this->assertViewableThread($params['thread_id']);

        $page = $this->filterPage();
        $perPage = 25;

        $finder = $this->finder('XF:ThreadWatch')
            ->with('User', true)
            ->where('thread_id', '=', $thread->thread_id)
            ->limitByPage($page, $perPage);

        $total = $finder->total();

        $viewParams = [
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'hasMore' => $page * $perPage < $total,

            'thread' => $thread,
            'watchers' => $finder->fetch()
        ];

        return $this->view('ThemeHouse\ThreadWatchers:Thread\Watchers', 'ththreadwatchers_thread_watcher_list',
            $viewParams);
    }
}
