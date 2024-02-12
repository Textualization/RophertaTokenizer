<?php

namespace Textualization\Ropherta\Tokenizer;

require 'vendor/autoload.php';

class Vendor {

    public static function model() {
        return self::libDir() . '/sentencepiece.bpe.model';
    }
    
    public static function check($event=null) {
        $dest = self::model();
        
        if(file_exists($dest)) {
            echo "✔ XLM RoBERTa SentencePiece BPE Model found\n";
            return;
        }
        
        $dir = self::libDir();
        if (!file_exists($dir)) {
            mkdir($dir);
        }

        echo "Downloading XLM RoBERTa SentencePiece BPE Model...\n";

        $url="https://huggingface.co/intfloat/multilingual-e5-small/resolve/main/onnx/sentencepiece.bpe.model";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $contents = curl_exec($ch);
        curl_close($ch);
        
        //$contents = file_get_contents($url, false, stream_context_create($options));

        $checksum = hash('sha256', $contents);
        if($checksum != "cfc8146abe2a0488e9e2a0c56de7952f7c11ab059eca145a0a727afce0db2865") {
            throw new \Exception("Bad checksum: $checksum");
        }
        file_put_contents($dest, $contents);
        
        echo "✔ Success\n";        
    }

    private static function libDir() {
        return __DIR__ . '/../../lib';
    }
}
    
