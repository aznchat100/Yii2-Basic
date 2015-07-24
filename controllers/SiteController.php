<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;
use yii\data\Pagination;
use app\models\Country;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\StockForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            //return $this->redirect($model->username);
            return $this->redirect(['site/upload']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

   public function actionSay($message2 = 'Hello')
    {
        $password = "test";
        $hash = Yii::$app->getSecurity()->generatePasswordHash($password);
    
        //echo "$hash";
    
        if (Yii::$app->getSecurity()->validatePassword($password, $hash)) {
            return $this->render('say', ['message'=>'successfully']);
        } else {
            return $this->render('say', ['message'=>'Wrong']);
        }
    }

    public function actionEntry()
    {
        $model = new EntryForm();
        //$this->render('entry', ['model' => $model]);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }
    }

    public function actionCountry()
    {
        $query = Country::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $countries = $query->orderBy('name')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('country', [
            'countries' => $countries,
            'pagination' => $pagination,
        ]);
    }

    public function actionUpload()
    {
        $model2 = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model2->imageFile = UploadedFile::getInstance($model2, 'imageFile');
            if ($model2->upload()) {
                // file is uploaded successfully
                return $this->goHome();
            }
        }

        return $this->render('upload', ['model' => $model2]);
    }

    public function actionChart($ticker = 'aapl', $timeframe = 'daily')
    {
        $model = new StockForm;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($model->timeframe === 'weekly') {
                $model->timeframe = '0&p=w';
            } elseif ($model->timeframe === 'monthly') {
                $model->timeframe = '0&p=m';
            } else {
                $model->timeframe = '1&p=d';
            }
            return $this->render('chart', ['ticker' => $model->ticker, 'timeframe' => $model->timeframe]);

        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('chartform', ['model' => $model]);
        }
    }
}
