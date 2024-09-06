<?php

namespace App\Repositories\Dashboard;

use App\Traits\MainTrait;

class Repository
{
    use MainTrait;
    public $endPoint;
    public $mainModel;

    /**
     * @param string $page
     * @param $title
     * @param array $merged_data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function customView(string $page,$title,array $merged_data)
    {
        $data = array_merge($this->mainData($title),$merged_data);
        return view($this->endPoint.'.'.$this->mainModel::SECTION.'.'.$page,compact('data'));
    }
}
