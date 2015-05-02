<?php
/**
 * CoolMS2 Mailer Module (http://www.coolms.com/)
 *
 * @link      http://github.com/coolms/mailer for the canonical source repository
 * @copyright Copyright (c) 2006-2015 Altgraphic, ALC (http://www.altgraphic.com)
 * @license   http://www.coolms.com/license/new-bsd New BSD License
 * @author    Dmitry Popov <d.popov@altgraphic.com>
 */

namespace CmsMailer\Service;

trait MailServiceAwareTrait
{
    /**
     * @var MailServiceInterface
     */
    protected $mailService;

    /**
     * @return MailServiceInterface
     */
    public function getMailService()
    {
        return $this->mailService;
    }

    /**
     * @param MailServiceInterface $mailService
     * @return self
     */
    public function setMailService(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
        return $this;
    }
}
