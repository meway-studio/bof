<?php
class MyErrorHandler {

    public static function errorToException($code, $message, $file, $line) {

        file_put_contents('/var/www/mailerrors/mail_exception.txt', print_r(array(
			'date'    => date('Y-m-d h:i:s'),
			'code'    => $code,
			'message' => $message,
			'file'    => $file,
			'line'    => $line,
		),1));

        throw new Exception($message, $code);
    }

}