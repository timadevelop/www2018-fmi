<?php

//
//
//

class Request
{
  private $method;
  private $path;
  private $url;
  private $user_agent;

  public function __construct($info)
  {
    $this->method = strtolower($info['REQUEST_METHOD']);
    $this->url = strtolower($info['HTTP_HOST'] . $info['REQUEST_URI']);
    $this->path = strtolower($info['PATH']);
    $this->user_agent = strtolower($info['HTTP_USER_AGENT']);
  }

  public function getMethod()
  {
    return $this->method;
  }

  public function getPath()
  {
    return $this->path;
  }

  public function getURL()
  {
    return $this->url;
  }

  public function getUserAgent()
  {
    return $this->user_agent;
  }
}

//
//
//

class GetRequest extends Request
{
  private $query;

  public function __construct($info)
  {
    $this->query = $info['QUERY_STRING'];
    parent::__construct($info);
  }

  public function getData()
  {
    $result = array();
    // for each parameter
    foreach(explode('&', $this->query) as $q)
    {
      $tmp = explode('=', $q);
      $sz = sizeof($tmp);

      if ($sz < 1) continue;

      $field = $tmp[0];
      $value = $sz > 1 ? $tmp[1] : '';
      $result[$field] = $value;
    }
    return $result;
  }
}

//
// tests
//

/*
$req = new Request($_SERVER);
echo "<br>";
echo $req->getMethod();

echo "<br>";
echo $req->getPath();

echo "<br>";
echo $req->getUrl();

echo "<br>";
echo $req->getUserAgent();

$greq = new GetRequest($_SERVER);

echo "<br>";
print_r($greq->getData());

 */

?>
