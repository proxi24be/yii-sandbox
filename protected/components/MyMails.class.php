<?php

class MyMails {

	private $body;
	private $from;
	private $fromName;
	private $to;
	private $bcc;
	private $cc;
	private $attachment;
	private $subject;
	private $mail;

	public function __construct ($from="breast.technical@bordet.be",$fromName="breast technical", array $to, $cc=array(), $bcc=array(), $subject, $body, $attachment=array())
	{
		$this->body=$body;
		$this->from=$from;
		$this->fromName=$fromName;
		$this->to=$to;
		$this->bcc=$bcc;
		$this->cc=$cc;
		$this->attachment=$attachment;
		$this->subject=$subject;
	}


	public function send ()
	{
		$this->mail = new PHPMailer();
		$this->mail->IsSMTP();  // send via SMTP
		$this->mail->Host = MAIL_SERVER;
		$this->mail->From = $this->from;
		$this->mail->FromName = $this->fromName;
		$this->mail->IsHTML(false);
		$this->mail->Subject=$this->subject;
		$this->mail->Body=$this->body;

		$this->addTo($this->to);
		$this->addCc($this->cc);
		$this->addBcc($this->bcc);
		$this->addAttachment($this->attachment);

		if(!$this->mail->Send())
                   throw new Exception ($mail->ErrorInfo);

		else
			return true;

	}

        
        public function setSubject($subject)
        {
            $this->subject=$subject;
        }
        
	public function addTo (array $tos)
	{
		foreach ($tos as $to)
			$this->mail->AddAddress($to);
	}

	public function addBcc (array $bccs)
	{
		foreach ($bccs as $bcc)
			$this->mail->AddBCC($bcc);
	}

	public function addCc(array $ccs)
	{
		foreach ($ccs as $cc)
			$this->mail->AddCC($cc);
	}

	public function addAttachment(array $attachments)
	{
		foreach($attachments as $path => $name)
			$this->mail->AddAttachment($path , $name);
	}
		
}



?>