<?php

    class UserController
        extends Controller
    {
        public function actions ()
        {
            // captcha action renders the CAPTCHA image displayed on the contact page
            return array (
                'captcha' => array (
                    'class'     => 'CCaptchaAction',
                    'backColor' => 0xFFFFFF,
                ),
                'page'    => array (
                    'class' => 'CViewAction',
                ),
            );
        }

        public function actionIndex ()
        {
        }

        public function actionRegister ()
        {
            $model = new User;

            if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-register-form')
            {
                echo CActiveForm::validate ($model);
                Yii::app ()->end ();
            }

            if (isset($_POST['User']))
            {
                $model->setAttribute ('role', $model::ROLE_USER);

                $model->attributes = $_POST['User'];

                if ($model->validate ())
                {
                    if ($model->save ())
                    {
                        $this->redirect (array ('user/login'));
                    }

                    return;
                }
            }
            $this->render ('register', array ('model' => $model));
        }

        /**
         * Displays the login page
         */
        public function actionLogin ()
        {
            $model = new UserLogin;

            // if it is ajax validation request
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-login-form')
            {
                echo CActiveForm::validate ($model);
                Yii::app ()->end ();
            }

            // collect user input data
            if (isset($_POST['UserLogin']))
            {
                $model->attributes = $_POST['UserLogin'];
                // validate user input and redirect to the previous page if valid
                if ($model->validate () && $model->login ())
                {
                    $this->redirect (Yii::app ()->user->returnUrl);
                }
            }
            $this->render ('login', array ('model' => $model));
        }

        /**
         * Logs out the current user and redirect to homepage.
         */
        public function actionLogout ()
        {
            Yii::app ()->user->logout ();
            $this->redirect (Yii::app ()->homeUrl);
        }
    }