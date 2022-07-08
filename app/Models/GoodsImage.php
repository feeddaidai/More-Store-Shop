<?php


namespace App\Models;


class GoodsImage extends BaseModel
{
    public function storage($path)
    {
        #存储三种不同大小
        $tmp              = explode('.', $path);
        $fileName         = $tmp[0];
        $fileType         = isset($tmp[1]) ? $tmp[1] : 'jpg';
        $thumb            = config('admin.thumb');
        $medium           = config('admin.medium');
        $dir              = config('admin.uploadsDir');
        $big              = $dir . $path;
        $model            = new self();
        $model->$thumb    = "$dir{$fileName}-$thumb.{$fileType}";
        $model->$medium   = "$dir{$fileName}-$medium.{$fileType}";
        $model->big_image = $big;
        $model->save();
        return $model->getKey();
    }

    public function getOne($id)
    {
        $model = new self();
        return $model->find($id)->toArray();
    }

    public function getMany($arr)
    {
        $newArr = [];
        foreach ($arr as $id) {
            $newArr[] = self::getOne($id);
        }
        return $newArr;
    }

    public function adminGetOne($id)
    {
        $model = new self();
        $data = $model->find($id)->toArray();
        foreach ($data as &$datum) {
            $datum = ltrim($datum,'/uploads');
        }
        return $data;
    }

    public function adminGetMany($arr)
    {
        $newArr = [];
        foreach ($arr as $id) {
            $newArr[] = self::getOne($id);
        }
        return $newArr;
    }




    public function getManyByStr($str)
    {
        return self::getMany(explode(',',$str));
    }

    public function storageMany($pathString)
    {
        $array = explode(',', $pathString);
        $ids   = [];
        foreach ($array as $index => $item) {
            $ids[] = self::storage($item);
        }
        return implode(',', $ids);
    }


}
