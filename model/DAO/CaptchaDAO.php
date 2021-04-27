<?php

require_once dirname(__DIR__, 1).'/config.php';
require_once __DIR__.'/Connection.php';

class CaptchaDAO extends Connection {

	public function __construct() {
		parent::__construct(PATH_TO_SQLITE);
	}

	public function getCodeCaptcha($code) {
		$stmt = $this->pdo->prepare('SELECT id, codeResults, ipAddress, isUsed FROM captchaCodes WHERE codeResults = :code LIMIT 1');
		$stmt->execute([':code' => $code]);
        $code = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $code[] = [
                'id' => $row['id'],
                'codeResult' => $row['codeResults'],
                'ipAddress' => $row['ipAddress'],
                'isUsed' => $row['isUsed']
            ];
        }
        return $code[0];
	}

	public function insertCodeCaptcha($code, $ip) {

		$codeInDb = $this->getCodeCaptcha($code);

		if($codeInDb > 0) {
			$this->updateCodeCaptcha($codeInDb['id'], $code, $ip);
		} else {
			$sql = 'INSERT INTO captchaCodes(codeResults, ipAddress) VALUES(:code, :ip)';
	        $stmt = $this->pdo->prepare($sql);
	        $stmt->execute([':code' => $code, ':ip' => $ip]);
		}
	}

	public function updateCodeCaptcha($id, $code, $ip) {
		$sql = 'UPDATE captchaCodes SET codeResult = :code, ipAddress = :ip WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id, ':code' => $code, ':ip' => $ip]);
	}

	public function updateIsUsed($id) {
		$sql = 'UPDATE captchaCodes SET isUsed = 1 WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
	}
}