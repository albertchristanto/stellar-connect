<?php

namespace Roketin;

class RImage extends Roketin
{
    public function __construct()
    {
        parent::__construct();

        $this->endPoint = '/document/api/v1/documents/temporaryImageUpload';
        
    }

    public function send($image)
    {
        $pathFile = $image->getPathname();
        $mime     = $image->getmimeType();
        $org      = $image->getClientOriginalName();

        $multipart = [
            'name'     => 'attachment[]',
            'filename' => $org,
            'Mime-Type'=> $mime,
            'contents' => fopen( $pathFile, 'r' )
        ];

        return $this->callAPI('', [$multipart], "POST", true);
    }
}
