<?php

/*
 Copyright (c) 2009 hamcrest.org
 */

abstract class FactoryFile
{
  /**
   * Hamcrest standard is two spaces for each level of indentation.
   *
   * @var string
   */
  const INDENT = '  ';

  private $indent;

  private $file;
  
  private $code;

  public function __construct($file, $indent) {
    $this->file = $file;
    $this->indent = $indent;
  }

  public abstract function addCall(FactoryCall $call) ;

  public abstract function build() ;

  public function addFileHeader() {
    $this->code = '';
    $this->addPart('file_header');
  }

  public function addPart($name) {
    $this->addCode($this->readPart($name));
  }

  public function addCode($code) {
    $this->code .= $code;
  }

  public function readPart($name) {
    return file_get_contents(__DIR__ . "/parts/$name.txt");
  }

  public function generateFactoryCall(FactoryCall $call) {
    $method = $call->getMethod();
    $code = $method->getComment($this->indent) . PHP_EOL;
    $code .= $this->generateDeclaration($call->getName(), $method);
    $code .= $this->generateCall($method);
    $code .= $this->generateClosing();
    return $code;
  }

  public function generateDeclaration($name, FactoryMethod $method) {
    $code = $this->indent . $this->getDeclarationModifiers()
        . 'function ' . $name . '('
        . $this->generateDeclarationArguments($method)
        . ')' . PHP_EOL . $this->indent . '{' . PHP_EOL;
    if ($method->acceptsVariableArguments()) {
      $code .= $this->indent . self::INDENT . '$args = func_get_args();' . PHP_EOL;
    }
    return $code;
  }

  public function getDeclarationModifiers() {
    return '';
  }

  public function generateDeclarationArguments(FactoryMethod $method) {
    if ($method->acceptsVariableArguments()) {
      return '/* args... */';
    }
    else {
      return $method->getParameterDeclarations();
    }
  }

  public function generateCall(FactoryMethod $method) {
    $code .= $this->indent . self::INDENT . 'return ';
    if ($method->acceptsVariableArguments()) {
      $code .= 'call_user_func_array(array(\''
          . $this->generateMethodClass($method) . '\', \''
          . $method->getName() . '\'), $args);' . PHP_EOL;
    }
    else {
      $code .= $this->generateMethodClass($method) . '::'
          . $method->getName() . '('
          . $method->getParameterInvocations() . ');' . PHP_EOL;
    }
    return $code;
  }

  public function generateMethodClass(FactoryMethod $method) {
    return $method->getClassName();
  }

  public function generateClosing() {
    return $this->indent . '}' . PHP_EOL;
  }

  public function write() {
    file_put_contents($this->file, $this->code);
  }
}
