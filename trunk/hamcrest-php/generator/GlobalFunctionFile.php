<?php

/*
 Copyright (c) 2009 hamcrest.org
 */

class GlobalFunctionFile extends FactoryFile
{
  /**
   * @var string containing function definitions
   */
  private $functions;

  public function __construct($file) {
    parent::__construct($file, '');
    $this->functions = '';
  }
  
  public function addCall(FactoryCall $call) {
    $this->functions .= PHP_EOL . $this->generateFactoryCall($call);
  }

  public function generateMethodClass(FactoryMethod $method) {
    return 'Hamcrest_Matchers';
  }
  
  public function generateImport(FactoryMethod $method) {
    // omit import
  }

  public function build() {
    $this->addFileHeader();
    $this->addPart('functions_imports');
    $this->addPart('assertThat');
    $this->addCode($this->functions);
  }
}
