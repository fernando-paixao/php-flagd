<?php

declare(strict_types=1);

namespace Examples\OpenFeature\Http;

require __DIR__ . '/vendor/autoload.php';

use OpenFeature\OpenFeatureAPI;
use OpenFeature\Providers\Flagd\FlagdProvider;

use GuzzleHttp\Client;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use OpenFeature\implementation\flags\Attributes;
use OpenFeature\implementation\flags\EvaluationContext;

$api = OpenFeatureAPI::getInstance();

$psr18Client = new Client();
$requestFactory = new RequestFactory();
$streamFactory = new StreamFactory();

$provider = new FlagdProvider([
  'host' => 'localhost',
  'port' => 8013,
  'secure' => false,
  'protocol' => 'http',
  'httpConfig' => [
    'client' => $psr18Client,
    'requestFactory' => $requestFactory,
    'streamFactory' => $streamFactory,
  ],
]);

$api->setProvider($provider);

$client = $api->getClient('http-example', '1.0');

//$flagValue = $client->getBooleanDetails('dev.openfeature.example_flag', true, null, null);
//$flagValue = $client->getObjectDetails('myObjectFlag', [], null, null);

$evalutionContext = new EvaluationContext(null, new Attributes(["color" => 'yellow']));
$flagValue = $client->getBooleanDetails('isColorYellow', true, $evalutionContext, null); //json_encode(['color' => 'yellow'] //new EvaluationContext('{"color": yellow}')

//$evalutionContext = new EvaluationContext(null, new Attributes(["age" => 19,]));  //'{"age": 20}'
//$flagValue = $client->getBooleanDetails('feature-1', true, $evalutionContext, null); //json_encode(['color' => 'yellow'] //new EvaluationContext('{"color": yellow}')
var_dump(
  $flagValue, 
  //get_class_methods($flagValue), 
  $flagValue->getValue(), 
  $flagValue->getFlagKey(), 
  $flagValue->getReason(), 
  $flagValue->getVariant(),
  $flagValue->getError(),
);
