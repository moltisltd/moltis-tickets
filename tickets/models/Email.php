<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property integer $id
 * @property string $to_name
 * @property string $to_email
 * @property string $cc_name
 * @property string $cc_email
 * @property string $bcc_name
 * @property string $bcc_email
 * @property string $sender_name
 * @property string $sender_email
 * @property string $subject
 * @property string $body
 * @property string $attachments
 * @property integer $status
 * @property string $created
 * @property string $last_updated
 * @property string $sent
 */
class Email extends \yii\db\ActiveRecord {

    const EMAIL_UNSENT = 0x00;
    const EMAIL_SENT = 0x01;

    public function init() {
        $this->sender_name = 'Tixty';
        $this->sender_email = \Yii::$app->params['adminEmail'];
        $this->status = Email::EMAIL_UNSENT;
        $this->created = date("Y-m-d H:i:s");
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'email';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['to_name', 'to_email', 'sender_name', 'sender_email', 'subject', 'body', 'created'], 'required'],
            [['body', 'attachments'], 'string'],
            [['status'], 'integer'],
            [['created', 'last_updated', 'sent'], 'safe'],
            [['to_name', 'to_email', 'cc_name', 'cc_email', 'bcc_name', 'bcc_email', 'sender_name', 'sender_email', 'subject'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'Email ID',
            'to_name' => 'To Name',
            'to_email' => 'To Email',
            'cc_name' => 'CC Name',
            'cc_email' => 'CC Email',
            'bcc_name' => 'BCC Name',
            'bcc_email' => 'BCC Email',
            'sender_name' => 'Sender Name',
            'sender_email' => 'Sender Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'attachments' => 'Attachments',
            'status' => 'Status',
            'created' => 'Time Created',
            'last_updated' => 'Last Updated',
            'sent' => 'Time Sent',
        ];
    }

    public function send() {
        $errors = [];
        if (!$this->to_email) {
            $errors[] = "No to email";
        } elseif (!self::validateEmail($this->to_email)) {
            $errors[] = "Invalid to email";
        }
        if ($this->cc_email && !self::validateEmail($this->cc_email)) {
            $errors[] = "Invalid CC email";
        }
        if ($this->bcc_email && !self::validateEmail($this->bcc_email)) {
            $errors[] = "Invalid BCC email";
        }
        if (!self::validateEmail($this->sender_email)) {
            $errors[] = "Invalid sender email";
        }
        if (!$this->subject) {
            $errors[] = "Subject must not be empty";
        }
        if (count($errors)) {
            var_dump($errors);
            return false;
        }
        $to_name = $this->to_name ? $this->to_name : $this->to_email;
        $to = "$to_name <{$this->to_email}>";
        $cc_name = $this->cc_name ? $this->cc_name : $this->cc_email;
        $cc = "$cc_name <{$this->cc_email}>";
        $bcc_name = $this->bcc_name ? $this->bcc_name : $this->bcc_email;
        $bcc = "$cc_name <{$this->bcc_email}>";
        $sender_name = $this->sender_name ? $this->sender_name : $this->sender_email;
        $sender = "$sender_name <{$this->sender_email}>";

        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/html; charset=UTF-8";
        $headers[] = "From: $sender";
        $headers[] = "Reply-To: $sender";
        $headers[] = "X-Mailer: PHP/" . phpversion();

        $sent = mail($to, $this->subject, $this->body, implode("\r\n", $headers));
        if ($sent) {
            $this->status = self::EMAIL_SENT;
            $this->sent = date("Y-m-d H:i:s");
            $this->save();
        }
        return $sent;
    }

    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

}
