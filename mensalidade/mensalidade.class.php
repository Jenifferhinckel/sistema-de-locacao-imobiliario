<?php
require_once("../conexao.class.php");
class mensalidade{
	private $conexao;
    private $contrato_id;
	private $mensalidade;
	private $repasse;
	private $mensalidade_status;
	private $repasse_status;
	private $estadia;
    private $start_date;
	private $end_date;
	private $aluguel;
	
	public function __construct(){
		$this->conexao = new conexao;
	}
    function setContratoId($contrato_id){
		$this->contrato_id = $contrato_id;
	}
	function setMensalidade($mensalidade){
		$this->mensalidade = $mensalidade;
	}
	function setRepasse($repasse){
		$this->repasse = $repasse;
	}
	function setMensalidadeStatus($mensalidade_status){
		$this->mensalidade_status = $mensalidade_status;
	}
	function setRepasseStatus($repasse_status){
		$this->repasse_status = $repasse_status;
	}
	function setEstadia($estadia){
		$this->estadia = $estadia;
	}
    function setStartDate($start_date){
		$this->start_date = $start_date;
	}
	function setEndDate($end_date){
		$this->end_date = $end_date;
	}
	function setAluguel($aluguel){
		$this->aluguel = $aluguel;
	}
    function getContratoId(){
		return $this->contrato_id;
	}
	function getMensalidade(){
		return $this->mensalidade;
	}
	function getRepasse(){
		return $this->repasse;
	}
	function getMensalidadeStatus(){
		return $this->mensalidade_status;
	}
	function getRepasseStatus(){
		return $this->repasse_status;
	}
	function getEstadia(){
		return $this->estadia;
	}
    function getStartDate(){
		return $this->start_date;
	}
	function getEndDate(){
		return $this->end_date;
	}
	function getAluguel(){
		return $this->aluguel;
	}
	public function cadastrar_mensalidades(){
		$date = (new DateTime($this->start_date));
		$day = $date->format('d');
		
        for ($i=1; $i <= $this->estadia; $i++) { 
            if($i == 1){
				$mensalidade = $this->mensalidade;
				if($day != 1){
					$month = $date->format('m');
					$year = $date->format('Y');
					$qt_days_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
					$days_used = $qt_days_month - $day;
					$aluguel_perDay = $this->aluguel/$qt_days_month;
					$new_aluguel = $aluguel_perDay * $days_used;
					$discount = $this->aluguel - $new_aluguel; 
					$mensalidade = $mensalidade - $discount;
				}
				$date = (new DateTime($this->start_date));
				$newDate = $date->modify('+'.$i.' month');
                $query = "INSERT INTO mensalidades VALUES(0, '".$this->contrato_id."', '".$mensalidade."', '".$this->repasse."',  '".$this->mensalidade_status."',
                '".$this->repasse_status."', '".$newDate->format('Y-m-d')."')";
                $sql = $this->conexao->query($query);
            }else{
				if($i == $this->estadia){
					$date_end = (new DateTime($this->end_date));
					$day_end = $date_end->format('d');
					$month = $date_end->format('m');
					$year = $date_end->format('Y');
					$qt_days_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
					if($day_end != 1){
						$days_used = $day_end;
						$aluguel_perDay = $this->aluguel/$qt_days_month;
						$new_aluguel = $aluguel_perDay * $days_used;
						$discount = $this->aluguel - $new_aluguel; 
						$mensalidade = $this->mensalidade - $discount;

						$date = (new DateTime($this->start_date));
						$newDate = $date->modify('+'.$i.' month');

						$query = "INSERT INTO mensalidades VALUES(0, '".$this->contrato_id."', '".$mensalidade."', '".$this->repasse."',  '".$this->mensalidade_status."',
						'".$this->repasse_status."', '".$newDate->format('Y-m-d')."')";
						$sql = $this->conexao->query($query);
					}
				}else{
					$date = (new DateTime($this->start_date));
					$newDate = $date->modify('+'.$i.' month');
					$query = "INSERT INTO mensalidades VALUES(0, '".$this->contrato_id."', '".$this->mensalidade."', '".$this->repasse."',  '".$this->mensalidade_status."',
					'".$this->repasse_status."', '".$newDate->format('Y-m-d')."')";
					$sql = $this->conexao->query($query);
				}
            }
            
        }
		return $sql;
	}
	public function consultar($contrato_id){
		$query = "SELECT * FROM mensalidades WHERE contrato_id="."'$contrato_id'";
		$sql = $this->conexao->query($query);
		$result = mysqli_fetch_all($sql, MYSQLI_ASSOC);
		return $result;
	}
}
?>