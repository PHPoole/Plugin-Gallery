<?php
namespace PHPoole;

/**
 * PHPoole plugin Gallery
 */
Class Gallery extends Plugin
{
    public function postloopLoadPages($e)
    {
        $params = $e->getParams();
        extract($params);
        $gallery = array();
        if (isset($pageInfo['gallery']) && !empty($pageInfo['gallery'])) {
            $galleryIterator = new \FilesystemIterator($pageInfo['gallery']);
            foreach ($galleryIterator as $galleryFile) {
                if ($galleryFile->isFile() && strtolower($galleryFile->getExtension()) == 'jpg') {
                    $gallery[] = array(
                        'name'     => $galleryFile->getBasename(),
                        'filepath' => $galleryFile->getPathname(),
                    );
                }
            }
            $pageData['gallery'] = $gallery;
        }
        return compact('pageInfo', 'pageIndex', 'pageData');
    }

    public function postloopGenerate($e)
    {
        $phpoole = $e->getTarget();
        $params = $e->getParams();
        extract($params);
        if (isset($page['gallery']) && !empty($page['gallery'])) {
            foreach ($page['gallery'] as $image) {
                copy($image['filepath'], $phpoole->getWebsitePath() . '/' . $page['path'] . '/' . $image['name']);
                $this->imageResize($phpoole->getWebsitePath() . '/' . $page['path'] . '/' . $image['name'], 800, 600);
            }
        }
    }

    private function imageResize($file, $w, $h, $crop=FALSE)
    {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*($r-$w/$h)));
            }
            else {
                $height = ceil($height-($height*($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        }
        else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            }
            else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        imagedestroy($src);
        imagejpeg($dst, $file, 100);
    }
}