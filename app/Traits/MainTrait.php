<?php

namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

Trait MainTrait
{
    public function mainData($pageTitle)
    {
        return [
            'user' => Auth::user(),
            'section' => $this->mainModel::SECTION,
            'pageTitle' => $pageTitle,
        ];
    }

    /**
     * @param string $page
     * @param $title
     * @param array $merged_data
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function customView(string $page,$title,array $merged_data)
    {
        $data = array_merge($this->mainData($title),$merged_data);
        return view($this->mainRoute.'.'.$page,compact('data'));
    }

    public function backHome($message)
    {
        Alert::success('Done', $message);
        return redirect()->route($this->mainRoute.'.index');
    }

    /**
     * @param $route
     * @param array $message ['status' => , 'body' => ]
     * @return \Illuminate\Http\RedirectResponse
     */
    public function backTo($route,array $message)
    {
        Alert::success($message['status'], $message['body']);
        return redirect()->route($route);
    }
}
