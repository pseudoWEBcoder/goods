<?php

namespace frontend\controllers;

use common\models\Items;
use common\models\ItemsSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\StringHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Items models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Displays a single Items model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCommit($id)
    {
        $model = $this->findModel($id);
        $model->reason = date("Y-m-d H:i:s");
        if (/*$model->load(Yii::$app->request->post()) && */
        $model->save()) {
            return $this->goBack();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Items();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->item_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('insert');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//
//            // get the uploaded file instance. for multiple file uploads
//            // the following data will return an array
//            $image = UploadedFile::getInstance($model, 'image');
//
//
//            $ffinfo  =  pathinfo( $image->name);
//            $ext =$ffinfo['extension'];
//
//            // generate a unique file name
//            $name = $model::rus2translit($image->name).date('__(d_m_Y_H-i-s)').".{$ext}";
//
//            // the path to save file, you can set an uploadPath
//            // in Yii::$app->params (as used in example below)
//            $path = Yii::getAlias('@common/'.Yii::$app->params['uploadImagesPath'] . '/'.$name);
//
//            if($image->saveAs($path)){
//                $model->addImage($path);
//                $model->save();
//                return $this->redirect(['view', 'id'=>$model->item_id]);
//            } else {
//                // error in saving model
//            }
            return $this->redirect(['view', 'id' => $model->item_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateImages($action, $id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);
        if (!$model) {
            $response['error'] = " не  правильный  ИД  ";
            return $response;
        }
        if ($action == 'delete') {
            try {
                $file = $model->linkedFiles('image');
                $key = (int)Yii::$app->request->post('key', $no = md5('not  set'));
                if (($key === $no) or !is_numeric($key) or (!isset($file[$key]))) {
                    $response['error'] = " не  правильный  key  ";
                    return $response;
                }
                $model->deleteFiles('image', $file[$key]);
            } catch (Exception $e) {
                $response['error'] = $e->getMessage();
            }
        }
        if ($action == 'upload') {
            try {
                $model->scenario = 'insert';
                $data = [StringHelper::basename(get_class($model)) => ['image']];
                if ($model->load($data)) {
                    if ($model->save()) {
                        $response = "OK  сохранилось";
                        return $response;
                    } else {
                        $response['error'] = " не  сохраняется ";
                        return $response;
                    }
                } else {
                    $response['error'] = implode('<br>', $model->getErrors());
                    return $response;
                }
            } catch (Exception $e) {
                $response['error'] = $e->getMessage();
            }

        }
        return 'невозможно удалить';


    }

    /**
     * Deletes an existing Items model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
}
