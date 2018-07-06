<?php
/**
 * Schedules a cronjob for automatic whitepaper delivery to customer
 * @author Marc Mentha <marc.mentha@cubetech.ch>
 * @version 1.0.0
 * @since 1.5.0
 */
class WhitepaperScheduler {
	
	public function __construct() {
		add_action('gform_after_submission', [$this, 'sheduleEventOnFormSubmission'], 10, 2);
		add_action('ct_schedule_event', [$this, 'sendWhitepaper'], 1, 5);
	}

	/**
	 * Hooks into formsubmission routine to set up the cronjob for whitepaper automation
	 * @param array $entry 
	 * @param array $form 
	 * @return void
	 * @see https://docs.gravityforms.com/gform_after_submission/
	 */
	public function sheduleEventOnFormSubmission($entry, $form) {

		$email = $this->getEmail($entry, $form);
		$fileName = $this->getFileName($entry);
		$filePath = $this->getFilePath($entry, $form);
		$message = $this->createMessage($email, $fileName, $filePath);
		$this->setSchedule($message);
	}

	/**
	 * Schedules the cronjob
	 * @param mixed $message
	 * @return void
	 */
	public function setSchedule($message) {
		$time = current_time('timestamp') + 86400;       
		wp_schedule_single_event( $time, 'ct_schedule_event', $message);
	}

	/**
	 * Sends the E-Mail via wp_cron
	 *
	 * @param String $email
	 * @param String $subject
	 * @param String $message
	 * @param array $headers
	 * @param array $attachments
	 * @return void
	 */
	public function sendMessage($email, $subject, $message, $headers, $attachments) {
		wp_mail( $email, $subject, $message, $headers, $attachments	);
	}

	/**
	 * Extracts the Reciever E-Mail
	 *
	 * @param mixed $form
	 * @param mixed $entry
	 * @return String
	 * @see https://docs.gravityforms.com/gform_after_submission/
	 */
	public function getEmail($form, $entry) {

		foreach($entry['fields'] as $field) {
			if ($field['label']=== 'E-Mail') {
				return $form[$field['id']];
			}
		}
	}

	/**
	 * Extracts post title aka filename
	 *
	 * @param mixed $entry
	 * @return String
	 * @see https://docs.gravityforms.com/gform_after_submission/
	 */
	public function getFileName($entry) {
		$postID = url_to_postid($entry['source_url']);
		return get_post($postID)->post_title;
	}

	/**
	 * Extracts filepath for appending to email
	 *
	 * @param mixed $form
	 * @param mixed $entry
	 * @return String
	 * @see https://docs.gravityforms.com/gform_after_submission/
	 */
	public function getFilePath($form, $entry) {

		foreach($entry['fields'] as $field) {
			if ($field['label']=== 'Datei') {
				$path = explode('wp-content', $form[$field['id']])[1];
				return WP_CONTENT_DIR . $path;
			}
		}
	}

	/**
	 * Creates the emailbody
	 *
	 * @param String $email
	 * @param String $fileName
	 * @param String $filePath
	 * @return mixed
	 */
	public function createMessage($email, $fileName, $filePath) {

		$message = [];
		$message['email'] = $email;
		$message['subject'] = $fileName;
		$message['message'] = 'Insert Message here;
		$message['headers'] = [];
		$message['attachments'] = [$filePath];

		return $message;
	}
}

