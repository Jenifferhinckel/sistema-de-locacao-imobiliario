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
	public function cadastrar_mensalidades(){
        for ($i=0; $i <= $this->estadia; $i++) { 
            if($i == 0){
                $query = "INSERT INTO mensalidades VALUES(0, '".$this->contrato_id."', '".$this->mensalidade."', '".$this->repasse."',  '".$this->mensalidade_status."',
                '".$this->repasse_status."', '".$this->start_date."')";
                $sql = $this->conexao->query($query);
            }else{
                $date = (new DateTime($this->start_date));
                $newDate = $date->add(new DateInterval('P'.$i.'M')); 
                $query = "INSERT INTO mensalidades VALUES(0, '".$this->contrato_id."', '".$this->mensalidade."', '".$this->repasse."',  '".$this->mensalidade_status."',
                '".$this->repasse_status."', '".$newDate->format('Y-m-d')."')";
                $sql = $this->conexao->query($query);
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