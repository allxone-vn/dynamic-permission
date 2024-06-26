<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public $fromEmail = '';
    public $fromName   = '';
    public $recipients = '';

    public $userAgent = 'CodeIgniter';
    public $protocol = 'smtp';
    public $mailPath = '/usr/sbin/sendmail';
    public $SMTPHost = '';
    public $SMTPUser = '';
    public $SMTPPass = '';
    public $SMTPPort = 587;
    public $SMTPTimeout = 5;
    public $SMTPKeepAlive = false;
    public $SMTPCrypto = 'tls';
    public $wordWrap = true;
    public $wrapChars = 76;
    public $mailType = 'html';
    public $charset = 'UTF-8';
    public $validate = true;
    public $priority = 3;
    public $CRLF = "\r\n";
    public $newline = "\r\n";
    public $BCCBatchMode = false;
    public $BCCBatchSize = 200;
    public $DSN = false;
    public $SMTPDebug = 4; // Bật chế độ Debugging

    public function __construct()
    {
        $this->fromEmail = getenv('FROMEMAIL');
        $this->fromName = getenv('FROMNAME');
        $this->SMTPHost = getenv('SMTPHOST');
        $this->SMTPUser = getenv('SMTPUSER');
        $this->SMTPPass = getenv('SMTPPASS');
        }
}
