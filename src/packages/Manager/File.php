<?php
declare(strict_types=1);
namespace Manager;

class File {
	private string $path;
	private $resource;
	
	public function __construct (
		string $path,
	) {
		$this->path = $path;
		$this->resource = $this->openFile();
		// throw exception in case of error
	}

	private function openFile() {
		$resource = fopen($this->path, 'r');
		return $resource;
	}

	public function getFile() {
		return $this->resource;
	}

	public function __destruct() {
		fclose($this->resource);
	}
}
	
?>