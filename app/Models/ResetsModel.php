<?php namespace App\Models;

use CodeIgniter\Model;

class ResetsModel extends Model{
	protected $table 			= 'wk_restablecer';
	protected $primaryKey 		= 'id_res';
	protected $allowedFields 	= ['id_res', 'fc_res', 'correo', 'uuid', 'fe_res', 'edo_res', 'ip_res', 'usuario'];
	//protected $returnType 		= 'object';
	protected $useTimestamps 	= false;
	protected $beforeInsert 	= ['beforeInsert'];

	protected function beforeInsert(array $data){
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function beforeUpdate(array $data){
		$data = $this->passwordHash($data);
		return $data;
	}

	protected function passwordHash(array $data){
		if(isset($data['data']['password'])){
			$data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
		}
		return $data;
	}
}
