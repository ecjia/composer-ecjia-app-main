<?php


namespace Ecjia\App\Main\Subscribers;

use ecjia_license;
use RC_Uri;
use Royalcms\Component\Hook\Dispatcher;

class AdminHookSubscriber
{

    public function onSetDaojiaAdminCpnameFilter($name)
    {
        return '大商创多商户 <span class="sml_t">' . config('release.version') . '</span>';
    }

    public function onSetDaojiaAdminWelcomeAction()
    {
        if (! ecjia_license::instance()->license_check()) {
            $ecjia_version = config('release.version');
            $ecjia_release = config('release.build');
            $ecjia_welcome_logo = RC_Uri::admin_url('statics/images/ecjiawelcom.png');
            $ecjia_about_url = RC_Uri::url('@about/about_us');
            $welcome_ecjia 	= __('欢迎使用大商创多商户API管理平台', 'main');
            $description 	= __("大商创多商户是由上海商创网络科技有限公司推出的，一款对接大商创平台的APP客户端管理平台，用户通过后台可方便查看APP的活动。", 'main');
            $more 			= __('了解更多 »', 'main');
            $welcome = <<<WELCOME
		  <div>
			<a class="close m_r10" data-dismiss="alert">×</a>
			<div class="hero-unit">
				<div class="row-fluid">
					<div class="span3">
						<img src="{$ecjia_welcome_logo}" />
					</div>
					<div class="span9">
						<h1>{$welcome_ecjia} {$ecjia_version} <span style="font-size:16px">（{$ecjia_release}）</span></h1>
						<p>{$description}</p>
						<a class="btn btn-info" href="{$ecjia_about_url}" target="_self">{$more}</a>
					</div>
				</div>
			</div>
		</div>
WELCOME;
            echo $welcome;
        } else {
            $license_logo = RC_Uri::admin_url('statics/images/license-logo.png');
            $license_url = RC_Uri::url('@license/license');
            $certificate = ecjia_license::instance()->get_certificate();
            $license_domain = $certificate['subject']['commonName'];
            $license = __('终身商业授权', 'main');
            $label_license_domain = __('授权域名：', 'main');
            $license_description =  __('恭喜您，您正在使用商业授权版本，享有该系统进行商业运营的合法权利。', 'main');
            $look_license = __('查看授权证书 »', 'main');

            $welcome = <<<WELCOME
        <div class="row-fluid move-mods show">
            <div class="span12 move-mod nomove">
        		<div>
        			<a class="close m_r10" data-dismiss="alert">×</a>
        			<div class="hero-unit padding20">
        				<div class="row-fluid">
        					<div class="span2 m_t15 t_c">
        						<img src="{$license_logo}"/>
        					</div>
        					<div class="span10">
        						<h1>{$license}</span></h1>
        						<p>{$license_description}</p>
        						<p>{$label_license_domain}{$license_domain} <a class="f_r" href="{$license_url}" target="_self">{$look_license}</a></p>
        					</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
WELCOME;
            echo $welcome;
        }
    }


    public function onSetDaojiaAdminAboutWelcomeAction()
    {
        $ecjia_version = config('release.version');
        $ecjia_release = config('release.build');
        $ecjia_welcome_logo = RC_Uri::admin_url('statics/images/ecjiawelcom.png');
        $welcome_ecjia 	= __('欢迎使用大商创多商户API管理平台', 'main');
        $description 	= __("大商创多商户是由上海商创网络科技有限公司推出的，一款对接大商创平台的APP客户端管理平台，用户通过后台可方便查看APP的活动。", 'main');
        $more 			= __('了解更多 »', 'main');
        $ecjia_url = 'https://www.dscmall.cn/app.html';

        $welcome = <<<WELCOME
        <div class="hero-unit">
			<div class="row-fluid">
				<div class="span9">
					<h1>{$welcome_ecjia} {$ecjia_version} <span style="font-size:16px">（{$ecjia_release}）</span></h1>
					<p>{$description}</p>
					<p><a class="btn btn-info" href="{$ecjia_url}" target="_bank">{$more}</a></p>
				</div>
				<div class="span3">
					<div><img src="{$ecjia_welcome_logo}" /></div>
				</div>
			</div>
		</div>
WELCOME;
        echo $welcome;
    }

    public function onRemoveAdminAboutWelcomeAction()
    {
        $events = royalcms('\Royalcms\Component\Hook\Dispatcher');
        $events->removeAction( 'admin_about_welcome', 'Ecjia\System\Hookers\DisplayAdminAboutWelcomeAction' );
    }

    public function onSetDaojiaVersionFilter($version)
    {
        return config('release.version', $version);
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param \Royalcms\Component\Hook\Dispatcher $events
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        //filter
        $events->addFilter(
            'ecjia_admin_cpname',
            'Ecjia\App\Main\Subscribers\AdminHookSubscriber@onSetDaojiaAdminCpnameFilter'
        );
        $events->addFilter(
            'ecjia_build_version',
            'Ecjia\App\Main\Subscribers\AdminHookSubscriber@onSetDaojiaVersionFilter'
        );

        //action
        $events->removeAction(
            'admin_dashboard_top',
            'Ecjia\System\Hookers\DisplayAdminWelcomeAction',
            9
        );
        $events->addAction(
            'admin_dashboard_top',
            'Ecjia\App\Main\Subscribers\AdminHookSubscriber@onSetDaojiaAdminWelcomeAction'
        );
        $events->addAction(
            'admin_print_main_header',
            'Ecjia\App\Main\Subscribers\AdminHookSubscriber@onRemoveAdminAboutWelcomeAction'
        );
        $events->addAction(
            'admin_about_welcome',
            'Ecjia\App\Main\Subscribers\AdminHookSubscriber@onSetDaojiaAdminAboutWelcomeAction',
            11
        );

    }

}