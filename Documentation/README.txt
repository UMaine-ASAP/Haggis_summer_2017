FYI.txt
For Your Information

This document should contain notes that will help to define and explain the reasons for specific
implementations made during the development of this iteration of haggis.

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
