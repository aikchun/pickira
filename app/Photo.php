<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = [
        'path'
    ];

    protected $baseDir = 'flyers/photos';

    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;
        $filename = time().$file->getClientOriginalName();
        $photo->path = '/'.$photo->baseDir . '/' . $filename;
        $file->move($photo->baseDir, $filename);
        return $photo;
    }

}
