<?php
namespace App\Traits;
use DOMDocument;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

trait ImageTrait
{
    public function uploadImage($file, $path) {
        $extension = $file->getClientOriginalName();
        $imageName = time().'.'.$extension;
        $path      = Storage::putFileAs($path, $file, $imageName);

        return $imageName;
    }

    public function deleteImage($file, $path) {
        Storage::delete($path.$file);
    }

    public function getImageFromBlogContent($content) {
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($content);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        if(isset($images)){
            foreach ($images as $img){
                $src = $img->getAttribute('src');
                if(preg_match('/data:image/',$src)){
                    preg_match('/data:image\/(?<mime>.*?)\;/',$src,$groups);
                    $mimetype            = $groups['mime'];
                    $fileNameContent     = uniqid();
                    $fileNameContentRand = substr(md5($fileNameContent),6,6).'_'.time();
                    $fileNameFinal       = $fileNameContentRand.'.'.$mimetype;
                    $filepath            = ("../public/storage/blog_images/".$fileNameFinal);
                    $image               = Image::make($src)
                                                ->encode($mimetype,100)
                                                ->save($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', Storage::url('blog_images/'.$fileNameFinal));
                }
            }
            $dom->removeChild($dom->doctype);  
            $content = $dom->saveHTML(); 
            $content = str_replace('<html><body>', '', $content);
            $content = str_replace('</body></html>', '', $content);
            return $content;
        }
    }
}
