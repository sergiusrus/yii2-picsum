<?php

namespace app\controllers;

use app\models\Pic;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\jobs\PicIdSave;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
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
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * @return int
     */
    private static function get_random_id(): int
    {
        return random_int(1, 1000);
    }

    /**
     * Displays homepage.
     *
     * @return string|Response
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            Yii::$app->queue->push(new PicIdSave([
                'image_id' => $request->getBodyParam('image-id'),
                'approval' => $request->getBodyParam('approval'),
            ]));
            return $this->redirect('/');
        } else {
            $image_id = self::get_random_id();
            $image_ids = Pic::find()->select(['image_id'])->asArray()->column();

            while(in_array($image_id, $image_ids)) {
                $image_id = self::get_random_id();
            }

            $client = new Client();
            try {
                $response = $client->request('GET', "https://picsum.photos/id/$image_id/600/500");
                $body = $response->getBody()->getContents();
                $base64 = base64_encode($body);
                $mime = $response->getHeader('content-type')[0];
                $image = ('data:' . $mime . ';base64,' . $base64);
            } catch (ClientException | ConnectException $e) {
                $image = false;
            }
            return $this->render('index', compact('image', 'image_id'));
        }


    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
