# Use Python to generate test file

This code uses the test fixture from GPT3Tokenizer, runs it through HuggingFace transformer and generates a test file that compares the tokens line by line.

Note: the HuggingFace tokenizer adds start and end of sequence tokens but GPT3Tokenizer does not.

## Setup

In the root folder:

```bash
composer install
```

(this setups the vendor/ folder)

Setup a virtualenv / conda install and do:

```bash
pip install transformers
```

## Usage

```bash
python generate_test.py
```

This will create (or re-create) ../tests/TokenizerTest.php

(To run the tests do `composer test` in the root folder.)
