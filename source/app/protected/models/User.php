<?php

    /**
     * This is the model class for table "users".
     *
     * The followings are the available columns in table 'users':
     *
     * @property integer         $id
     * @property string          $date_create
     * @property string          $date_modified
     * @property string          $login
     * @property string          $password
     * @property string          $role
     * @property string          $email
     *
     * The followings are the available model relations:
     * @property Ticket[]        $ticket
     * @property TicketComment[] $ticketComment
     */
    class User
        extends CActiveRecord
    {
        public $password;

        public $verifyCode;

        const ROLE_ADMIN = 'administrator';

        const ROLE_MODER = 'moderator';

        const ROLE_USER = 'user';

        const ROLE_BANNED = 'banned';

        /**
         * @return string the associated database table name
         */
        public function tableName ()
        {
            return 'users';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules ()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array (
                array ('login, password, role, email, verifyCode', 'required'),
                array ('login, email', 'unique'),
                array ('login, password, role, email', 'length', 'max' => 255),
                array ('date_create, date_modified', 'safe'),
                array ('email', 'email'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array ('id, date_create, date_modified, login, password, role, email', 'safe', 'on' => 'search'),
                array ('verifyCode', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements ()),
            );
        }

        /**
         * @return array relational rules.
         */
        public function relations ()
        {
            // NOTE: you may need to adjust the relation name and the related
            // class name for the relations automatically generated below.
            return array (
                'ticket'        => array (self::HAS_MANY, 'Ticket', 'user_id'),
                'ticketComment' => array (self::HAS_MANY, 'TicketComment', 'user_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels ()
        {
            return array (
                'id'            => 'ID',
                'date_create'   => 'Дата создания',
                'date_modified' => 'Дата изменения',
                'login'         => 'Логин',
                'password'      => 'Пароль',
                'role'          => 'Роль',
                'email'         => 'Email',
                'verifyCode'    => 'Проверочный код',
            );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         *
         * Typical usecase:
         * - Initialize the model fields with values from filter form.
         * - Execute this method to get CActiveDataProvider instance which will filter
         * models according to data in model fields.
         * - Pass data provider to CGridView, CListView or any similar widget.
         *
         * @return CActiveDataProvider the data provider that can return the models
         * based on the search/filter conditions.
         */
        public function search ()
        {
            // @todo Please modify the following code to remove attributes that should not be searched.

            $criteria = new CDbCriteria;

            $criteria->compare ('id', $this->id);
            $criteria->compare ('date_create', $this->date_create, true);
            $criteria->compare ('date_modified', $this->date_modified, true);
            $criteria->compare ('login', $this->login, true);
            $criteria->compare ('password', $this->password, true);
            $criteria->compare ('role', $this->role, true);
            $criteria->compare ('email', $this->email, true);

            return new CActiveDataProvider(
                $this, array (
                         'criteria' => $criteria,
                     )
            );
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         *
         * @param string $className active record class name.
         *
         * @return User the static model class
         */
        public static function model ($className = __CLASS__)
        {
            return parent::model ($className);
        }

        protected function beforeSave ()
        {
            $this->password = md5 ($this->password);
            $this->date_modified = new CDbExpression('NOW()');

            if ($this->isNewRecord)
            {
                $this->date_create = new CDbExpression('NOW()');
            }

            return parent::beforeSave ();
        }
    }
