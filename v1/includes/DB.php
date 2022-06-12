<?php
    class DB {
        private static $writeDBConnection;
        private static $readDBConnection;

        public static function connectWriteDB(){
            if(self::$writeDBConnection === null){
                self::$writeDBConnection = new PDO('mysql:host=localhost;dbname=anifanfi_db;charset=utf8','root','');
                self::$writeDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$writeDBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            }
            return self::$writeDBConnection;
        }

        public static function connectReadDB(){
            if(self::$readDBConnection === null){
                self::$readDBConnection = new PDO('mysql:host=localhost;dbname=anifanfi_db;charset=utf8','root','');
                self::$readDBConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$readDBConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            }
            return self::$readDBConnection;
        }

        public static function query($db,$query, $vals){
            $vars = [];
            $match = false;
            $currIdx =null;
            $counter = 0;
            for($i=0; $i<strlen($query);$i++){
                if($match){
                    $counter++;
                   }
                if($query[$i] === ':'){
                    $currIdx = $i;
                    $match=true;
                }
                if($match && ($query[$i] === " " || $query[$i] === "," || $i === strlen($query) -1 || $query[$i] === ")")){
                    $match = false;
                    if($i === strlen($query) -1){
                        $counter++;
                    }
                    if($query[$i] === ")"){
                        $counter--;
                    }
                    $v = substr($query,$currIdx, $counter);
                    $vAssocIdx = substr($v,1);
                    
                    // $vars[] = [$v => $vals[$vAssocIdx]];
                    $vars[$v] = $vals[$vAssocIdx];
                    $counter = 0;
                }
            }
            return self::queryExecute($db,$query,$vars);
        }

        private static function queryExecute($db,$query,$params){
            $result = $db->prepare($query);
            $result->execute($params);
            return $result;
        }

    }
?>