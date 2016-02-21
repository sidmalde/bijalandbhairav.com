<?php 
class CryptHelper extends AppHelper {

	private $Crypt;

	/**
	 * encrypt()
	 *
	 * @param mixed $data
	 * @return string
	 */
	function encrypt($data) {
		if(!$this->Crypt) {
		$this->Crypt = new CryptClass(
		Configure::read('Cryptable.cipher'),
		Configure::read('Cryptable.key'),
		Configure::read('Cryptable.mode'),
		Configure::read('Cryptable.iv'
	));
		}
		return $this->Crypt->encrypt($data);
	}
}
?> 