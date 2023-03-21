<?php
    namespace App\Models\Users;

    class HashingAlgorithms implements IHashingAlgorithms {
        private int         $_AlgorithmId;
        private string      $_AlgorithmName;

        //get Algorithm Id
        public function getAlgorithmId(){
            return $this->_AlgorithmId;
        }
        
        //set Algorithm Name
        public function setAlgorithmName(string $algorithmName){
            $this->_AlgorithmName = $algorithmName;
        }
        //get Algorithm Name
        public function getAlgorithmName(){
            return $this->_AlgorithmName;
        }

        

        
        
    }

?>