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
     *
     * @return Smtp
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $options = new SmtpOptions(isset($config['mail']['transport']['options'])
            ? $config['mail']['transport']['options']
            : []
        );
        return (new Smtp())->setOptions($options);
    }
}
