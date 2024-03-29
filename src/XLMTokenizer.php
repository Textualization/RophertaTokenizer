<?php

namespace Textualization\Ropherta;

use \Textualization\Ropherta\Tokenizer\Vendor;
use \Textualization\SentencePiece\Processor;

class XLMTokenizer 
{
    public $vocab_file;

    public $bos_token;
    public $eos_token;
    public $unk_token;
    public $sep_token;
    public $cls_token;
    public $pad_token;

    public $bos_token_id;
    public $eos_token_id;
    public $unk_token_id;
    public $sep_token_id;
    public $cls_token_id;
    public $pad_token_id;

    public $fairseq_tokens_to_ids;
    public $fairseq_offset;    
    

    public function __construct(
        $vocab_file = null,
        $bos_token = "<s>",
        $eos_token = "</s>",
        $sep_token = "</s>",
        $cls_token = "<s>",
        $unk_token = "<unk>",
        $pad_token = "<pad>",
    ) {
        $this->sp_model = new Processor();
        $this->sp_model->Load($vocab_file ?? Vendor::model());
        $this->vocab_file = $vocab_file;

        $this->fairseq_tokens_to_ids = ["<s>" => 0, "<pad>" => 1, "</s>" => 2, "<unk>" => 3];
        $this->fairseq_offset = 1;
        $this->fairseq_tokens_to_ids["<mask>"] = count($this->sp_model) + $this->fairseq_offset;
        $this->fairseq_ids_to_tokens = array_flip($this->fairseq_tokens_to_ids);

        $this->bos_token = $bos_token;
        $this->eos_token = $eos_token;
        $this->unk_token = $unk_token;
        $this->sep_token = $sep_token;
        $this->cls_token = $cls_token;
        $this->pad_token = $pad_token;
        
        $this->bos_token_id = null;
        $this->eos_token_id = null;
        $this->unk_token_id = null;
        $this->sep_token_id = null;
        $this->cls_token_id = null;
        $this->pad_token_id = null;
    }

    public function _convert_token_to_id($token)
    {
        if (isset($this->fairseq_tokens_to_ids[$token])) {
            return $this->fairseq_tokens_to_ids[$token];
        }
        if(is_null($this->unk_token_id)) {
            $this->unk_token_id = $this->_convert_token_to_id($this->unk_token);
        }
        $spm_id = $this->sp_model->PieceToId($token);

        return $spm_id ? $spm_id + $this->fairseq_offset : $this->unk_token_id;
    }

    public function build_inputs_with_special_tokens($token_ids)
    {
        if(is_null($this->cls_token_id)) {
            $this->cls_token_id = $this->_convert_token_to_id($this->cls_token);
        }
        if(is_null($this->sep_token_id)) {
            $this->sep_token_id = $this->_convert_token_to_id($this->sep_token);
        }
        return array_merge([$this->cls_token_id], $token_ids, [$this->sep_token_id]);
    }

    public function get_vocab_size()
    {
        return count($this->sp_model) + $this->fairseq_offset + 1;
    }

    public function count($text) : int
    {
        return count($this->encode($text));
    }

    public function split($text) : array
    {
        $len = mb_strlen($text);
        $whitespace = [ " " => 1, "\r" => 1]; //, "\r" => 1, "\t" => 1, "\n" => 1]; // \n\r not compatible with python
        $result = [];
        while($len > 512) {
            $idx = 511;
            while($idx > 0 && 
                  !isset($whitespace[mb_substr($text, $idx, 1)]))
                  //! ctype_space(mb_substr($text, $idx, 1)))
                --$idx;
            if($idx<=0){
                $idx = 512; // break tokens
                //TODO: search for punctuation
            }
            $segment = mb_substr($text, 0, $idx);
            $text = mb_substr($text, $idx, $len-$idx);
            $len -= $idx;
            $result[] = $segment;
        }
        if($len > 0){
            $result[] = $text;
        }
        return $result;
    }

    public function encode($text) : array
    {
        $segments = $this->split($text);
        $result = [];        
        foreach ($segments as $segment) {
            $one = $this->encode_one($segment);
            $result = [ ...$result, ...$one ];
        }
        return $this->build_inputs_with_special_tokens($result);
    }

    protected function encode_one($text) : array
    {
        if(is_null($this->unk_token_id)) {
            $this->unk_token_id = $this->_convert_token_to_id($this->unk_token);
        }
        
        $max_tokens = mb_strlen($text);
        if(! $max_tokens)
            $max_tokens = 2;
        $token_ids = $this->sp_model->Encode($text, $max_tokens);
        for($idx = 0; $idx<count($token_ids); $idx++) {
            if($token_ids[$idx]) {
                $token_ids[$idx] += $this->fairseq_offset;
            }else{
                $token_ids[$idx] = $this->unk_token_id;
            }
        }
        return $token_ids; 
    }
}
