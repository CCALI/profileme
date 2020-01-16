<?php
//$handle = fopen($argv[0]);
$data = file_get_contents(__DIR__ . '/input.json');

$profile = json_decode($data, true);
//$profile[""]
/*
[
"name" => [
  "Client Full Name TE",
  "TextValue"
  ],
"givenName" => [
  "Client first name TE",
  ""
  ],
"familyName" => [
  "Client last name TE",
  ""
  ],
"additionalName" => [
  "Client Middle Name TE",
  ],
"alternateName" => [
  "Client Alternate Name TE",
],
"isVeteran" => [
  "Client is veteran TF",
],
"veteranStatus" => "Client Veteran Status TE",
"birthDate" => "Client date of birth DA",

"address" => [
  "Client address TE",
],

"household" => [
  "household_",

  ]
  //"roleName"

];

*/

//"household" => "household_"

//v ar_dump($profile);

//echo $profile["name"];
//die();
$xml = new SimpleXMLElement(
  "<?xml
    version=\"1.0\"
    encoding=\"utf-8\" ?>
    <AnswerSet title=\"\"></AnswerSet>");

$name = array(
//"@tag"=>"Answer",
"@attributes"=>array(
    "name"=>"name"),//"Client Full Name TE"),
//"TextValue"=>$profile["name"]
);

$givenName = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"givenName"),//"Client first name TE"),
"TextValue"=>$profile["givenName"]
);

$familyName = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"familyName"),//"Client last name TE"),
"TextValue"=>$profile["familyName"]
);

$additionalName = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"additionalName"),//"Client middle name TE"),
"TextValue"=>$profile["additionalName"]
);

$alternateName = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"alternateName"),//"Client alternateName name TE"),
"TextValue"=>$profile["alternateName"]
);

$isVeteran = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"isVeteran"),//"Client is Veteran TF"),
"TFValue"=>$profile["isVeteran"]
);

$veteranStatus = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"veteranStatus"),//"Client Veteran Status TE"),
"TextValue"=>$profile["veteranStatus"]
);

$birthDate = array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=>"birthDate"),//"Client Veteran Status DA"),
"TextValue"=>$profile["birthDate"]
);

array(
"@tag"=>"Answer",
"@attributes"=>array(
    "name"=>"address"),//"Client address TE"),
"TextValue"=>$profile["address"]
);

//$data_arr = [];
//$data_arr[] = $name;
//$data_arr[] = $givenName;
//$data_arr[] = $familyName;

//array_walk_recursive($data_arr, array ($xml, 'addChild'));
//$xml->addChild("Answer")
//->addAttribute("name", "name")
//->addChild("TextValue", $profile["name"]);

//$xml->addChild("Answer")
//->addAttribute("name", "givenName")
//->addChild("TextValue", $profile["givenName"]);

$gah =
'<?xml version="1.0" encoding="utf-8" ?>
  <AnswerSet title="">
<Answer name="name">
<TextValue>' .
$profile["name"] .
'</TextValue>
</Answer>
<Answer name="givenName">
<TextValue>' .
$profile["givenName"] .
'</TextValue>
</Answer>
<Answer name="familyName">
<TextValue>' .
$profile["familyName"] .
'</TextValue>
</Answer>
<Answer name="additionalName">
<TextValue>' .
$profile["additionalName"] .
'</TextValue>
</Answer>
<Answer name="alternateName">
<TextValue>' .
$profile["alternateName"] .
'</TextValue>
</Answer>
<Answer name="isVeteran">
<TFValue>' .
$profile["isVeteran"] .
'</TFValue>
</Answer>
<Answer name="veteranStatus">
<TextValue>' .
$profile["veteranStatus"] .
'</TextValue>
</Answer>
<Answer name="birthDate">
<TextValue>' .
$profile["birthDate"] .
'</TextValue>
</Answer>';
//</AnswerSet>
//';

