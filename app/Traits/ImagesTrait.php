<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImagesTrait
{
    /**
     * @param $file
     * @return string
     */
    public function moveImage($file)
    {
        $name = time().'_'.$this->mainModel::SECTION.'.png';
        $file->storeAs($this->mainModel::SECTION,$name,'images');
        return $name;
    }

    /**
     * @param $file
     * @param string $oldname
     * @return string
     */
    public function updateImage($file,string $oldname)
    {
        $this->deleteImage($oldname);
        return $this->moveImage($file);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function deleteImage(string $name)
    {
        return Storage::disk('images')->delete($name);
    }


}
