# BPE Tokenizer for Ropherta (subclass of GPT3Tokenizer)

This is just a wrapper around [GPT3Tokenizer](https://packagist.org/packages/gioni06/gpt3-tokenizer) using [the HuggingFace RoBERTa vocab and merge files](https://github.com/huggingface/transformers/blob/main/src/transformers/models/roberta/tokenization_roberta.py).

See [GPT3 documentation](https://github.com/Gioni06/GPT3Tokenizer/blob/main/README.md) for example use (or the generated test case under `tests/`).

## XLM Tokenizer

To use the multilingual version, the [SentencePiece dependency](https://packagist.org/packages/textualization/sentencepiece) needs to be initialized and an aditional model file needs to be downloaded:

```
composer exec -- php -r "require 'vendor/autoload.php'; Textualization\SentencePiece\Vendor::check();"
composer exec -- php -r "require 'vendor/autoload.php'; Textualization\Ropherta\Tokenizer\Vendor::check();"
```


## Sponsors

We thank our sponsor:

<a href="https://evoludata.com/"><img src="https://evoludata.com/display208"></a>


