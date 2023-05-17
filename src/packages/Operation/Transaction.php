<?php
declare(strict_types=1);
namespace Operation;

class Transaction {
	private $file;
	private array $transactions = [];
	private array $totalAmount = [];
	private float $income;
	private float $expense;
	private float $net;

	public function __construct ($file) {
		$this->file = $file->getFile();
		$this->setTransactions();
		$this->setNet();
		$this->setIncome();
		$this->setExpense();
	}

	public function getTransactions () {
		return $this->transactions;
	}

	private function formatDate ($date) {
			$time = strtotime($date);
			$date = date('M j, Y', $time);
			return $date;
	}

	private function setTransactions () {
		while(($line = fgetcsv($this->file)) !== false) {
			[$date, $check, $desc, $amount] = $line;

			if ($date === 'Date') continue;
			else $date = $this->formatDate($date);

			$this->transactions["line:".count($this->transactions) + 2] = [
				"date"=> $date,

				"check"=> $check,

				"desc"=> $desc,

				"amount"=> $amount,
			];

			$amount = $this->getFloatAmount($amount);

			$this->totalAmount[] = $amount;
		}
	}

	private function getFloatAmount ($amount) {
		$amount = str_replace('$', '', $amount);
		return $amount = str_replace(',', '', $amount);
	}

	private function setIncome () {
		$totalAmount = $this->totalAmount;

		$income = $this->net;

		array_map(function ($amount) use (&$income){
			if ($amount[0] === '-') $income -= $amount;
			return $income;
		}, $totalAmount);

		$this->income = $income;
	}

	private function setExpense () {
		$net = $this->net;
		$income = $this->income;
		$this->expense = $income - $net;
	}

	private function setNet () {
		$this->net = array_sum($this->totalAmount);
	}

	public function getIncome () {
		return $this->income;
	}

	public function getExpense () {
		return $this->expense;
	}

	public function getNet () {
		return $this->net;
	}
}

?>