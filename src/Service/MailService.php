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

use Zend\EventManager\EventManagerAwareInterface,
    Zend\EventManager\EventManagerAwareTrait,
    Zend\Filter\StripTags,
    Zend\I18n\Translator\TranslatorAwareInterface,
    Zend\I18n\Translator\TranslatorAwareTrait,
    Zend\Mail\Message,
    Zend\Mail\Transport\TransportInterface,
    Zend\Mime\Message as MimeMessage,
    Zend\Mime\Mime,
    Zend\Mime\Part as MimePart,
    Zend\ServiceManager\ServiceLocatorAwareInterface,
    Zend\ServiceManager\ServiceLocatorAwareTrait,
    Zend\View\Model\ViewModel,
    Zend\View\Renderer\RendererInterface;

class MailService implements
        EventManagerAwareInterface,
        MailServiceInterface,
        ServiceLocatorAwareInterface,
        TranslatorAwareInterface
{
    use EventManagerAwareTrait,
        ServiceLocatorAwareTrait,
        TranslatorAwareTrait;

    /**
     * @var Message
     */
    protected $message;

    /**
     * @var string
     */
    protected $encoding = 'UTF-8';

    /**
     * @var string
     */
    protected $fromAddress;

    /**
     * @var string
     */
    protected $fromName;

    /**
     * @var string
     */
    protected $format = Mime::TYPE_HTML;

    /**
     * @var RendererInterface
     */
    protected $viewRenderer;

    /**
     * @var TransportInterface
     */
    protected $transport;

    /**
     * @var array
     */
    protected $attachments = [];

    /**
     * {@inheritDoc}
     */
    public function attach($attachment)
    {
        $this->attachments[] = $attachment;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        if (null === $this->message) {
            $message = new Message();
            $this->setMessage($message);
        }

        return $this->message;
    }

    /**
     * {@inheritDoc}
     */
    public function sendMessage()
    {
        $message = $this->getMessage();

        if (!$message->isValid()) {
            $message->setFrom($this->getFromAddress(), $this->getFromName());
        }

        $message->setEncoding($this->getEncoding());
        $this->getTransport()->send($message);

        $this->message = null;
        $this->from = null;
        $this->attachments = [];
    }

    /**
     * {@inheritDoc}
     */
    public function setBody($body)
    {
        $body = $this->prepareBody($body);
        $this->getMessage()->setBody($body);

        return $this;
    }

    /**
     * @param string $body
     * @return string|MimeMessage
     */
    protected function prepareBody($body)
    {
        if ($body instanceof ViewModel) {
            $body = $this->getViewRenderer()->render($body);
        }

        if ($this->getFormat() === Mime::TYPE_TEXT) {
            $filter = new StripTags;
            return $filter->filter($body);
        }
        if ($this->getFormat() === Mime::TYPE_HTML) {

            $html = new MimePart($body);
            $html->type = Mime::TYPE_HTML . "; charset={$this->getEncoding()}";

            $body = new MimeMessage();
            $body->setParts([$html]);
        }

        return $body;
    }

    /**
     * {@inheritDoc}
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * {@inheritDoc}
     */
    public function setFromAddress($from)
    {
        $this->fromAddress = $from;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFromAddress()
    {
        return $this->fromAddress;
    }

    /**
     * {@inheritDoc}
     */
    public function setFromName($name)
    {
        $this->fromName = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * {@inheritDoc}
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * {@inheritDoc}
     */
    public function setTransport(TransportInterface $transport)
    {
        $this->transport = $transport;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTransport()
    {
        if (null === $this->transport) {
            $this->setTransport($this->getServiceLocator()->get('mail.transport'));
        }

        return $this->transport;
    }

    /**
     * @param RendererInterface $viewRenderer
     * @return MailService
     */
    public function setViewRenderer(RendererInterface $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;

        return $this;
    }

    /**
     * @return RendererInterface
     */
    public function getViewRenderer()
    {
        if (null === $this->viewRenderer) {
            $this->setViewRenderer($this->getServiceLocator()->get('ViewRenderer'));
        }

        return $this->viewRenderer;
    }
}
