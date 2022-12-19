<?php


namespace App\Api\v1;


use App\Http\Controllers\BaseController;
use App\Models\Consignee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsigneeApi extends BaseController
{
    public function find(Request $request)
    {
        $userId = \auth()->id();
        $data   = Consignee::getAll($userId);
        $once   = false;
        foreach ($data as $index => $datum) {
            if (!$once) {
                $datum->selected = true;
                $once            = true;
            } else {
                $datum->selected = false;
            }
        }
        return m_success('成功', $data);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id',null);
        $userId = auth()->id();
        if( !$id ){
            return m_error('缺少必要参数');
        }
        Consignee::where(['id' => $id,'user_id' => $userId])->delete();
        return m_success('成功');
    }

    /**
     * 新增收件地址
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(Request $request)
    {
        $post      = $request->post();
        $userId    = \auth()->id();
        $validator = Validator::make(
            [
                'name'     => $post['name'],
                'phone'    => $post['phone'],
                'province' => $post['province'],
                'city'     => $post['city'],
                'area'     => $post['area'],
                'detail'   => $post['detail'],
            ], [
            'name'     => ['required', 'string', 'max:10', 'bail'],
            'phone'    => ['required', 'size:11', 'bail'],
            'province' => ['required', 'bail'],
            'city'     => ['required', 'bail'],
            'area'     => ['required', 'bail'],
            'detail'   => ['required', 'string', 'max:125', 'bail'],
        ], [], [
            'name'     => '收件人名字',
            'phone'    => '联系电话',
            'province' => '收件地址：省',
            'city'     => '收件地址：市',
            'area'     => '收件地址：区',
            'detail'   => '详细地址',
        ]);
        if ($validator->fails()) {
            return m_error($validator->errors()->first());
        }
        if (isset($post['id'])) {
            $model = Consignee::find($post['id']);
        } else {
            $model = new Consignee();
        }
        $model->cnee_name     = $post['name'];
        $model->mobile        = $post['phone'];
        $model->area_province = $post['province'];
        $model->area_city     = $post['city'];
        $model->area_district = $post['area'];
        $model->address_text  = $post['detail'];
        $model->user_id       = $userId;
        $model->weight        = 0;
        $model->save();
        $model->refresh();
        return m_success('添加成功', $model);
    }
}
