PROJECT HAGGIS
Authors:  Jason Dignan,
          Jacob Hall
June, 2017 - Present
Github page: https://github.com/UMaine-ASAP/Haggis_summer_2017/

================================================================================================= MOBILE DETECTION
This site uses Mobile-Detect-2.8.26 for mobile browser redirection
The code can be found here: http://mobiledetect.net/

================================================================================================= MODEL-VIEW-CONTROLLER
This project uses the model view controller method of organizing and implementing code.
the following tutorial was used as a base template for a php implementation:
    http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/
================================================================================================= KLASS vs. CLASS
The term klass is used in place of class. This affects the model primarily. This fix addresses
an issue of referring to a class within PHP programming language. Class is a reserved word for
the language, and cannot be used outside of declaring a new class.

================================================================================================= MODEL STRUCTURE
  When developing models, they must return all data in an array format.
  This will allow easier implementation with a Mobile API.
    example:
    {resultCode, DATA}

    Following this will ensure that the model will return data compatible with mobile API systems.

    The below template for a model may help with developing new functions:

    ---------------------------------- begin template -------------------------------------------


    public static function functionName()
    {
      $errorCode;
      $message;
      $db = Db::getInstance();
      $sql = "";                          //define your SQL string between
      try
      {
        $stmt = $db->prepare($sql);
        $data = array();
        $result = $stmt->execute($data);

        (DO STUFF WITH $RESULT HERE)

        $errorCode  = ;
        $message    = ;
      }
      catch(PDOException $e)
      {
        $errorCode  = $e->getCode();
        $message    = $e->getMessage();
      }

      return array($errorCode, $message);
    }

    ---------------------------------- end template ----------------------------------------------
