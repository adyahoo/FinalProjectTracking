<?php
namespace App\Traits;
use DOMDocument;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

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
        $dom = new DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image){
            $data = $image->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $imgeData   = base64_decode($data);
            $image_name = time().$item.'.jpg';
            file_put_contents('../public/storage/blog_images/'.$image_name, $imgeData);
            
            $image->removeAttribute('src');
            $image->setAttribute('src', Storage::url('blog_images/'.$image_name));
        }

        $content = $dom->saveHTML();

        return $content;
    }
}
