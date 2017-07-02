<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

class Category extends ActiveRecord
{
	public static function tableName()
	{
		return "category";
    }

    public function attributeLabels()
    {
        return [
            'parentid'=>'上级分类',
            'title'=>'标题'
        ];
    }

    public function rules()
    {
       return  [
           ['parentid', 'required', 'message'=>'填写上级分类！', 'on'=>['add']],
           ['title', 'required', 'message'=>'填写标题！', 'on'=>['add']],
       ];
    }

    public function add($data)
    {
        $this->scenario = "add";
        $this->createtime = time();
        if($this->load($data) && $this->save()){
            return true;
        }
        return false;
    }

    public function getOptions()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        $options = ["请添加分类"];
        foreach($tree as $cate){
            $options[$cate['cateid']] = $cate['title'];
        } 
        return $options;
    }

    public function getTree($cates, $pid=0)
    {
        $tree = [];
        foreach ($cates as $i => $m){
            if($m['parentid'] == $pid){
                $tree[] = $m;
                $tree = array_merge($tree, $this->getTree($cates, $m['cateid']));
            }
        }
        return $tree;
    }

    public function getData()
    {
        $cates = self::find()->all();
        $cates = ArrayHelper::toArray($cates);
        return $cates;
    }

    public function setPrefix($data, $p = "|---")
    {
        $tree = [];
        $num = 1;
        $prefix = [0 => 1];
        while($val = current($data)){
            $key = key($data);
            if($key>0){
                if($data[$key-1]['parentid'] != $val['parentid']){
                    $num++;
                }
            }
            if(array_key_exists($val['parentid'], $prefix)){
                $num = $prefix[$val['parentid']];
            }
            $val['title'] = str_repeat($p, $num).$val['title'];
            $prefix[$val['parentid']] = $num;
            $tree[] = $val;
            next($data);
        }
        return $tree;
    }

    public function getTreelist()
    {
        $data = $this->getData();
        $tree = $this->getTree($data);
        $tree = $this->setPrefix($tree);
        return $tree;

    }

    public function modify($id, $data)
    {
        if ($this->load($data) && $this->validate()) 
        {
            return $this->updateAll($data['Category'], 'cateid = :id', [':id'=>$id]);
        }
        return false;
    }

    public function getCateById($id)
    {
        $cate = self::find()->where('cateid = :id', [':id'=>$id])->one()->title;
        return $cate;
    }

}


?>
