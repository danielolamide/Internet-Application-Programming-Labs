<?php
    interface Crud{
        public function save($con);
        public function readAlL($con);
        public function readUnique($con);
        public function search($con);
        public function update($con);
        public function removeOne($con);
        public function removeAll($con);
    }