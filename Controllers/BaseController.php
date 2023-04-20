BaseController
<?php

class BaseController
{
    const FOLDER_VIEW_NAME="Views";
    const FOLDER_MODEL_NAME="Models";

    protected function view($viewPath, $data=[])
    {
        foreach($data as $key=>$value)
        {
            $$key=$value;
            echo json_encode($$key);
        };
        return include("./".self::FOLDER_VIEW_NAME."/".str_replace('.', '/', $viewPath).".php");
    }

    protected function loadModel($modelPath)
    {
        //echo "./".self::FOLDER_MODEL_NAME."/".$modelPath.".php";
        return require("./".self::FOLDER_MODEL_NAME."/".$modelPath.".php");
    }
}