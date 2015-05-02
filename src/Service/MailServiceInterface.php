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

use Zend\Mail\Message,
    Zend\Mail\Transport\TransportInterface;

interface MailServiceInterface
{
    /**
     * @param mixed $attachment
     * @return self
     */
    public function attach($attachment);

    /**
     * @param Message $message
     * @return self
     */
    public function setMessage(Message $message);

    /**
     * @return Message
     */
    public function getMessage();

    /**
     * @return void
     */
    public function sendMessage();

    /**
     * @param string $body
     * @return self
     */
    public function setBody($body);

    /**
     * @param string $encoding
     * @return self
     */
    public function setEncoding($encoding);

    /**
     * @return string
     */
    public function getEncoding();

    /**
     * @param string $from
     * @return self
     */
    public function setFromAddress($from);

    /**
     * @return string
     */
    public function getFromAddress();

    /**
     * @param string $from
     * @return self
     */
    public function setFromName($name);

    /**
     * @return string
     */
    public function getFromName();

    /**
     * @param string $format
     * @return self
     */
    public function setFormat($format);

    /**
     * @return string
     */
    public function getFormat();

    /**
     * @param TransportInterface $transport
     * @return self
     */
    public function setTransport(TransportInterface $transport);

    /**
     * @return TransportInterface
     */
    public function getTransport();
}
