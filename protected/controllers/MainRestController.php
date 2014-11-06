<?php

class MainRestController extends RestController
{
	public function actionIndex()
	{
        $api = Yii::app()->request->getParam('api');
        $q = Yii::app()->request->getParam('q');


        if(!isset($api)){
            throw new \CHttpException(405, "Parameter 'api' can not be empty");
        }

        if(!isset($q)){
            throw new \CHttpException(405, "Parameter 'q' can not be empty");
        }

        $documents = Documents::model()->findAllByAttributes(array(
            'clientid'=>(int)$q
        ));
        $data = array();
        /* @var $document Documents*/
        if($documents){
            foreach($documents as $i=>$document){
                $data[$i]=array(
                    'id'=>$document->id,
                    'clientid'=>$document->clientid,
                    'description'=>$document->description,
                    'docamount'=>(float)number_format($document->docamount, 2, '.', ''),
                    'docdate'=>date('d/m/Y', strtotime($document->docdate)),
                    'filepath'=>$document->filepath
                );
            }
        }

        $this->render('index', array('clients'=>$data), false);
	}
}