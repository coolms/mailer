<?php
/**
 * CoolMS2 Mailer Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/mailer for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsMailer;

return [
    'controllers' => [
        'aliases' => [
            'CmsMailer\Controller\Admin' => 'CmsMailer\Mvc\Controller\AdminController',
        ],
        'invokables' => [
            'CmsMailer\Mvc\Controller\AdminController' => 'CmsMailer\Mvc\Controller\AdminController',
        ],
    ],
    'router' => [
        'routes' => [
            
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'CmsMailer\Service\MailServiceInterface' => 'CmsMailer\Service\MailService',
        ],
        'factories' => [
            'mail.transport' => 'CmsMailer\Factory\MailTransportFactory',
        ],
        'invokables' => [
            'CmsMailer\Service\MailService' => 'CmsMailer\Service\MailService',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __NAMESPACE__ => __DIR__ . '/../view',
        ],
    ],
];
