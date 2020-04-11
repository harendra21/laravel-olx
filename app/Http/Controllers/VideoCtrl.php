<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FFMpeg;

class VideoCtrl extends Controller
{
    //

    public function index(Request $request){
        $data = [];

        
        return view('pages.home')->with($data);
    }


    public function video_upload(Request $request){
        $file = $request->file('file');
        $destinationPath = 'uploads';
        $isUploaded = $file->move($destinationPath,time().'_'.$file->getClientOriginalName());
        return array('File Uploaded',true);

    }

    public function convert(){
       

        // $lowBitrate = (new X264)->setKiloBitrate(250);
        // $midBitrate = (new X264)->setKiloBitrate(500);
        // $highBitrate = (new X264)->setKiloBitrate(1000);

       
        FFMpeg::create([
            'ffmpeg.binaries'  => 'C:/ffmpeg/bin/ffmpeg.exe', // the path to the FFMpeg binary
            'ffprobe.binaries' => 'C:/ffmpeg/bin/ffprobe.exe', // the path to the FFProbe binary
            'timeout'          => 3600, // the timeout for the underlying process
            'ffmpeg.threads'   => 12,   // the number of threads that FFMpeg should use
        ])-> fromDisk('videos')
            ->open('1580021157_5 Taara _Full Song_ - Diljit Dosanjh _ Latest Punjabi Songs 2015 _ Speed Rec.mp4')
            ->addFilter(function ($filters) {
                $filters->resize(new \FFMpeg\Coordinate\Dimension(640, 480));
            })
            ->export()
            ->toDisk('converted_videos')
            ->inFormat(new \FFMpeg\Format\Video\X264)
            ->save('small_steve.mkv');
    }

}
