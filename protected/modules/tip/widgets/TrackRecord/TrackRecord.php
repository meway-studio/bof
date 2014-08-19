<?php
/**
 * TrackRecord class file.
 *
 * @author egoss <dev@egoss.ru>
 */
 
class TrackRecord extends CWidget
{
	protected $data;
	
	public function init(){
		
		$sum = Yii::app()->db->createCommand()
			->select('SUM(`profit`) AS `profit`, SUM(`winrate`) AS `winrate`')
			->from('me_tipsters t1')
			->join('me_users t2', 't1.user_id=t2.id AND t2.status=1 AND t2.role=3')
			->queryRow();
		
		$allStake = Yii::app()->db->createCommand()
			->select('SUM(`stake`) AS `sum`')
			->from('{{tips}} t1')
			->join('me_users t2', 't1.tipster_id=t2.id AND t2.status=1 AND t2.role=3')
			->queryRow();

		$tips_cnt = 0; /*Yii::app()->db->createCommand()
			->select('COUNT(*) AS `count`')
			->from('{{tips}}')
			->where('status=:S', array(':S'=>Tips::STATUS_ACTIVE))
			->queryRow();*/
		

		$tipsters = User::model()->byRole(User::ROLE_TIPSTER)->showInStatistic()->with('tipster')->findAll();

		foreach ($tipsters as $item)
			$tips_cnt += $item->tipster->tips;

		$data = array(
			'tipsters_count' => User::model()->active()->tipsterRole()->showInStatistic()->count(),
			'tips_count' => $tips_cnt,
			//'tips_count'     => Tips::model()->published()->count(),
			'all_stakes'     => Tips::model()->published()->count(),
			'all_winrate'    => round($sum['profit'] / $allStake['sum'] * 100, 2),
			'all_profit'     => round($sum['profit'], 2),
			'years'          => date('Y')-2011,
		);
		
		$this->data = $data;
	}
	
	public function run(){
		$this->render('view', array('data'=>$this->data));
	}

}