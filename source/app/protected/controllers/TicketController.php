<?php

    class TicketController
        extends Controller
    {
        /**
         * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
         * using two-column layout. See 'protected/views/layouts/column2.php'.
         */
        public $layout = '//layouts/yiistrap.col2';

        /**
         * @return array action filters
         */
        public function filters ()
        {
            return array (
                'accessControl', // perform access control for CRUD operations
                'postOnly + delete', // we only allow deletion via POST request
            );
        }

        /**
         * Specifies the access control rules.
         * This method is used by the 'accessControl' filter.
         *
         * @return array access control rules
         */
        public function accessRules ()
        {
            return array (
                array (
                    'allow',  // allow all users to perform 'index' and 'view' actions
                    'actions' => array ('index', 'view'),
                    'users'   => array ('*'),
                ),
                array (
                    'allow', // allow authenticated user to perform 'open' and 'answer' actions
                    'actions' => array ('open', 'answer'),
                    'users'   => array ('@'),
                ),
                array (
                    'allow', // allow admin user to perform 'admin' and 'delete' actions
                    'actions' => array ('admin', 'close'),
                    'roles'   => array ('administrator'),
                ),
                array (
                    'deny',  // deny all users
                    'users' => array ('*'),
                ),
            );
        }

        /**
         * Displays a particular model.
         *
         * @param integer $id the ID of the model to be displayed
         */
        public function actionView ($id)
        {
            $this->render ('view', $this->loadModel ($id));
        }

        /**
         * Open a new model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         */
        public function actionOpen ()
        {
            $ticket = new Ticket;
            $ticketComment = new TicketComment;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (Yii::app ()->request->getIsPostRequest ())
            {
                $ticket->attributes = Yii::app ()->request->getPost ('Ticket');
                $ticketComment->attributes = Yii::app ()->request->getPost ('TicketComment');

                $ticket->user_id = Yii::app ()->user->id;
                $ticket->status = 0;
                $ticketComment->user_id = Yii::app ()->user->id;

                if ($ticket->validate () && $ticketComment->validate ())
                {
                    $ticket->save ();
                    $ticketComment->ticket_id = $ticket->getPrimaryKey ();
                    $ticketComment->topic_head = 1;
                    $ticketComment->save ();

                    $this->redirect (['view', 'id' => $ticket->id]);
                }
            }

            $this->render (
                'open',
                array (
                    'ticket'        => $ticket,
                    'ticketComment' => $ticketComment,
                )
            );
        }

        public function actionClose ($id)
        {
            $ticket = new Ticket;

            $model = $ticket->findByPk ($id);

            $model->status = 2;

            $model->save ();

            return $this->redirect (Yii::app ()->request->urlReferrer);
        }

        /**
         * Answer a particular model.
         * If answer is successful, the browser will be redirected to the 'view' page.
         *
         * @param integer $id the ID of the model to be answered
         */
        public function actionAnswer ($id)
        {
            $model = $this->loadModel ($id);

            switch ($model['topic_head']->status)
            {
                case 0:
                    if (!Yii::app ()->user->checkAccess ('administrator'))
                    {
                        $this->redirect (['view', 'id' => $id]);
                    }
                    break;
                case 1:
                    if (Yii::app ()->user->checkAccess ('administrator'))
                    {
                        $this->redirect (['view', 'id' => $id]);
                    }
                    break;
                case 2:
                    $this->redirect (['view', 'id' => $id]);
                    break;
            }

            $ticketComment = new TicketComment;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if (Yii::app ()->request->getIsPostRequest ())
            {
                $model['topic_head']->status = Yii::app ()->user->checkAccess ('administrator') ? 1 : 0;
                $model['topic_head']->save ();

                $ticketComment->attributes = Yii::app ()->request->getPost ('TicketComment');
                $ticketComment->ticket_id = $id;
                $ticketComment->user_id = Yii::app ()->user->id;
                $ticketComment->save ();

                $this->redirect (['view', 'id' => $id]);
            }

            $this->render (
                'answer',
                array_merge (
                    $model,
                    ['ticketComment' => $ticketComment]
                )
            );
        }

        /**
         * Lists all models.
         */
        public function actionIndex ()
        {
            if (Yii::app ()->user->isGuest)
            {
                $this->redirect (['user/login']);
            }
            if (Yii::app ()->user->checkAccess ('administrator'))
            {
                $this->redirect (['admin']);
            }

            $ticket = new Ticket;

            $dataProvider = new CActiveDataProvider(
                'Ticket', [
                            'criteria'   => [
                                'with' => [
                                    'user' => [
                                        'condition' => 'user_id=' . Yii::App ()->user->id,
                                        'together'  => true,
                                    ],
                                ],
                            ],
                            'pagination' => [
                                'pageSize' => 10,
                                'pageVar'  => 'page2',
                            ],
                            'sort'       => array (
                                'defaultOrder' => 't.date_modified DESC',
                            ),
                        ]
            );

            $this->render (
                'index',
                array (
                    'dataProvider' => $dataProvider,
                    'ticket'       => $ticket,
                )
            );
        }

        /**
         * Manages all models.
         */
        public function actionAdmin ()
        {
            $model = new Ticket('search');
            $model->unsetAttributes ();  // clear any default values
            if (isset($_GET['Ticket']))
            {
                $model->attributes = $_GET['Ticket'];
            }

            $this->render (
                'admin',
                array (
                    'model' => $model,
                )
            );
        }

        /**
         * Returns the data model based on the primary key given in the GET variable.
         * If the data model is not found, an HTTP exception will be raised.
         *
         * @param integer $id the ID of the model to be loaded
         *
         * @return array the loaded models
         * @throws CHttpException
         */
        public function loadModel ($id)
        {
            $model = new Ticket;
            $topic_head = $model->with (['ticketComment' => ['condition' => 'topic_head=1']])->findByPk ($id);
            $comments = TicketComment::model ()->findAll ('ticket_id=:ticket_id AND topic_head!=1', [':ticket_id' => $id]);

            if ($topic_head === null)
            {
                throw new CHttpException(404, 'The requested page does not exist.');
            }

            return ['model' => $model, 'topic_head' => $topic_head, 'comments' => $comments];
        }

        /**
         * Performs the AJAX validation.
         *
         * @param Ticket $model the model to be validated
         */
        protected function performAjaxValidation ($model)
        {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'ticket-form')
            {
                echo CActiveForm::validate ($model);
                Yii::app ()->end ();
            }
        }
    }
