<?php
/**
 * CoolMS2 Mailer Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/mailer for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsMailer\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Zend\Mail\Transport\Smtp,
    Zend\Mail\Transport\SmtpOptions;

class MailTransportFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        $config = $serviceManager->get('Config');
        $transport = new Smtp();
        $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
        return $transport;
    }
}