/*
$xml->addChild("Answer");
$xml->Answer->addAttribute("name", "familyName");
$xml->Answer->addChild("TextValue", $profile["familyName"]);

$xml->addChild("Answer");
$xml->Answer->addAttribute("name", "additionalName");
$xml->Answer->addChild("TextValue", $profile["additionalName"]);

$xml->addChild("Answer");
$xml->Answer->addAttribute("name", "alternateName");
$xml->Answer->addChild("TextValue", $profile["alternateName"]);

$xml->addChild("Answer");
$xml->Answer->addAttribute("name", "isVeteran");
$xml->Answer->addChild("TFValue", $profile["isVeteran"]);

$xml->addChild("Answer");
$xml->Answer->addAttribute("name", "veteranStatus");
$xml->Answer->addChild("TextValue", $profile["veteranStatus"]);

$xml->addChild("Answer");
$xml->Answer->addAttribute("name", "birthDate");
$xml->Answer->addChild("TextValue", $profile["birthDate"]);
*/


//file_put_contents(__DIR__ . '/sticky.anx',$gah);//$xml->asXML());

$occupantCounter = 0;

$roleNames = [];
$parents = [];
$birthdates = [];

/*
$household .=
'<Answer name="">
<RptValue>
</RptValue>
</Answer>
';
*/

$roleNamesxml = "";
$parentsxml = "";
$birthdatesxml = "";

foreach($profile["household"] as $occupant){

  $roleNames[] = array(
    "TextValue" => $occupant["roleName"]
  );

  $roleNamesxml .= '<TextValue>' .
  $occupant["roleName"] .
  '</TextValue>';



  //$xml->addChild("Answer");
  //$xml->Answer->addAttribute("name", "birthDate");
  //$xml->Answer->addChild("TextValue", $occupant["roleName"]);


  $parents[] = array(
    "TextValue" => $occupant["parent"]
  );

  $parentsxml .= '<TextValue>' .
  $occupant["parent"] .
  '</TextValue>';

  $names[] = array(
    "TextValue" => $occupant["name"]
  );

  $namesxml .= '<TextValue>' .
  $occupant["name"] .
  '</TextValue>';

  $birthdates[] = array(
    "DateValue" => $occupant["birthDate"]
  );

  $birthdatesxml .= '<TextValue>' .
  $occupant["birthdate"] .
  '</TextValue>';

  $occupantCounter++;
}

$gah .=
'<Answer name="household_roleName">
<RptValue>' .
$roleNamesxml .
'</RptValue>
</Answer>';

$gah .=
'<Answer name="household_name">
<RptValue>' .
$parentsxml .
'</RptValue>
</Answer>';

$gah .=
'<Answer name="household_birthdate">
<RptValue>' .
$birthdatesxml .
'</RptValue>
</Answer>';


$gah .= '</AnswerSet>';
file_put_contents(__DIR__ . '/sticky.anx',$gah);//$xml->asXML());

/*

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "household_roleName"),
    $roleNames
);

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "household_name"),
    $parents
);

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "household_birthdate"),
    $birthdates
);


array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "householdCount"),
"NumValue"=>$occupantCounter
);


$incomeCount = 0;

$incomeAmounts = [];
$incomeSources = [];
$incomeNames = [];
$incomePeriods = [];
$income_priceCurrency = [];

foreach($profile["income"] as $income){

  $incomeAmounts[] = array(
    "TextValue" => $income["amount"]
  );

  $incomeSources[] = array(
    "TextValue" => $income["source"]
  );

  $incomeNames[] = array(
    "TextValue" => $income["name"]
  );

  $incomePeriods[] = array(
    "TextValue" => $income["period"]
  );

  $income_priceCurrency[] = array(
    "TextValue" => $income["priceCurrency"]
  );

  $incomeCount++;
}

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "income_amount"),
    $incomeAmounts
);

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "income_source"),
    $incomeSources
);

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "income_name"),
    $incomeNames
);

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "$income_periods"),
    $income_Periods
);

array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "$income_priceCurrency"),
    $income_priceCurrency
);


array(
"@tag"=>"Answer",
"@attr"=>array(
    "name"=> "incomeCount"),
"NumValue"=>$incomeCount
);
*/

?>
