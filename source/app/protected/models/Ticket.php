<?php

    /**
     * This is the model class for table "tickets".
     *
     * The followings are the available columns in table 'tickets':
     *
     * @property integer         $id
     * @property string          $date_create
     * @property string          $date_modified
     * @property integer         $user_id
     * @property string          $department
     * @property string          $topic
     * @property integer         $status
     *
     * The followings are the available model relations:
     * @property User            $user
     * @property TicketComment[] $ticketsComments
     */
    class Ticket
        extends CActiveRecord
    {
        /**
         * Статусы тикетов
         */
        public $statuses = [
            [
                'name'  => 'Открыт',
                'class' => 'label label-primary',
            ],
            [
                'name'  => 'Отвечен',
                'class' => 'label label-success',
            ],
            [
                'name'  => 'Закрыт',
                'class' => 'label label-danger',
            ],
        ];

        public $departments = ['all' => 'Все', 'finance' => 'Финансы', 'law' => 'Юриспруденция', 'it' => 'IT'];

        /**
         * @return string the associated database table name
         */
        public function tableName ()
        {
            return 'tickets';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules ()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array (
                array ('user_id, department, topic', 'required'),
                array ('user_id, status', 'numerical', 'integerOnly' => true),
                array ('department, topic', 'length', 'max' => 255),
                array ('date_create, date_modified', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array ('id, date_create, date_modified, user_id, department, topic, status', 'safe', 'on' => 'search'),
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
                'user'          => array (self::BELONGS_TO, 'User', 'user_id'),
                'ticketComment' => array (self::HAS_MANY, 'TicketComment', 'ticket_id'),
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
                'user_id'       => 'ID пользователя',
                'department'    => 'Раздел',
                'topic'         => 'Тема',
                'status'        => 'Статус',
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
            $criteria->compare ('user_id', $this->user_id);
            $criteria->compare ('department', $this->department, true);
            $criteria->compare ('topic', $this->topic, true);
            $criteria->compare ('status', $this->status);

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
         * @return Ticket the static model class
         */
        public static function model ($className = __CLASS__)
        {
            return parent::model ($className);
        }

        protected function beforeSave ()
        {
            $this->date_modified = new CDbExpression('NOW()');

            if ($this->isNewRecord)
            {
                $this->date_create = new CDbExpression('NOW()');
            }

            return parent::beforeSave ();
        }

    }
