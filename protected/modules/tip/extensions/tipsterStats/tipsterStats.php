<?php

class tipsterStats
{
	public $tipster_id;
	public $year;
	public $month;
	
	public $AllStake;
	
	public $attributes;
	
	function __construct($t, $m, $y){
		$this->tipster_id = $t;
		$this->year       = $y;
		$this->month      = $m;
	}
	
	public function calc(){
	
		$d = '01-'.$this->month.'-'.$this->year.' 00:00:00';
		$s = strtotime($d);
		$f = strtotime('+1 month -1 day', $s);
		$r = array(
			'tipster_id'   => $this->tipster_id,
			'month'  => $this->month,
			'year'   => $this->year,
			'profit' => 0,
			'yield'  => 0,
			'stake'  => 0,
			'bank'   => 0,
			'count_won'    => 0,
			'count_lost'   => 0,
			'count_void'   => 0,
		);
		
		// получить все типсы за месяц
		$c = new CDbCriteria();
		$c->addBetweenCondition('event_date', $s, $f);
		
		if($this->tipster_id!=0)
			$model     = Tips::model()->published()->closed()->byTipster($this->tipster_id)->findAll($c);
		else
			$model     = Tips::model()->published()->closed()->findAll($c);

		$r['tipscount'] = count($model);
		
		foreach($model AS $k=>$item){
			
			$r['profit'] += $item->TempProfit;
			$r['stake']  += $item->stake;
			
			SWITCH($item->tip_result){
				CASE Tips::TIP_RESULT_WON:  $r['count_won']++;  break;
				CASE Tips::TIP_RESULT_HALF: $r['count_won']++;  break;
				CASE Tips::TIP_RESULT_LOST: $r['count_lost']++; break;
				CASE Tips::TIP_RESULT_VOID: $r['count_void']++; break;
				CASE Tips::TIP_RESULT_HALF_LOST: $r['count_lost']++; break;
			}
		}
		
		if(count($model)>0){
		
			//$p_bank = isset($item[$k-1]) ? $item[$k-1] : Tips::BANK;
			$p_m = ($this->month==1)  ? 12            : $this->month-1;
			$p_y = ($this->month==1)  ? $this->year-1 : $this->year;
			
			$p_bank = Tipstats::model()->findByattributes(array(
				'month' => $p_m,
				'year'  => $p_y,
				'tipster_id' => $this->tipster_id
			));
			
			if($p_bank==null){
				$p_bank = Tips::BANK;
			}else{
				$p_bank = $p_bank->bank;
			}
			
			$r['stake'] = $r['stake']==0 ? 1 : $r['stake'];
			
			//$r['yield'] = ($r['profit']==0) ? 0 : round($r['profit'] / $r['stake'],2);
			$r['bank']   = $p_bank + $r['profit'];
			$p_bank      = ($p_bank==0) ? 1 : $p_bank;
			$r['profit'] = ($r['profit']==0) ? 1 : $r['profit'];
			//$r['yield']  = round($r['profit'] / $p_bank * 100, 2);
			
			if($r['profit'] > 0)
				$r['yield']  = round($r['profit'] / $r['stake'] * 100, 2);
			else
				$r['yield']  = round($r['profit'] / $r['stake'] * 100, 2);
			
			$this->AllStake = $r['stake'];
			//echo '<!--'.$r['profit'].' / '.$r['stake'].' / 100 = '.$r['yield'].'-->';
		
		}
		
		unset($r['stake']);
		
		return $this->attributes = $r;
	}
}