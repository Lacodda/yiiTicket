<?php

    /**
     * This is the model class for table "tickets_comments".
     *
     * The followings are the available columns in table 'tickets_comments':
     *
     * @property integer $id
     * @property string  $date_create
     * @property integer $ticket_id
     * @property integer $user_id
     * @property integer $topic_head
     * @property string  $text
     *
     * The followings are the available model relations:
     * @property Ticket  $ticket
     * @property User    $user
     */
    class TicketComment
        extends CActiveRecord
    {
        /**
         * @return string the associated database table name
         */
        public function tableName ()
        {
            return 'tickets_comments';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules ()
        {
            // NOTE: you should only define rules for those attributes that
            // will receive user inputs.
            return array (
                array ('user_id, text', 'required'),
                array ('ticket_id, user_id, topic_head', 'numerical', 'integerOnly' => true),
                array ('date_create', 'safe'),
                // The following rule is used by search().
                // @todo Please remove those attributes that should not be searched.
                array ('id, date_create, ticket_id, user_id, topic_head, text', 'safe', 'on' => 'search'),
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
                'ticket' => array (self::BELONGS_TO, 'Ticket', 'ticket_id'),
                'user'   => array (self::BELONGS_TO, 'User', 'user_id'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels ()
        {
            return array (
                'id'          => 'ID',
                'date_create' => 'Дата создания',
                'ticket_id'   => 'ID тикета',
                'user_id'     => 'ID пользователя',
                'text'        => 'Текст',
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
            $criteria->compare ('ticket_id', $this->ticket_id);
            $criteria->compare ('user_id', $this->user_id);
            $criteria->compare ('text', $this->text, true);

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
         * @return TicketComment the static model class
         */
        public static function model ($className = __CLASS__)
        {
            return parent::model ($className);
        }

        protected function beforeSave ()
        {
            if ($this->isNewRecord)
            {
                $this->date_create = new CDbExpression('NOW()');
            }

            return parent::beforeSave ();
        }
    }
