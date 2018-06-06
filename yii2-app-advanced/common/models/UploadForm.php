<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $uploadedFile;
    public $truncateItems;
    public $truncateReceipt;
    public $_massages;
    public $countreceiptsok = 0;
    private $saved_as;
    private $content;
    private $json;
    private $countitemsok = 0;

    public function rules()
    {
        return [
            [['uploadedFile'], 'file', 'skipOnEmpty' => false,],
            ['truncateReceipt', 'boolean'],
            ['truncateItems', 'boolean'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->saved_as = \Yii::getAlias('@frontend/uploads/') . $this->uploadedFile->baseName . '.' . $this->uploadedFile->extension;
            $this->uploadedFile->saveAs($this->saved_as);
            return true;
        } else {
            return false;
        }
    }

    public function exec()
    {
        $this->content = file_get_contents($this->saved_as);
        $this->json = json_decode($this->content, 1);
        $this->insert();
    }

    private function insert()
    {
        $this->findNeField();
        $transaction = Yii::$app->db->beginTransaction();
        if ($this->truncateItems) {
            $statusItemsdeleteAll = Items::deleteAll();
            $this->addMessage($statusItemsdeleteAll == 0, Items::tableName() . ($statusItemsdeleteAll ? ' записи удалены' : 'ошибка  очистки'));
            $statusItems = Yii::$app->db->createCommand()->truncateTable(Items::tableName())->execute();
            $this->addMessage($statusItems == 0, Items::tableName() . ($statusItems !== false ? ' очищена' : 'ошибка  очистки'));
        }
        if ($this->truncateReceipt) {
            $statusReceiptdeleteAll = Receipt::deleteAll();
            $this->addMessage($statusReceiptdeleteAll == 0, Receipt::tableName() . ($statusReceiptdeleteAll ? ' записи удалены' : 'ошибка  очистки'));
            $statusReceipt = Yii::$app->db->createCommand()->truncateTable(Receipt::tableName())->execute();
            $this->addMessage($statusReceipt == 0, Receipt::tableName() . ($statusReceipt ? ' очищена' : 'ошибка  очистки'));
        }
        foreach ($this->json as $idocument => $receiptitem) {
            $data = $receiptitem['document']['receipt'];
            $receipt = new Receipt($data);
            $receipt_saved = $receipt->save(false);
            if ($receipt_saved)
                $this->countreceiptsok++;
            foreach ($data['items'] as $index => $item) {
                $item = new Items($item);
                $item->receipt_id = $receipt->receipt_id;
                $saved = $item->save(false);
                if ($saved)
                    $this->countitemsok++;
            }
        }
        $transaction->commit();
        $this->addMessage(true, Receipt::tableName() . ($statusReceipt ? ' добавлено' . $this->countreceiptsok : 'ошибка  добавления'));
        $this->addMessage(true, Items::tableName() . ($statusReceipt ? ' добавлено' . $this->countitemsok : 'ошибка  добавления'));
    }

    private function findNeField()
    {
        $r = new \common\models\Receipt();
        $attr = $r->getAttributes();
        $i = new \common\models\Items;$k =0;
        $iAttr = $i->getAttributes();
        foreach ($this->json as $idocument => $receiptitem) {
            $data = $receiptitem['document']['receipt'];
            foreach ($data as $index => $datum) {
                if (!array_key_exists($index, $attr))
                    $new [$index] = 'ALTER TABLE `receipt` ADD `' . $index . '` VARCHAR(500) NULL DEFAULT NULL;';

            }
            foreach ($data['items'] as $index => $item) {
                foreach ($item as $i => $v) {$k++;
                    if (!array_key_exists($i, $iAttr)) {
                        if (is_array($v))
                            $type = 'json';
                        if (is_numeric($v))
                            $type = 'INT(10)';
                        if (is_null($type))
                            $type = 'VARCHAR(500)';
                        $newItems [$i] = 'ALTER TABLE `items` ADD `' . $i . '` ' . $type . ' NULL DEFAULT NULL;';
                        unset($type);
                    }
                }
            }
        }
        return [$new, $newItems];
    }

    private function addMessage($status, $string)
    {
        $this->_massages[] = [$status, $string];
    }
}