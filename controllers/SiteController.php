<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use app\models\ContactoPersonal;
use app\models\Departamento;
//use vendor\user\models\LoginForm;

use mPDF;
use PHPMailer;

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
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'successCallback'],
            ],
        ];
    }

    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        // user login or signup comes here
    }

    public function actionIndex()
    {
        //$login = SecurityController::actionLogin();
        $query = (new \yii\db\Query())
        ->select('rendimiento_personal, nombre_personal, id_personal')
        ->from('lch_personal');

        $rendimiento = $query->all();
        //Se le pasa el rendimiento del personal para poder mostrarlo en el modal si hiciera falta.
        return $this->render('index', ['rendimiento' => $rendimiento]);
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

    public function actionSearch()
    {

        //Se buscan todos los users en la tabla user y se pasan a la vista correspondiente.
        $query = (new \yii\db\Query())
        ->select('username')
        ->from('user');

        $model = $query;
        return $this->render('search', ['model' => $model]);

    }

    public function actionCalendar()
    {
        //Inicializa la vista del calendario para asignar proyectos.
        return $this->render('calendar');
    }

    //Acción que genera el pdf usando la librería mpdf.
    public function actionPdf() {
 
        $query = (new \yii\db\Query())
        ->select('id_dep, nombre_dep, descripcion_dep')
        ->from('lch_departamentos');

        $departamentos = $query->all();

        $html = "<h4> Departamentos de los creativos de hawkins </h4>";

        //Se recorre la consulta y se van introduciendo los datos en una cadena html.
        for ($i=0; $i < count($departamentos) ; $i++) { 
               $id_dep = $departamentos[$i]['id_dep'];
               $nombre_dep = $departamentos[$i]['nombre_dep'];
               $descripcion_dep = $departamentos[$i]['descripcion_dep'];
               $html = $html."<div><p>Departamento número : $id_dep</p><p> nombre : $nombre_dep</p><p> descripción : $descripcion_dep</p></div>";
            }

        $mpdf = new mPDF;
        $mpdf->WriteHTML($html);
        $mpdf->Output();

        exit;
    }

    //Acción que genera el excell usando la librería phpEXCELL, se sacará el nombre del trabajador junto al departamento en el que trabaja.
    //select nombre_personal, nombre_dep from lch_personal per, lch_departamentos dep, lch_departamentos_have_personal dep_per where per.id_personal = dep_per.id_personal and dep.id_dep = dep_per.id_dep;
    public function actionExcell()
    {

        $query = (new \yii\db\Query())
        ->select('nombre_personal, nombre_dep')
        ->from(['lch_personal', 'lch_departamentos', 'lch_departamentos_have_personal'])
        ->where('lch_personal.id_personal = lch_departamentos_have_personal.id_personal')
        ->andWhere('lch_departamentos.id_dep = lch_departamentos_have_personal.id_dep');

        $pers_dep = $query->all();

        return $this->render('excell', ['pers_dep' => $pers_dep]);

    }

    //Acción que renderiza la vista que envia un mail.
    public function actionMail()
    {
        return $this->render('mail');
    }

    //Renderiza la vista para mandar correos personales.
    public function actionContactopersonal(){

        $model = new ContactoPersonal();

        if($model->load(Yii::$app->request->post())){

            $mail = new PHPMailer;

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = $model['email'];
            $mail->Password = $model['password']; 
            $mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

            $mail->From = $model['email'];
            $mail->FromName = $model['name'];
            $mail->addAddress($model['to']);     // Add a recipient

            $mail->Subject = $model['subject'];
            $mail->Body    = $model['body'];
            $mail->AltBody = $model['subject'];

            if(!$mail->send()) {
                echo 'El mensaje no ha podido ser enviado.';
                echo 'Error: ' . $mail->ErrorInfo;
            } else {
                return $this->render('mailenviado', ['model' => $model]);
            }

        }
        else{
            return $this->render('contactopersonal', ['model' => $model]);
        }

    }

    //Acción que renderiza la vista chart.
    public function actionChart()
    {
        
        $query = (new \yii\db\Query())
        ->select('rendimiento_personal, nombre_personal, id_personal')
        ->from('lch_personal');

        $rendimiento = $query->all();

        for ($i=0; $i < count($rendimiento) ; $i++) { 
            $nota_rendimiento[$i] = $rendimiento[$i]['rendimiento_personal'] * 10;
            $nombre_personal[$i] = $rendimiento[$i]['nombre_personal'];
            $id_personal[$i] = $rendimiento[$i]['id_personal'];
        }

        return $this->render('chart', ['nota_rendimiento' => $nota_rendimiento, 'nombre_personal' => $nombre_personal, 'id_personal' => $id_personal]);
    }
    }

   /* public function actionDepdrop()
    {

        $model = (new \yii\db\Query())
        ->select('id_dep')
        ->from('lch_departamentos');
        return $this->render('depdrop', ['model' => $model]);
    }
    */
