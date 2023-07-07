<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model {

	use SoftDeletes;
    protected $table = 'email_templates';
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
        'email_type','subject','message','tokens','created_user_id','updated_user_id'
    ];
    

    public function parse($data) {
        $parsed = preg_replace_callback('/{{(.*?)}}/', function ($matches) use ($data) {
            list($shortCode, $index) = $matches;

            if( isset($data[$index]) ) {
                return $data[$index];
            } else {
                throw new Exception("Shortcode {$shortCode} not found in template id {$this->id}", 1);   
            }

        }, $this->content);

        return $parsed;
    }

    public function saveData($data){
    	
    	$saveData = [
            'email_type' => $data['email_type'],
            'subject' => $data['subject'],
            'message' => $data['message'],
            'tokens' => $data['tokens'],
            'updated_user_id' => $data['user_id']
        ];

    	// for update
    	if(!empty($data['id'])){
    		$modelObj = $this::where("id","=",$data['id'])->first();
    		// this means invalid uuid provided
    		if(empty($modelObj)){
    			return false;
    		}

    		$this::where('id', $modelObj->id)->update($saveData);
    		return true;

    	}else{ // for insert
    		$saveData['created_user_id'] = $data['user_id'];
			$this::create($saveData);
			return true;
    	}
    	
    }
   
}
